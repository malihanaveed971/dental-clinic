@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4">
    <div class="flex items-start justify-between gap-4">
        <div>
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900">Our Dentists</h1>
            <p class="mt-3 text-gray-600">Choose a professional and book an appointment in seconds.</p>
        </div>
        <div class="hidden sm:block">
            <div class="h-12 w-12 rounded-2xl bg-blue-50 flex items-center justify-center text-blue-700 font-bold">🦷</div>
        </div>
    </div>

    <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach($dentists as $dentist)
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden hover:shadow-md transition">
                <div class="p-5">
                    <div class="flex items-center gap-3">
                        <div class="h-12 w-12 rounded-2xl bg-teal-50 flex items-center justify-center text-teal-700 font-bold">
                            {{ strtoupper(substr($dentist->name ?? 'D', 0, 1)) }}
                        </div>
                        <div>
                            <h2 class="text-lg font-semibold text-gray-900">{{ $dentist->name }}</h2>
                            <p class="text-sm text-gray-500">{{ $dentist->specialization }}</p>
                        </div>
                    </div>

                    @if(!empty($dentist->bio))
                        <p class="mt-4 text-sm text-gray-600 leading-relaxed">{{ $dentist->bio }}</p>
                    @else
                        <p class="mt-4 text-sm text-gray-500">No bio available.</p>
                    @endif

                    <div class="mt-4 space-y-1 text-sm text-gray-600">
                        @if(!empty($dentist->phone))
                            <div><span class="font-medium text-gray-800">Phone:</span> {{ $dentist->phone }}</div>
                        @endif
                        @if(!empty($dentist->email))
                            <div><span class="font-medium text-gray-800">Email:</span> {{ $dentist->email }}</div>
                        @endif
                    </div>


                    <div class="mt-5">
                        <a href="/" class="inline-flex w-full items-center justify-center rounded-xl bg-teal-600 text-white py-2.5 text-sm font-medium hover:bg-teal-700 transition">
                            Book with {{ $dentist->name }}
                        </a>
                    </div>

                    <div class="mt-4">
                        <a href="/appointments" class="inline-flex w-full items-center justify-center rounded-xl bg-white border border-gray-200 text-gray-700 py-2.5 text-sm font-medium hover:border-teal-200 hover:text-teal-700 transition">
                            Go to control panel (choose appointment)
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
