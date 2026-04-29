<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    use HasFactory;
    
    // En aquest model, definim les propietats de la zona i la relació amb les reserves.
    // Cada zona pot tenir moltes reserves associades.
    protected $fillable = [
        'name',
        'description',
        'max_capacity',
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}