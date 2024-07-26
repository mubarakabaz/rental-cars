<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Car;

class CarSeeder extends Seeder
{
    public function run()
    {
        Car::create([
            'brand' => 'Toyota',
            'model' => 'Camry',
            'license_plate' => 'ABC1234',
            'daily_rate' => 500000,
            'is_available' => true
        ]);

        Car::create([
            'brand' => 'Honda',
            'model' => 'Civic',
            'license_plate' => 'XYZ5678',
            'daily_rate' => 400000,
            'is_available' => true
        ]);

        Car::create([
            'brand' => 'Ford',
            'model' => 'Mustang',
            'license_plate' => 'LMN9101',
            'daily_rate' => 750000,
            'is_available' => false
        ]);
    }
}
