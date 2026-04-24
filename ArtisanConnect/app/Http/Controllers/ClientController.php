<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Auth;
use App\Models\Booking;
use App\Models\Category;
use App\Models\City;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {


        $user = auth()->user();
        $categories = Category::all();
        return view('welcome', [
            'user' => $user,
            'categories' => $categories
        ]);
    }
    public function search(Request $request)
    {
        $categories = Category::all();
        $villes = City::all();

        $query = Service::with(['artisan', 'category']);


        if ($request->filled('city')) {
            $query->whereHas('artisan', function ($q) use ($request) {
                $q->where('city', $request->city);
            });
        }


        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $services = $query->get();

        return view('client.search_results', compact('services', 'categories', 'villes'));
    }
    public function showService($id)
    {

        $service = Service::with(['artisan', 'city', 'category'])->findOrFail($id);

        return view('client.service_details', compact('service'));
    }
    public function showProfile($id)
    {

        $artisan = User::with('services.category', 'services.city')->where('roles', 'artisan')->findOrFail($id);

        return view('client.artisan_profile', compact('artisan'));
    }
    public function dashboard()
    {

        $myBookings = Booking::with(['service', 'artisan'])
            ->where('user_id', Auth()->id())
            ->latest()
            ->get();
        $stats = [
            'pending' => $myBookings->where('status', 'pending')->count(),
            'accepted' => $myBookings->where('status', 'accepted')->count(),
            'total' => $myBookings->count(),
        ];

        return view('client.dashboard', compact('myBookings', 'stats'));
    }
    public function bookings()
    {

        $bookings = \App\Models\Booking::with(['service', 'artisan'])
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('client.bookings', compact('bookings'));
    }
    public function destroy($id)
    {

        $booking = \App\Models\Booking::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $booking->delete();

        return back()->with('success', 'La réservation a été annulée.');
    }
}
