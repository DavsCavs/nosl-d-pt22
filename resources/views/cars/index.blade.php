@extends('layouts.app')

@section('title', 'Sludinājumi — My Baltic Car')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    {{-- Filter bar --}}
    <div class="bg-white/10 backdrop-blur-md rounded-2xl p-5 mb-6 border border-white/20">
        <form action="{{ route('cars.index') }}" method="GET">
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-8 gap-3 mb-3">
                <div class="col-span-2">
                    <input type="text" name="search" value="{{ $search ?? '' }}"
                        placeholder="Vispārīgā meklēšana..."
                        class="w-full px-3 py-2 rounded-lg bg-white border border-gray-300 text-gray-900 placeholder-gray-400
                               focus:outline-none focus:ring-2 focus:ring-blue-400 text-sm">
                </div>
                <input type="text" name="brand" value="{{ request('brand') }}"
                    placeholder="Marka"
                    class="px-3 py-2 rounded-lg bg-white border border-gray-300 text-gray-900 placeholder-gray-400
                           focus:outline-none focus:ring-2 focus:ring-blue-400 text-sm">
                <input type="text" name="model" value="{{ request('model') }}"
                    placeholder="Modelis"
                    class="px-3 py-2 rounded-lg bg-white border border-gray-300 text-gray-900 placeholder-gray-400
                           focus:outline-none focus:ring-2 focus:ring-blue-400 text-sm">
                <input type="number" name="price_from" value="{{ request('price_from') }}"
                    placeholder="Cena no €"
                    class="px-3 py-2 rounded-lg bg-white border border-gray-300 text-gray-900 placeholder-gray-400
                           focus:outline-none focus:ring-2 focus:ring-blue-400 text-sm">
                <input type="number" name="price_to" value="{{ request('price_to') }}"
                    placeholder="Cena līdz €"
                    class="px-3 py-2 rounded-lg bg-white border border-gray-300 text-gray-900 placeholder-gray-400
                           focus:outline-none focus:ring-2 focus:ring-blue-400 text-sm">
                <input type="number" name="year_from" value="{{ request('year_from') }}"
                    placeholder="Gads no" min="1900" max="2025"
                    class="px-3 py-2 rounded-lg bg-white border border-gray-300 text-gray-900 placeholder-gray-400
                           focus:outline-none focus:ring-2 focus:ring-blue-400 text-sm">
                <input type="number" name="year_to" value="{{ request('year_to') }}"
                    placeholder="Gads līdz" min="1900" max="2025"
                    class="px-3 py-2 rounded-lg bg-white border border-gray-300 text-gray-900 placeholder-gray-400
                           focus:outline-none focus:ring-2 focus:ring-blue-400 text-sm">
            </div>
            <div class="flex gap-3">
                <button type="submit"
                    class="px-5 py-2 bg-blue-600 hover:bg-blue-500 text-white text-sm font-medium rounded-lg transition
                           flex items-center space-x-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <span>Meklēt</span>
                </button>
                <a href="{{ route('cars.index') }}"
                    class="px-5 py-2 bg-white/10 hover:bg-white/20 text-white text-sm font-medium rounded-lg
                           transition border border-white/30">
                    Notīrīt
                </a>
            </div>
        </form>
    </div>

    {{-- Results header --}}
    <div class="flex items-center justify-between mb-5">
        <h2 class="text-2xl font-bold text-white">
            @if($search || request('brand') || request('model') || request('price_from') || request('price_to') || request('year_from') || request('year_to'))
                Meklēšanas rezultāti
            @else
                Visi sludinājumi
            @endif
        </h2>
        <span class="text-gray-300 text-sm bg-white/10 px-3 py-1 rounded-full border border-white/20">
            {{ $cars->total() }} sludinājumi
        </span>
    </div>

    @if($cars->isEmpty())
        <div class="text-center py-20 bg-white/10 rounded-2xl border border-white/20">
            <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                    d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <p class="text-gray-300 text-lg font-medium">Nav atrasts neviens sludinājums</p>
            <p class="text-gray-400 mt-2">Mēģini mainīt meklēšanas parametrus</p>
            <a href="{{ route('cars.index') }}"
                class="inline-block mt-5 px-6 py-2 bg-blue-600 hover:bg-blue-500 text-white rounded-lg transition">
                Skatīt visus
            </a>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($cars as $car)
                <div class="bg-white/10 backdrop-blur-md rounded-xl border border-white/20 card-hover flex flex-col overflow-hidden">

                    {{-- Car image --}}
                    @if($car->image_url)
                        <img src="{{ $car->image_url }}" alt="{{ $car->brand }} {{ $car->model }}"
                            class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gradient-to-br from-blue-900/60 to-blue-700/40 flex items-center justify-center">
                            <svg class="w-20 h-20 text-blue-300/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                    d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                    d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10l2 2h10z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                    d="M16 16l2-8h2l2 8"/>
                            </svg>
                        </div>
                    @endif

                    <div class="p-5 flex flex-col flex-grow">
                        <div class="flex items-center justify-between mb-2">
                            <span class="bg-blue-600/50 text-blue-100 text-xs font-semibold px-2.5 py-1 rounded-full">
                                {{ $car->brand }}
                            </span>
                            @if($car->year)
                                <span class="text-gray-400 text-xs">{{ $car->year }}</span>
                            @endif
                        </div>

                        <h3 class="text-lg font-bold text-white mb-3">
                            {{ $car->brand }} {{ $car->model }}
                        </h3>

                        <div class="space-y-2 flex-grow text-sm">
                            @if($car->engine_size)
                                <div class="flex items-center space-x-2 text-gray-300">
                                    <svg class="w-4 h-4 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/>
                                    </svg>
                                    <span>{{ $car->engine_size }}</span>
                                </div>
                            @endif
                            @if($car->mileage)
                                <div class="flex items-center space-x-2 text-gray-300">
                                    <svg class="w-4 h-4 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                    </svg>
                                    <span>{{ number_format($car->mileage) }} km</span>
                                </div>
                            @endif
                        </div>

                        <div class="mt-4 pt-4 border-t border-white/10 flex items-center justify-between">
                            <span class="text-xl font-bold text-green-400">
                                {{ $car->price ? '€ ' . number_format($car->price) : '—' }}
                            </span>
                            <a href="{{ route('cars.show', $car->id) }}"
                                class="px-3 py-1.5 bg-blue-600 hover:bg-blue-500 text-white text-sm font-medium rounded-lg transition">
                                Skatīt
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-8 flex justify-center">
            {{ $cars->appends(request()->query())->links() }}
        </div>
    @endif

</div>
@endsection
