<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class userController extends Controller
{
    public function index()
    {

        $users = User::latest()->paginate(25);
        return view('Admin.users', compact('users'));
    }


    public function toggleStatus(User $user)
    {

        $user->is_active = !$user->is_active;
        $user->save();

        return back()->with('success', 'Statut de l\'utilisateur mis à jour !');
    }
    public function profile_edit()
    {

        $user = auth()->user();
        return view('client.profile', compact('user'));
    }
    public function profile_update(Request $request)
    {
        $user = auth()->user();

        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return back()->with('success', 'Profil mis à jour !');
    }
}
