<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\City;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        // dd();

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
}
