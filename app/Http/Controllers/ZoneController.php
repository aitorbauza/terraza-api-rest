<?php

namespace App\Http\Controllers;

use App\Models\Zone;
use App\Models\Reservation;
use Illuminate\Http\Request;

// FEATURE ZONES - Endpoints públics per consultar zones i disponibilitat
class ZoneController extends Controller
{
    // Llistar totes les zones
    public function index()
    {
        return response()->json(Zone::all());
    }

    // Veure disponibilitat d'una zona en una data
    public function availability($id, Request $request)
    {
        $request->validate([
            'date' => 'required|date|after_or_equal:today',
        ]);

        $zone = Zone::findOrFail($id);
        
        $reservationsCount = Reservation::where('zone_id', $id)
            ->where('reservation_date', $request->date)
            ->where('status', 'confirmed')
            ->sum('guests');
        
        $available = ($zone->max_capacity - $reservationsCount) > 0;
        
        return response()->json([
            'zone' => $zone->name,
            'date' => $request->date,
            'available' => $available,
            'available_capacity' => max(0, $zone->max_capacity - $reservationsCount)
        ]);
    }
}