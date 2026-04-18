<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        
        $services = auth()->user()->services()->latest()->get();

        
        return view('Artisan.services', compact('services'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'nullable|numeric',
            'duration' => 'nullable|string',
        ]);

        Service::create([
            'artisan_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'duration' => $request->duration,
        ]);

        return back()->with('success', 'Service ajouté avec succès !');
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
