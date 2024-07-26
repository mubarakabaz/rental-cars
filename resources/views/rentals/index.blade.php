@extends('layouts.app')

@section('content')
    <h2>Your Rentals</h2>

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
            <a href="{{ route('rentals.create') }}" type="button" class="btn btn-outline-info btn-lg btn-block">Booking New</a>
        </div>
        <div class="card-body">


            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Car</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Total Cost</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rentals as $rental)
                        <tr>
                            <td>{{ $rental->car->brand }} {{ $rental->car->model }}</td>
                            <td>{{ $rental->start_date }}</td>
                            <td>{{ $rental->end_date }}</td>
                            <td>{{ number_format($rental->total_cost, 2) }}</td>
                            <td>
                                @if ($rental->returned_at)
                                    Returned
                                @else
                                    <!-- Form for returning the car -->
                                    <form action="{{ route('rentals.return') }}" method="POST" class="d-inline">
                                        @csrf
                                        <input type="hidden" name="license_plate" value="{{ $rental->car->license_plate }}">
                                        <button type="submit" class="btn btn-info btn-sm">Return Car</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">
                                No rentals found.
                                @auth
                                    <a href="{{ route('rentals.create') }}" class="btn-sm btn-outline-danger mx-auto m3-3">Rental
                                        Now</a>
                                @endauth
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
