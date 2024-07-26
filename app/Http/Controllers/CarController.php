<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;

class CarController extends Controller
{
    // Show all cars
    public function index(Request $request)
    {
        $query = Car::query();

        // Apply filters if any
        if ($request->filled('brand')) {
            $query->where('brand', 'like', '%' . $request->input('brand') . '%');
        }

        if ($request->filled('model')) {
            $query->where('model', 'like', '%' . $request->input('model') . '%');
        }

        if ($request->filled('is_available')) {
            $isAvailable = $request->input('is_available') === '1';
            $query->where('is_available', $isAvailable);
        }

        $cars = $query->get();

        return view('cars.index', compact('cars'));
    }

    // Show create car form
    public function create()
    {
        return view('cars.create');
    }

    // Store a new car
    public function store(Request $request)
    {
        $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'license_plate' => 'required|string|max:255|unique:cars',
            'daily_rate' => 'required|numeric|min:0',
            'is_available' => 'required|boolean',
        ]);

        Car::create($request->all());

        return redirect()->route('cars.index')->with('success', 'Car added successfully.');
    }

    public function show($id)
    {
        $car = Car::find($id);

        if (!$car) {
            return redirect()->route('cars.index')->with('error', 'Car not found.');
        }

        return view('cars.show', compact('car'));
    }
}
