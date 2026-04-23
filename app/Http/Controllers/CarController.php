<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller{

    public function index(Request $request)
    {
        $search    = $request->input('search');
        $brand     = $request->input('brand');
        $model     = $request->input('model');
        $yearFrom  = $request->input('year_from');
        $yearTo    = $request->input('year_to');
        $priceFrom = $request->input('price_from');
        $priceTo   = $request->input('price_to');
        $sort      = $request->input('sort', 'newest');

        $sortOptions = [
            'newest'          => ['created_at', 'desc'],
            'price_asc'       => ['price',      'asc'],
            'price_desc'      => ['price',      'desc'],
            'mileage_asc'     => ['mileage',    'asc'],
            'mileage_desc'    => ['mileage',    'desc'],
            'year_desc'       => ['year',       'desc'],
            'year_asc'        => ['year',       'asc'],
        ];

        [$sortColumn, $sortDirection] = $sortOptions[$sort] ?? $sortOptions['newest'];

        $cars = Car::query()
            ->when($search, function ($q) use ($search) {
                $q->where(function ($q) use ($search) {
                    $q->where('brand', 'like', "%{$search}%")
                      ->orWhere('model', 'like', "%{$search}%")
                      ->orWhere('year', 'like', "%{$search}%")
                      ->orWhere('engine_size', 'like', "%{$search}%")
                      ->orWhere('price', 'like', "%{$search}%");
                });
            })
            ->when($brand,     fn($q) => $q->where('brand', 'like', "%{$brand}%"))
            ->when($model,     fn($q) => $q->where('model', 'like', "%{$model}%"))
            ->when($yearFrom,  fn($q) => $q->where('year', '>=', $yearFrom))
            ->when($yearTo,    fn($q) => $q->where('year', '<=', $yearTo))
            ->when($priceFrom, fn($q) => $q->where('price', '>=', $priceFrom))
            ->when($priceTo,   fn($q) => $q->where('price', '<=', $priceTo))
            ->orderBy($sortColumn, $sortDirection)
            ->paginate(20);

        return view('cars.index', compact('cars', 'search', 'sort'));
    }

    public function show($id)
    {
        $car = Car::findOrFail($id);

        return view('cars.show', compact('car'));
    }

}