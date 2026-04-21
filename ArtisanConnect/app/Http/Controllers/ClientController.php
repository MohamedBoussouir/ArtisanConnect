<?php

namespace App\Http\Controllers;

use App\Models\Category;
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
        $query = User::where('roles', 'artisan');

        
        if ($request->filled('city')) {
            $query->where('city', $request->city);
        }

       
        if ($request->filled('category')) {
            $query->whereHas('artisanProfile', function ($q) use ($request) {
                $q->where('category_id', $request->category);
            });
        }

        $artisans = $query->get();

        return view('client.search_results', compact('artisans','categories'));
    }
}
