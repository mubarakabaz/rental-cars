<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand',
        'model',
        'license_plate',
        'daily_rate',
        'is_available',
    ];

    public function rentals() {
        return $this->hasMany(Rental::class);
    }

}
