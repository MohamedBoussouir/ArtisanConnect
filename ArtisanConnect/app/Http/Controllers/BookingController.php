<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Auth;
use App\Models\Booking;
use App\Models\Service;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $incomingBookings = Booking::with(['client', 'service'])
            ->where('artisan_id', Auth()->id())
            ->latest()
            ->get();

        return view('artisan.bookings', compact('incomingBookings'));
    }


    public function updateStatus(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);


        if ($booking->artisan_id !== auth()->id()) {
            return back();
        }

        $booking->update([
            'status' => $request->status
        ]);

        $message = $request->status == 'accepted' ? 'Demande acceptée !' : 'Demande refusée.';
        return back()->with('success', $message);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $service = Service::findOrFail($id);

        return view('client.booking_create', compact('service'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'artisan_id' => 'required',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required',
            'duration_hours' => 'required|integer|min:1',
        ]);

        $requestedStart = $request->appointment_time;

        $requestedEnd = date('H:i:s', strtotime("$requestedStart + $request->duration_hours hours"));


        $isBusy = Booking::where('artisan_id', $request->artisan_id)
            ->where('appointment_date', $request->appointment_date)
            ->where(function ($query) use ($requestedStart, $requestedEnd) {
                $query->whereBetween('appointment_time', [$requestedStart, $requestedEnd])
                    ->orWhereRaw('? BETWEEN appointment_time AND 
                        DATE_ADD(appointment_time, INTERVAL duration_hours HOUR)', [$requestedStart]);
            })
            ->exists();

        if ($isBusy) {
            return back()->with('error', 'L\'artisan est occupé خلال هذه الفترة. يرجى اختيار وقت آخر.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        //
    }
}
