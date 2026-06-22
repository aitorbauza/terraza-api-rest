<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

// FEATURE RESERVATIONS - Endpoints privats per crear reserves i llistar-les
class ReservationController extends Controller
{
    // Crear una reserva
    public function store(Request $request)
    {
        $request->validate([
            'zone_id' => 'required|exists:zones,id',
            'reservation_date' => 'required|date|after_or_equal:today',
            'reservation_time' => 'required|date_format:H:i',
            'guests' => 'required|integer|min:1|max:10'
        ]);

        $reservation = Reservation::create([
            'user_id' => $request->user()->id,
            'zone_id' => $request->zone_id,
            'reservation_date' => $request->reservation_date,
            'reservation_time' => $request->reservation_time,
            'guests' => $request->guests,
            'status' => 'confirmed'
        ]);

        return response()->json($reservation, 201);
    }

    // Veure les reserves de l'usuari autenticat
    public function myReservations(Request $request)
    {
        $reservations = Reservation::where('user_id', $request->user()->id)
            ->with('zone')
            ->orderBy('reservation_date', 'desc')
            ->get();
        
        return response()->json($reservations);
    }
}