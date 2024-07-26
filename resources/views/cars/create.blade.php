@extends('layouts.app')

@section('content')
    <h2>Add New Car</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('cars.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="brand">Brand</label>
            <input type="text" id="brand" name="brand" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="model">Model</label>
            <input type="text" id="model" name="model" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="license_plate">License Plate</label>
            <input type="text" id="license_plate" name="license_plate" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="daily_rate">Daily Rate</label>
            <input type="number" id="daily_rate" name="daily_rate" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="is_available">Is Available</label>
            <select id="is_available" name="is_available" class="form-control" required>
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Add Car</button>
    </form>
@endsection
