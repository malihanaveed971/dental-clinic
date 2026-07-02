@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4">
    <div class="flex items-start justify-between gap-4">
        <div>
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900">My Appointments</h1>
            <p class="mt-3 text-gray-600">A clear history of your clinic visits.</p>
        </div>
        <div class="hidden sm:block">
            <div class="h-12 w-12 rounded-2xl bg-gray-50 border border-gray-100 flex items-center justify-center text-gray-700 font-bold">📅</div>
        </div>
    </div>

    <div class="mt-8 bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="p-5 border-b border-gray-100">
            <h2 class="font-semibold text-gray-900">Appointments</h2>
            <p class="text-sm text-gray-600">All requests submitted are listed here.</p>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="text-xs uppercase text-gray-500 bg-gray-50">
                    <tr>
                        <th class="p-3">Patient</th>
                        <th class="p-3">Dentist</th>
                        <th class="p-3">Date & time</th>
                        <th class="p-3">Status</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    @forelse($appointments as $appointment)
<tr class="border-t border-gray-100">
                            <td class="p-3 text-gray-900">{{ $appointment->patient_name }}</td>
                            <td class="p-3 text-gray-900">{{ optional($appointment->dentist)->name ?? '—' }}</td>
                            <td class="p-3 text-gray-700">{{ $appointment->appointment_date ? 
                                \Carbon\Carbon::parse($appointment->appointment_date)->format('Y-m-d H:i') : '—' }}
                            </td>
                            <td class="p-3">
                                <span class="inline-flex items-center rounded-full bg-teal-50 text-teal-700 px-3 py-1 text-xs font-medium">
                                    Requested
                                </span>
                                <div class="mt-2">
                                    <a href="/dentists/panel/{{ $appointment->id }}" class="text-xs font-medium text-teal-700 hover:text-teal-800">
                                        Open panel
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr class="border-t border-gray-100">
                            <td class="p-6" colspan="4">
                                <div class="text-center">
                                    <div class="text-gray-900 font-semibold">No appointments yet</div>
                                    <div class="text-sm text-gray-600 mt-1">Book your first appointment on the home page.</div>
<a href="/" class="mt-4 inline-flex items-center justify-center rounded-xl bg-teal-600 text-white px-4 py-2.5 text-sm font-medium hover:bg-teal-700 transition">
                                        Book now
                                    </a>
<a href="/dentists" class="mt-2 inline-flex items-center justify-center rounded-xl bg-white border border-gray-200 text-gray-700 px-4 py-2.5 text-sm font-medium hover:border-teal-200 hover:text-teal-700 transition">
                                        Dentist panel (choose appointment)
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
