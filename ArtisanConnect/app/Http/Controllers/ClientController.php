<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index(){
        $user=auth()->user();
        return view('client.dashboard',['user'=>$user]);
    }
}
