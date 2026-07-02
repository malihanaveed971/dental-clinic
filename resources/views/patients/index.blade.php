@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8">
        <div class="flex items-start justify-between gap-4">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-900">Patient Dashboard</h1>
                <p class="mt-2 text-gray-600">Manage your visits and view upcoming appointments.</p>
            </div>
            <div class="hidden sm:block">
                <div class="h-12 w-12 rounded-xl bg-teal-50 flex items-center justify-center text-teal-700 font-bold">P</div>
            </div>
        </div>

        <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-4">
            <a href="/appointments" class="group border border-gray-100 rounded-xl p-5 hover:border-teal-200 hover:shadow-sm transition">
                <div class="flex items-center gap-3">
                    <div class="h-10 w-10 rounded-lg bg-blue-50 text-blue-700 flex items-center justify-center font-semibold">✓</div>
                    <h2 class="font-semibold text-gray-900">My Appointments</h2>
                </div>
                <p class="mt-2 text-sm text-gray-600">View appointment history and current bookings.</p>
            </a>

            <div class="border border-gray-100 rounded-xl p-5">
                <div class="flex items-center gap-3">
                    <div class="h-10 w-10 rounded-lg bg-amber-50 text-amber-700 flex items-center justify-center font-semibold">!</div>
                    <h2 class="font-semibold text-gray-900">Health Profile</h2>
                </div>
                <p class="mt-2 text-sm text-gray-600">Dental records and prescriptions will appear here.</p>
            </div>

            <a href="/billing" class="group border border-gray-100 rounded-xl p-5 hover:border-teal-200 hover:shadow-sm transition">
                <div class="flex items-center gap-3">
                    <div class="h-10 w-10 rounded-lg bg-green-50 text-green-700 flex items-center justify-center font-semibold">$</div>
                    <h2 class="font-semibold text-gray-900">Billing</h2>
                </div>
                <p class="mt-2 text-sm text-gray-600">Invoices, payments, and summaries.</p>
            </a>
        </div>

        <div class="mt-8 rounded-xl bg-gray-50 border border-gray-100 p-5">
            <h3 class="font-semibold text-gray-900">Quick actions</h3>
            <div class="mt-3 flex flex-wrap gap-3">
                <a href="/" class="px-4 py-2 rounded-lg bg-teal-600 text-white hover:bg-teal-700 transition font-medium">Book new appointment</a>
                <a href="/dentists" class="px-4 py-2 rounded-lg bg-white border border-gray-200 hover:border-teal-200 hover:text-teal-700 transition font-medium">Browse dentists</a>
            </div>
        </div>
    </div>
</div>
@endsection

