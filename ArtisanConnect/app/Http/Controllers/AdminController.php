<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();

        
        $totalArtisans = User::where('roles', 'artisan')->count();

        
        $newClients = User::where('roles', 'client')
            ->where('created_at', '>=', now()->subDays(30))
            ->count();

        return view('Admin.dashboard', compact('totalUsers', 'totalArtisans', 'newClients'));
    }
}
