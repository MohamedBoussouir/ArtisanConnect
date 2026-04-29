<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $cities = City::all();
        $services = auth()->user()->services()->latest()->get();
        $categories = \App\Models\Category::all();

        return view('Artisan.services', compact('services', 'user', 'categories', 'cities'));
    }
    public function store(Request $request)
    {

        $request->validate([
            'title'       => 'required|string|max:255',
            'price'       => 'required|numeric',
            'duration'    => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'city_id'     => 'required|exists:cities,id',
            'description' => 'required|string|min:10',
            'image'       => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);


        $imagePath = null;
        if ($request->hasFile('image')) {

            $imagePath = $request->file('image')->store('services', 'public');
        }


        Service::create([
            'artisan_id'  => auth()->id(),
            'category_id' => $request->category_id,
            'city_id'     => $request->city_id,
            'title'       => $request->title,
            'description' => $request->description,
            'price'       => $request->price,
            'duration'    => $request->duration,
            'image'       => $imagePath,
        ]);

        return back()->with('success', 'Votre service a été publié avec succès !');
    }


    public function destroy(Service $service)
    {

        if ($service->artisan_id !== auth()->id()) {
            abort(403);
        }

        $service->delete();
        return back()->with('success', 'Service supprimé !');
    }
}
