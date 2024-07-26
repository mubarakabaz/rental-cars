@extends('layouts.app')

@section('content')
    <h2>Car Details</h2>

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $car->brand }} {{ $car->model }}</h5>
            <p class="card-text">License Plate: {{ $car->license_plate }}</p>
            <p class="card-text">Daily Rate: {{ $car->daily_rate, 2 }}</p>
            <p class="card-text">Availability: {{ $car->is_available ? 'Available' : 'Not Available' }}</p>
        </div>
    </div>
@endsection
