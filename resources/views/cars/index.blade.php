@extends('layouts.app')

@section('content')
    <h2>Cars</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="card mt-4">
        <div class="card-title">
                <a href="{{ route('cars.create') }}" type="button" class="btn btn-outline-info btn-lg btn-block">Add A New Car</a>
        </div>
        <div class="card-body">

            <!-- Search Form -->
            <form action="{{ route('cars.index') }}" method="GET" class="mb-4">
                @csrf
                <div class="row">
                    <div class="col-md-3">
                        <input type="text" name="brand" class="form-control" placeholder="Brand"
                            value="{{ request('brand') }}">
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="model" class="form-control" placeholder="Model"
                            value="{{ request('model') }}">
                    </div>
                    <div class="col-md-3">
                        <select name="is_available" class="form-control">
                            <option value="">Availability</option>
                            <option value="1" {{ request('is_available') === '1' ? 'selected' : '' }}>Available
                            </option>
                            <option value="0" {{ request('is_available') === '0' ? 'selected' : '' }}>Not Available
                            </option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </div>
            </form>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Brand</th>
                        <th>Model</th>
                        <th>License Plate</th>
                        <th>Daily Rate</th>
                        <th>Availability</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($cars as $car)
                        <tr>
                            <td>{{ $car->brand }}</td>
                            <td>{{ $car->model }}</td>
                            <td>{{ $car->license_plate }}</td>
                            <td>{{ number_format($car->daily_rate, 2) }}</td>
                            <td>{{ $car->is_available ? 'Available' : 'Not Available' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No cars found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
