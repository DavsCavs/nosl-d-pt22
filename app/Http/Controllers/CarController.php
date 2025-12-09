<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller{

    public function index(Request $request){
        $search = $request->input('search');

        $cars = Car::when($search, function ($query, $search) {
            $query->where(function ($q) use ($search) {
                $q->where('model', 'like', "%{$search}%")
                ->orWhere('brand', 'like', "%{$search}%")
                ->orWhere('year', 'like', "%{$search}%")
                ->orWhere('engine_size', 'like', "%{$search}%")
                ->orWhere('mileage', 'like', "%{$search}%")
                ->orWhere('price', 'like', "%{$search}%");
            });
        })
        ->latest()
        ->paginate(20);


        return view('cars.index', compact('cars', 'search'));
    }

}