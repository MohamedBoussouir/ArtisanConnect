<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $services = auth()->user()->services()->latest()->get();
        $categories = \App\Models\Category::all();

        return view('Artisan.services', compact('services', 'user', 'categories'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'nullable|numeric',
            'duration' => 'nullable|string',
            'category_id' => 'nullable',
        ]);
        // dd($request->category_id);

        Service::create([
            'artisan_id' => auth()->id(),
            'category_id' => $request->category_id,
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'duration' => $request->duration,
        ]);

        return back();
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
