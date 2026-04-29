<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'artisan_id' => 'required|exists:users,id',
            'comment'    => 'required|string|min:5',
            'rating'     => 'required|integer|between:1,5',
        ]);

        \App\Models\Review::create([
            'user_id'    => auth()->id(),
            'artisan_id' => $request->artisan_id,
            'comment'    => $request->comment,
            'rating'     => $request->rating,
        ]);

        return back();
    }
}
