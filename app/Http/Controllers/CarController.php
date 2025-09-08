<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::latest()->paginate(20);
        return view('cars.index', compact('cars'));
    }
}
