@extends('layouts.app')

@section('title', 'My Baltic Car — Lietoto auto meklētājs')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">

    {{-- Hero --}}
    <div class="text-center fade-in mb-12">
        <h1 class="text-5xl font-extrabold text-white mb-4 leading-tight">
            Atrodi savu ideālo auto
        </h1>
        <p class="text-xl text-blue-200 max-w-2xl mx-auto">
            Visi lietoto auto sludinājumi no SS.com (LV), Autoportaal (EE) un Autogidas (LT) — vienā vietā.
            Meklē pēc markas, modeļa, gada vai cenas.
        </p>
    </div>

    {{-- Search card --}}
    <div class="max-w-4xl mx-auto bg-white/10 backdrop-blur-md rounded-2xl shadow-2xl p-8 fade-in border border-white/20">
        <form action="{{ route('cars.index') }}" method="GET" class="space-y-5">

            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Vispārīgā meklēšana</label>
                <input type="text" name="search" value="{{ old('search') }}"
                    placeholder="Meklēt (piem., BMW, Corolla, 2020...)"
                    class="w-full px-4 py-3 rounded-xl bg-white border border-gray-300 text-gray-900 placeholder-gray-400
                           focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent">
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Marka</label>
                    <input type="text" name="brand" value="{{ old('brand') }}"
                        placeholder="BMW, Toyota..."
                        class="w-full px-3 py-2 rounded-lg bg-white border border-gray-300 text-gray-900 placeholder-gray-400
                               focus:outline-none focus:ring-2 focus:ring-blue-400 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Modelis</label>
                    <input type="text" name="model" value="{{ old('model') }}"
                        placeholder="X5, Corolla..."
                        class="w-full px-3 py-2 rounded-lg bg-white border border-gray-300 text-gray-900 placeholder-gray-400
                               focus:outline-none focus:ring-2 focus:ring-blue-400 text-sm">
                </div>
                <div class="col-span-2 md:col-span-1 grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Gads no</label>
                        <input type="number" name="year_from" value="{{ old('year_from') }}"
                            placeholder="2000" min="1900" max="2025"
                            class="w-full px-3 py-2 rounded-lg bg-white border border-gray-300 text-gray-900 placeholder-gray-400
                                   focus:outline-none focus:ring-2 focus:ring-blue-400 text-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Gads līdz</label>
                        <input type="number" name="year_to" value="{{ old('year_to') }}"
                            placeholder="2025" min="1900" max="2025"
                            class="w-full px-3 py-2 rounded-lg bg-white border border-gray-300 text-gray-900 placeholder-gray-400
                                   focus:outline-none focus:ring-2 focus:ring-blue-400 text-sm">
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Cena no (€)</label>
                    <input type="number" name="price_from" value="{{ old('price_from') }}"
                        placeholder="500" min="0"
                        class="w-full px-3 py-2 rounded-lg bg-white border border-gray-300 text-gray-900 placeholder-gray-400
                               focus:outline-none focus:ring-2 focus:ring-blue-400 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Cena līdz (€)</label>
                    <input type="number" name="price_to" value="{{ old('price_to') }}"
                        placeholder="30000" min="0"
                        class="w-full px-3 py-2 rounded-lg bg-white border border-gray-300 text-gray-900 placeholder-gray-400
                               focus:outline-none focus:ring-2 focus:ring-blue-400 text-sm">
                </div>
            </div>

            <div class="flex flex-col sm:flex-row gap-3 pt-2">
                <button type="submit"
                    class="flex-1 sm:flex-none px-8 py-3 bg-blue-600 hover:bg-blue-500 text-white font-semibold rounded-xl
                           shadow-lg transition flex items-center justify-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <span>Meklēt</span>
                </button>
                <a href="{{ route('cars.index') }}"
                    class="flex-1 sm:flex-none px-8 py-3 bg-white/10 hover:bg-white/20 text-white font-semibold rounded-xl
                           transition text-center border border-white/30">
                    Visi sludinājumi
                </a>
            </div>
        </form>
    </div>

    {{-- Stats --}}
    <div class="mt-14 grid grid-cols-3 gap-6 max-w-sm mx-auto text-center fade-in">
        <div>
            <div class="text-3xl font-bold text-white">3</div>
            <div class="text-sm text-blue-300 mt-1">Valstis</div>
        </div>
        <div>
            <div class="text-3xl font-bold text-white">3</div>
            <div class="text-sm text-blue-300 mt-1">Avoti</div>
        </div>
        <div>
            <div class="text-3xl font-bold text-white">100%</div>
            <div class="text-sm text-blue-300 mt-1">Bezmaksas</div>
        </div>
    </div>

</div>
@endsection
