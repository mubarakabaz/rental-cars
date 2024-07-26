@extends('layouts.app')

@section('content')
    <h2>Return Car</h2>

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('rentals.return') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="license_plate">License Plate</label>
            <input type="text" id="license_plate" name="license_plate" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Return Car</button>
    </form>
@endsection
