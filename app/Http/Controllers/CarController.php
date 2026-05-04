<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller{

    public function index(Request $request)
    {
        $sort    = $request->input('sort', 'newest');
        $search  = $request->input('search');
        $country = $request->input('country');

        $sortOptions = [
            'newest'       => ['created_at', 'desc'],
            'price_asc'    => ['price',      'asc'],
            'price_desc'   => ['price',      'desc'],
            'mileage_asc'  => ['mileage',    'asc'],
            'mileage_desc' => ['mileage',    'desc'],
            'year_desc'    => ['year',       'desc'],
            'year_asc'     => ['year',       'asc'],
        ];

        [$sortColumn, $sortDirection] = $sortOptions[$sort] ?? $sortOptions['newest'];

        $cars = Car::filter($request->only([
            'search', 'brand', 'model', 'year_from', 'year_to', 'price_from', 'price_to', 'country',
        ]))->orderBy($sortColumn, $sortDirection)->paginate(20);

        return view('cars.index', ['cars' => $cars, 'search' => $search, 'sort' => $sort, 'country' => $country]);
    }

    public function show($id)
    {
        $car = Car::findOrFail($id);

        return view('cars.show', ['car' => $car]);
    }

}