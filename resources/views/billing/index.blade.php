@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8">
        <div class="flex items-start justify-between gap-4">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-900">Billing & Invoices</h1>
                <p class="mt-2 text-gray-600">Invoices, payments, and billing history will appear here.</p>
            </div>
            <div class="hidden sm:block">
                <div class="h-12 w-12 rounded-xl bg-green-50 flex items-center justify-center text-green-700 font-bold">$</div>
            </div>
        </div>

        <div class="mt-8 grid grid-cols-1 lg:grid-cols-3 gap-4">
            <div class="lg:col-span-2 rounded-xl border border-gray-100 p-5">
                <h2 class="font-semibold text-gray-900">Recent invoices</h2>

                <div class="mt-4 overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead class="text-xs uppercase text-gray-500 bg-gray-50">
                            <tr>
                                <th class="p-3">Invoice</th>
                                <th class="p-3">Date</th>
                                <th class="p-3">Amount</th>
                                <th class="p-3">Status</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm">
                            @forelse ($invoices as $invoice)
                                <tr>
                                    <td class="p-3 text-gray-900">{{ $invoice['invoice_no'] }}</td>
                                    <td class="p-3 text-gray-600">{{ $invoice['date'] ?? '—' }}</td>
                                    <td class="p-3 text-gray-900">${{ number_format($invoice['amount'], 0) }}</td>
                                    <td class="p-3">
                                        @if(($invoice['status'] ?? '') === 'Paid')
                                            <span class="inline-flex items-center rounded-full bg-green-50 text-green-700 px-3 py-1 text-xs font-medium">Paid</span>
                                        @else
                                            <span class="inline-flex items-center rounded-full bg-amber-50 text-amber-700 px-3 py-1 text-xs font-medium">Unpaid</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="p-3" colspan="4">
                                        <div class="text-sm text-gray-600">No invoices found yet.</div>
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>

                <p class="mt-4 text-sm text-gray-500">
                    All invoices are generated dynamically from the dentist's control panel.
                </p>
            </div>

            <div class="rounded-xl bg-gray-50 border border-gray-100 p-5">
                <h2 class="font-semibold text-gray-900">Payment summary</h2>
                <div class="mt-4 grid grid-cols-1 gap-3">
                    <div class="p-4 rounded-xl bg-white border border-gray-100">
                        <div class="text-xs text-gray-500">Paid</div>
                        <div class="text-xl font-bold text-gray-900">${{ number_format($paidTotal ?? 0, 0) }}</div>
                    </div>
                    <div class="p-4 rounded-xl bg-white border border-gray-100">
                        <div class="text-xs text-gray-500">Unpaid</div>
                        <div class="text-xl font-bold text-gray-900">${{ number_format($unpaidTotal ?? 0, 0) }}</div>
                    </div>

                </div>

                <div class="mt-4 text-sm text-gray-500">
                    Calculated automatically from treatments and prescriptions.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

