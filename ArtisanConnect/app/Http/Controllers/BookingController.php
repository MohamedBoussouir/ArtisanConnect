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
            'artisan_id'        => 'required',
            'service_id'        => 'required',
            'appointment_date'  => 'required|date',
            'appointment_time'  => 'required',
            'issue_description' => 'required|string|min:5',
        ]);

        $alreadyBooked = Booking::where('artisan_id', $request->artisan_id)
            ->where('appointment_date', $request->appointment_date)
            ->exists();

        $Service = Service::findOrFail($request->service_id);
        $duration = $Service->duration;


        $requestedStart = $request->appointment_time;

        $requestedEnd = date('H:i', strtotime("$requestedStart + $duration hours"));


        $dayBookings = Booking::where('artisan_id', $request->artisan_id)
            ->where('appointment_date', $request->appointment_date)
            ->get();

                
       

        $service = Service::findOrFail($request->service_id);


        Booking::create([
            'user_id'           => auth()->id(),
            'artisan_id'        => $request->artisan_id,
            'service_id'        => $request->service_id,
            'appointment_date'  => $request->appointment_date,
            'appointment_time'  => $request->appointment_time,
            'duration_hours'    => $service->duration,
            'issue_description' => $request->issue_description,
            'status'            => 'pending',
        ]);

        return back()->with('success', 'Votre réservation a été effectuée avec succès.');
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
