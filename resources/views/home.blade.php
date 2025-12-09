@extends('layouts.app')

@section('title', 'Sākumlapa')

@section('content')
<div class="flex items-center justify-center min-h-[80vh]">
    <div class="max-w-2xl w-full bg-white/10 backdrop-blur-md rounded-2xl shadow-xl p-8 fade-in">
        <h1 class="text-4xl font-bold text-center mb-4">Lietoto auto meklētājs</h1>
        <p class="text-center text-gray-200 mb-8">
            Ievadi jebkuru parametru, piemēram <strong>marku, modeli vai cenu</strong>, lai atrastu auto.
        </p>

        <form action="{{ route('cars.index') }}" method="GET" class="space-y-4">
            {{-- Vienkāršota meklēšana – pietiek ar vienu lauku --}}
            <div class="grid grid-cols-1">
                <input type="text" name="search" placeholder="Meklēt (piem., BMW 730 vai 5000€)"
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 text-gray-800 focus:ring focus:ring-blue-300" />
            </div>

            <div class="text-center">
                <button type="submit"
                    class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-lg transition">
                    Meklēt
                </button>
            </div>
        </form>

        <div class="mt-8 text-center">
            <a href="{{ route('cars.index') }}" class="text-gray-300 hover:text-white underline text-sm">
                Pārlūkot visus sludinājumus
            </a>
        </div>
    </div>
</div>
@endsection
