@extends('layouts.app')

@section('title', $car->brand . ' ' . $car->model . ' — My Baltic Car')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

    <a href="{{ url()->previous() === url()->current() ? route('cars.index') : url()->previous() }}"
        class="inline-flex items-center space-x-2 text-gray-300 hover:text-white mb-6 transition text-sm">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
        </svg>
        <span>Atpakaļ uz sarakstu</span>
    </a>

    <div class="bg-white rounded-2xl shadow-2xl fade-in overflow-hidden">

        {{-- Car image --}}
        @if($car->image_url)
            <img src="{{ $car->image_url }}" alt="{{ $car->brand }} {{ $car->model }}"
                class="w-full h-72 object-cover">
        @else
            <div class="w-full h-72 bg-gradient-to-br from-blue-900/60 to-blue-700/40 flex items-center justify-center">
                <svg class="w-28 h-28 text-blue-300/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                        d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                        d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10l2 2h10z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                        d="M16 16l2-8h2l2 8"/>
                </svg>
            </div>
        @endif

        <div class="p-8">

        {{-- Header --}}
        <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4 mb-8">
            <div>
                <span class="bg-blue-600 text-white text-xs font-semibold px-2.5 py-1 rounded-full">
                    {{ $car->brand }}
                </span>
                <h1 class="text-3xl font-bold text-gray-900 mt-3">
                    {{ $car->brand }} {{ $car->model }}
                </h1>
                @if($car->year)
                    <p class="text-gray-500 mt-1">{{ $car->year }}. gads</p>
                @endif
            </div>
            <div class="sm:text-right">
                <div class="text-3xl font-bold text-green-400">
                    {{ $car->price ? '€ ' . number_format($car->price) : 'Cena nav norādīta' }}
                </div>
            </div>
        </div>

        {{-- Details grid --}}
        <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 mb-8">
            <div class="bg-gray-50 rounded-xl p-4 border border-gray-100">
                <div class="text-xs text-gray-400 uppercase tracking-wider mb-1">Valsts</div>
                <div class="text-gray-900 font-medium">
                    @if($car->country === 'EE') 🇪🇪 Igaunija
                    @elseif($car->country === 'LT') 🇱🇹 Lietuva
                    @else 🇱🇻 Latvija
                    @endif
                </div>
            </div>
            <div class="bg-gray-50 rounded-xl p-4 border border-gray-100">
                <div class="text-xs text-gray-400 uppercase tracking-wider mb-1">Marka</div>
                <div class="text-gray-900 font-medium">{{ $car->brand }}</div>
            </div>
            <div class="bg-gray-50 rounded-xl p-4 border border-gray-100">
                <div class="text-xs text-gray-400 uppercase tracking-wider mb-1">Modelis</div>
                <div class="text-gray-900 font-medium">{{ $car->model }}</div>
            </div>
            @if($car->year)
                <div class="bg-gray-50 rounded-xl p-4 border border-gray-100">
                    <div class="text-xs text-gray-400 uppercase tracking-wider mb-1">Gads</div>
                    <div class="text-gray-900 font-medium">{{ $car->year }}</div>
                </div>
            @endif
            @if($car->engine_size)
                <div class="bg-gray-50 rounded-xl p-4 border border-gray-100">
                    <div class="text-xs text-gray-400 uppercase tracking-wider mb-1">Dzinēja tilpums</div>
                    <div class="text-gray-900 font-medium">{{ $car->engine_size }}</div>
                </div>
            @endif
            @if($car->mileage)
                <div class="bg-gray-50 rounded-xl p-4 border border-gray-100">
                    <div class="text-xs text-gray-400 uppercase tracking-wider mb-1">Nobraukums</div>
                    <div class="text-gray-900 font-medium">{{ number_format($car->mileage) }} km</div>
                </div>
            @endif
            @if($car->price)
                <div class="bg-gray-50 rounded-xl p-4 border border-gray-100">
                    <div class="text-xs text-gray-400 uppercase tracking-wider mb-1">Cena</div>
                    <div class="text-green-600 font-bold text-lg">€ {{ number_format($car->price) }}</div>
                </div>
            @endif
        </div>

        {{-- External link --}}
        <div class="border-t border-gray-100 pt-6">
            <a href="{{ $car->url }}" target="_blank" rel="noopener noreferrer"
                class="inline-flex items-center justify-center space-x-3 w-full px-6 py-3 bg-blue-600 hover:bg-blue-500
                       text-white font-semibold rounded-xl transition shadow-lg">
                <span>Apskatīt oriģinālo sludinājumu</span>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                </svg>
            </a>
        </div>

        </div>{{-- end p-8 --}}
    </div>
</div>
@endsection
