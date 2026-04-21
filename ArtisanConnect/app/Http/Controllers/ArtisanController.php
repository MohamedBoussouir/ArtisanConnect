<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArtisanController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $profile = $user->artisanProfile;
        $artisanProfile = auth()->user()->load('artisanProfile.category');
        $stats = [
            'views' => $profile->views_count ?? 0,
            'rating' => number_format($profile->rating_cache ?? 0, 1),

            'works' => $profile ? $profile->portfolios()->count() : 0,

            'new_reviews' => $user->reviewsReceived()->whereDate('created_at', now())->count()
        ];
        $portfolios = auth()->user()->portfolios()->latest()->get();


        return view('Artisan.dashboard', [
            'user' => $user,
            'stats' => $stats,
            'artisanProfile' => $artisanProfile,
            'portfolios' => $portfolios
        ]);
    }
    public function edit()
    {
        $user = auth()->user();
        $categories = \App\Models\Category::all();
        // dd($categories[0]->id);
        return view('Artisan.edit-profile', compact('user', 'categories'));
    }


    public function update(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'bio' => 'nullable|string|max:1500',
        ]);

        $user = auth()->user();


        $user->artisanProfile()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'category_id' => $request->category_id,
                'bio' => $request->bio
            ]
        );

        return redirect()->route('artisan.dashboard');
    }
}
