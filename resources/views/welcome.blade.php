@extends('layouts.app')

@section('content')
    <x-clinic-hero />

    <div class="max-w-6xl mx-auto px-4 -mt-6 pb-10">
        <!-- Random dentist “pictuers” placeholders (emoji avatars) -->
        <section class="mt-2">
            <div class="flex items-center justify-between gap-4">
                <div>
                    <h2 class="text-lg font-semibold text-gray-900">Meet our dentists</h2>
                    <p class="text-sm text-gray-600 mt-1">A friendly team ready to help.</p>
                </div>
                <div class="hidden sm:block text-sm text-gray-600">
                    <span class="inline-flex items-center gap-2 rounded-full bg-white/70 border border-gray-100 px-4 py-2">
                        <span class="text-base">🪥</span>
                        <span>Care • Comfort • Results</span>
                    </span>
                </div>
            </div>

            <div class="mt-4 grid grid-cols-1 sm:grid-cols-3 gap-4">
                @php
                    $dentistAvatars = [
                        ['name' => 'Dr. Amina', 'spec' => 'Orthodontics', 'emoji' => '🦷'],
                        ['name' => 'Dr. John', 'spec' => 'Cosmetic Dentistry', 'emoji' => '✨'],
                        ['name' => 'Dr. Sara', 'spec' => 'General Dentistry', 'emoji' => '🩺'],
                    ];
                @endphp

@foreach($dentistAvatars as $d)
                    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5 hover:shadow-md transition">
                        <div class="h-14 w-14 rounded-2xl bg-teal-50 border border-teal-100 flex items-center justify-center text-3xl">
                            {{ $d['emoji'] }}
                        </div>
                        <h3 class="mt-4 font-semibold text-gray-900">{{ $d['name'] }}</h3>
                        <p class="text-sm text-gray-600 mt-1">{{ $d['spec'] }}</p>
                        <div class="mt-4 flex items-center justify-between">
                            <span class="text-xs px-3 py-1 rounded-full bg-blue-50 text-blue-700 border border-blue-100">Available</span>
                            <a href="/appointments" class="text-sm font-medium text-teal-700 hover:text-teal-800">Book</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <div class="rounded-3xl border border-gray-100 bg-white/90 backdrop-blur shadow-sm p-6 md:p-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-start">
                <div>
                    <h3 class="text-2xl font-bold text-gray-900">Appointment request</h3>
                    <p class="mt-3 text-gray-600">
                        Choose a dentist, pick date & time, and submit your appointment request.
                    </p>

                    <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div class="rounded-2xl bg-teal-50 border border-teal-100 p-4">
                            <div class="text-sm text-teal-800 font-semibold">Fast booking</div>
                            <div class="text-sm text-teal-700 mt-1">Simple form, quick confirmation.</div>
                        </div>
                        <div class="rounded-2xl bg-blue-50 border border-blue-100 p-4">
                            <div class="text-sm text-blue-800 font-semibold">Clear schedule</div>
                            <div class="text-sm text-blue-700 mt-1">See appointments on the next page.</div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    @if(session('success'))
                        <div class="bg-green-100 text-green-800 p-3 rounded-lg mb-4">{{ session('success') }}</div>
                    @endif

                    <form action="/appointment/request" method="POST" class="space-y-4">
                        @csrf

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Patient name</label>
                            <input
                                type="text"
                                name="patient_name"
                                value="{{ old('patient_name') }}"
                                placeholder="Full name"
                                class="mt-1 w-full rounded-xl border border-gray-200 p-3 focus:outline-none focus:ring-2 focus:ring-teal-200"
                                required
                            />
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Select dentist</label>
                            <select
                                name="dentist_id"
                                class="mt-1 w-full rounded-xl border border-gray-200 p-3 focus:outline-none focus:ring-2 focus:ring-teal-200"
                                required
                            >
                                <option value="">Select a Dentist</option>
                                @foreach($dentists as $dentist)
                                    <option value="{{ $dentist->id }}">{{ $dentist->name }} ({{ $dentist->specialization }})</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Appointment date & time</label>
                            <input
                                type="datetime-local"
                                name="appointment_time"
                                value="{{ old('appointment_time') }}"
                                class="mt-1 w-full rounded-xl border border-gray-200 p-3 focus:outline-none focus:ring-2 focus:ring-teal-200"
                                required
                            />
                        </div>

                        <button type="submit" class="w-full bg-yellow-400 text-gray-900 py-3 rounded-xl hover:bg-yellow-300 transition font-semibold shadow-sm border border-yellow-300">
                            Confirm booking
                        </button>
                    </form>

                    @error('patient_name')
                        <p class="mt-3 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    @error('dentist_id')
                        <p class="mt-3 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    @error('appointment_time')
                        <p class="mt-3 text-sm text-red-600">{{ $message }}</p>
                    @enderror

                    <div class="mt-5">
                        <a href="/dentists" class="text-sm font-medium text-teal-700 hover:text-teal-800">Need to change dentist? Browse dentists</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
