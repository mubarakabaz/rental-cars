<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'John Doe',
            'address' => '123 Main Street',
            'phone' => '1234567890',
            'license_number' => '91821934834582465',
            'email' => 'john@mail.com',
            'password' => Hash::make('password'),
        ]);
        User::create([
            'name' => 'Jane Smith',
            'address' => '123 Main Street',
            'phone' => '819214154',
            'license_number' => '91821754834586781',
            'email' => 'jane@mail.com',
            'password' => Hash::make('password'),
        ]);
    }
}
