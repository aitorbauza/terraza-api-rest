<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Zone;

class ZoneSeeder extends Seeder
{
    public function run(): void
    {
        Zone::create([
            'name' => 'Lounge',
            'description' => 'Zona chill-out amb música ambiental',
            'max_capacity' => 30
        ]);

        Zone::create([
            'name' => 'VIP',
            'description' => 'Àrea exclusiva amb vistes privilegiades',
            'max_capacity' => 15
        ]);

        Zone::create([
            'name' => 'Barra',
            'description' => 'Junt al bartender, ambient animat',
            'max_capacity' => 20
        ]);

        Zone::create([
            'name' => 'Jardí',
            'description' => 'Exterior envoltat de vegetació',
            'max_capacity' => 40
        ]);
    }
}