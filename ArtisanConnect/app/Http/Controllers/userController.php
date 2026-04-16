<?php

namespace App\Http\Controllers;

use App\Models\User;

class userController extends Controller
{
    public function index()
    {

        $users = User::latest()->paginate(10);
        return view('Admin.users', compact('users'));
    }


    public function toggleStatus(User $user)
    {

        $user->is_active = !$user->is_active;
        $user->save();

        return back()->with('success', 'Statut de l\'utilisateur mis à jour !');
    }
}
