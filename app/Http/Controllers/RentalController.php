<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Rental;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class RentalController extends Controller
{
    // Show rental form
    public function create()
    {
        $cars = Car::where('is_available', true)->get();
        return view('rentals.create', compact('cars'));
    }

    // Store rental data
    public function store(Request $request)
    {
        $request->validate([
            'car_id' => 'required|exists:cars,id',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
        ]);

        $car = Car::find($request->car_id);

        // Check availability
        $existingRental = Rental::where('car_id', $request->car_id)
            ->where(function ($query) use ($request) {
                $query->whereBetween('start_date', [$request->start_date, $request->end_date])
                    ->orWhereBetween('end_date', [$request->start_date, $request->end_date]);
            })
            ->exists();

        if ($existingRental) {
            return redirect()->back()->with('error', 'Car is not available for the selected dates.');
        }

        $days = Carbon::parse($request->start_date)->diffInDays($request->end_date);
        $totalAmount = $days * $car->daily_rate;

        Rental::create([
            'car_id' => $request->car_id,
            'user_id' => auth()->id(),
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'total_amount' => $totalAmount,
        ]);

        // Mark the car as unavailable
        $car->update(['is_available' => false]);

        return redirect()->route('rentals.index')->with('success', 'Rental booked successfully.');
    }

    // Show rentals for the authenticated user
    public function index()
    {
        $rentals = Rental::where('user_id', auth()->id())->get();
        return view('rentals.index', compact('rentals'));
    }

    // Return car
    public function returnCar(Request $request)
    {
        $request->validate([
            'license_plate' => 'required|string|exists:cars,license_plate',
        ]);

        $car = Car::where('license_plate', $request->license_plate)->first();
        $rental = Rental::where('car_id', $car->id)
            ->where('user_id', auth()->id())
            ->whereNull('returned_at')
            ->first();

        if (!$rental) {
            return redirect()->back()->with('error', 'No active rental found for this car.');
        }

        $rental->update([
            'returned_at' => now(),
            'total_amount' => $rental->total_amount,
        ]);

        // Mark the car as available
        $car->update(['is_available' => true]);

        return redirect()->route('rentals.index')->with('success', 'Car returned successfully.');
    }
}
