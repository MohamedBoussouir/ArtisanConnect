<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use PDO;

class AdminController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();


        $totalArtisans = User::where('roles', 'artisan')->count();


        $newClients = User::where('roles', 'client')
            ->where('created_at', '>=', now()->subDays(30))
            ->count();

        $news = User::where('created_at', '>=', now()->subDays(1))->get();
        // dd($news[0]);
        return view('Admin.dashboard', compact('totalUsers', 'totalArtisans', 'newClients', 'news'));
    }

    public function ban_user(user $user)
    {
        if ($user->is_bane == 'no') {

            $user->is_bane = '';
        } else {

            $user->is_bane = 'no';
        }
        $user->update();
        return Redirect('/admin/dashboard');
    }
}
