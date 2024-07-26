<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rental;
use App\Models\User;
use App\Models\Car;
use Carbon\Carbon;

class RentalSeeder extends Seeder
{
    public function run()
    {
        $user1 = User::where('email', 'john@mail.com')->first();
        $user2 = User::where('email', 'jane@mail.com')->first();

        $car1 = Car::where('license_plate', 'ABC1234')->first();
        $car2 = Car::where('license_plate', 'XYZ5678')->first();

        Rental::create([
            'user_id' => $user1->id,
            'car_id' => $car1->id,
            'start_date' => Carbon::now()->subDays(5)->format('Y-m-d'),
            'end_date' => Carbon::now()->format('Y-m-d'),
            'total_cost' => $car1->daily_rate * 6
        ]);

        Rental::create([
            'user_id' => $user2->id,
            'car_id' => $car2->id,
            'start_date' => Carbon::now()->subDays(10)->format('Y-m-d'),
            'end_date' => Carbon::now()->subDays(3)->format('Y-m-d'),
            'total_cost' => $car2->daily_rate * 8
        ]);
    }
}
