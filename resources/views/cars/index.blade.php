@extends('layouts.app')

@section('title', 'Rezultāti')

@section('content')
<div class="p-8">
    <h2 class="text-3xl font-semibold mb-6 text-center">Meklēšanas rezultāti</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($cars as $car)
            <div class="bg-white/10 backdrop-blur-md rounded-xl shadow-md p-4 hover:shadow-lg transition">
                <h3 class="text-xl font-bold mb-2">{{ $car->title }}</h3>
                <p><strong>Gads:</strong> {{ $car->year }}</p>
                <p><strong>Motors:</strong> {{ $car->engine_size }}</p>
                <p><strong>Nobraukums:</strong> {{ $car->mileage }}</p>
                <p class="text-lg font-semibold text-blue-300 mt-2">{{ $car->price }}</p>
                <a href="{{ $car->url }}" target="_blank" class="text-blue-200 hover:underline mt-3 inline-block">
                    Apskatīt SS.com
                </a>
            </div>
        @endforeach
    </div>
    <div class="mt-6">
        {{ $cars->links() }}
    </div>
</div>
@endsection
