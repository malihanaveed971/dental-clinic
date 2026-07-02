@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4">
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Dentist Control Panel</h1>
        <p class="mt-2 text-gray-600">Attend patient, add medications and X-rays, then generate billing.</p>
    </div>

    @if(session('success'))
        <div class="mb-4 rounded-xl bg-green-50 text-green-800 border border-green-200 px-4 py-3 text-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
                <h2 class="font-semibold text-gray-900 text-lg">Patient / Appointment</h2>
                <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 gap-3 text-sm">
                    <div class="p-4 rounded-xl bg-gray-50 border border-gray-100">
                        <div class="text-xs text-gray-500">Patient</div>
                        <div class="font-semibold text-gray-900">{{ $appointment->patient_name }}</div>
                    </div>
                    <div class="p-4 rounded-xl bg-gray-50 border border-gray-100">
                        <div class="text-xs text-gray-500">Date & time</div>
                        <div class="font-semibold text-gray-900">{{ $appointment->appointment_date ? \Carbon\Carbon::parse($appointment->appointment_date)->format('Y-m-d H:i') : '—' }}</div>
                    </div>
                    <div class="p-4 rounded-xl bg-gray-50 border border-gray-100 sm:col-span-2">
                        <div class="text-xs text-gray-500">Dentist</div>
                        <div class="font-semibold text-gray-900">{{ $appointment->dentist->name ?? '—' }}</div>
                    </div>
                </div>
            </div>

            <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
                    <h2 class="font-semibold text-gray-900 text-lg">Add Medication</h2>
                    <form method="POST" action="{{ route('dentist.panel.prescription', ['appointmentId' => $appointment->id]) }}" class="mt-4 space-y-3">
                        @csrf
                        <div>
                            <label class="block text-xs font-medium text-gray-600">Medication name</label>
                            <input name="medication_name" required class="mt-1 w-full rounded-xl border border-gray-200 p-3 text-sm" placeholder="e.g. Amoxicillin" />
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block text-xs font-medium text-gray-600">Quantity</label>
                                <input type="number" min="1" name="quantity" required class="mt-1 w-full rounded-xl border border-gray-200 p-3 text-sm" value="1" />
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-600">Unit price</label>
                                <input type="number" min="0" step="0.01" name="unit_price" required class="mt-1 w-full rounded-xl border border-gray-200 p-3 text-sm" value="0" />
                            </div>
                        </div>
                        <button class="w-full rounded-xl bg-teal-600 text-white py-2.5 text-sm font-medium hover:bg-teal-700 transition" type="submit">
                            Add medication
                        </button>
                    </form>
                </div>

                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
                    <h2 class="font-semibold text-gray-900 text-lg">Add X-ray</h2>
                    <form method="POST" action="{{ route('dentist.panel.xray', ['appointmentId' => $appointment->id]) }}" class="mt-4 space-y-3">
                        @csrf
                        <div>
                            <label class="block text-xs font-medium text-gray-600">X-ray type</label>
                            <input name="xray_type" required class="mt-1 w-full rounded-xl border border-gray-200 p-3 text-sm" placeholder="e.g. Panoramic" />
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-600">Unit price</label>
                            <input type="number" min="0" step="0.01" name="unit_price" required class="mt-1 w-full rounded-xl border border-gray-200 p-3 text-sm" value="0" />
                        </div>
                        <button class="w-full rounded-xl bg-teal-600 text-white py-2.5 text-sm font-medium hover:bg-teal-700 transition" type="submit">
                            Add X-ray
                        </button>
                    </form>
                </div>
            </div>

            <div class="mt-4 bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
                <h2 class="font-semibold text-gray-900 text-lg">Invoice</h2>

                <div class="mt-4 flex flex-col sm:flex-row gap-3 sm:items-center sm:justify-between">
                    <div class="text-sm text-gray-600">
                        Medications: <span class="font-semibold text-gray-900">{{ $prescriptions->count() }}</span> • X-rays: <span class="font-semibold text-gray-900">{{ $xrays->count() }}</span>
                    </div>

                    <form method="POST" action="{{ route('dentist.panel.generate', ['appointmentId' => $appointment->id]) }}">
                        @csrf
                        <button type="submit" class="rounded-xl bg-green-600 text-white px-5 py-2.5 text-sm font-medium hover:bg-green-700 transition">
                            Generate billing
                        </button>
                    </form>
                </div>

                @if($invoice)
                    <div class="mt-4 rounded-2xl bg-gray-50 border border-gray-100 p-4 text-sm">
                        <div class="flex flex-wrap gap-x-6 gap-y-2">
                            <div>Invoice: <span class="font-semibold">{{ $invoice->invoice_no }}</span></div>
                            <div>Status: <span class="font-semibold">{{ $invoice->status }}</span></div>
                            <div>Grand total: <span class="font-semibold">${{ number_format((float) $invoice->grand_total, 2) }}</span></div>
                        </div>
                    </div>
                @else
                    <div class="mt-4 text-sm text-gray-600">No invoice generated yet.</div>
                @endif

                <div class="mt-5">
                    <div class="text-sm font-semibold text-gray-900">Line items</div>
                    <div class="mt-3 overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead class="text-xs uppercase text-gray-500 bg-gray-50">
                                <tr>
                                    <th class="p-3">Type</th>
                                    <th class="p-3">Description</th>
                                    <th class="p-3">Qty</th>
                                    <th class="p-3">Unit</th>
                                    <th class="p-3">Total</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm">
                                @forelse(($invoice ? $invoice->lineItems : collect()) as $item)
                                    <tr class="border-t border-gray-100">
                                        <td class="p-3">{{ $item->type }}</td>
                                        <td class="p-3">{{ $item->description }}</td>
                                        <td class="p-3">{{ $item->quantity }}</td>
                                        <td class="p-3">${{ number_format((float) $item->unit_price, 2) }}</td>
                                        <td class="p-3">${{ number_format((float) $item->line_total, 2) }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="p-3" colspan="5">
                                            <div class="text-sm text-gray-600">Generate invoice to see line items.</div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
                <h2 class="font-semibold text-gray-900 text-lg">Current Medications</h2>
                <div class="mt-4 space-y-3 text-sm">
                    @forelse($prescriptions as $p)
                        <div class="p-4 rounded-xl bg-gray-50 border border-gray-100">
                            <div class="font-semibold text-gray-900">{{ $p->medication_name }}</div>
                            <div class="text-gray-600 mt-1">Qty: {{ $p->quantity }} • Unit: ${{ number_format((float)$p->unit_price,2) }}</div>
                            <div class="text-gray-900 mt-1 font-semibold">Line total: ${{ number_format((float)$p->line_total,2) }}</div>
                        </div>
                    @empty
                        <div class="text-sm text-gray-600">No medications added yet.</div>
                    @endforelse
                </div>
            </div>

            <div class="mt-4 bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
                <h2 class="font-semibold text-gray-900 text-lg">Current X-rays</h2>
                <div class="mt-4 space-y-3 text-sm">
                    @forelse($xrays as $x)
                        <div class="p-4 rounded-xl bg-gray-50 border border-gray-100">
                            <div class="font-semibold text-gray-900">{{ $x->xray_type }}</div>
                            <div class="text-gray-900 mt-1 font-semibold">Charge: ${{ number_format((float)$x->line_total,2) }}</div>
                        </div>
                    @empty
                        <div class="text-sm text-gray-600">No X-rays added yet.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

