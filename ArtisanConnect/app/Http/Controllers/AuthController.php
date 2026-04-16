<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function show_login()
    {
        return view('Auth.login');
    }
    public function login(Request $request)
    {
        $validator = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);
        $test = Auth::attempt($validator, $request->has('remember'));
        if (!$test) {
            return Redirect('/login');
        }
        return Redirect('/dashboard');
    }
    public function show_register()
    {
        return view('Auth.register');
    }
    public function register(Request $request)
    {
        // dd($request);
        Validator::make($request->all(), [
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'phone'    => ['required', 'regex:/^(06|07|05)\d{8}$/'],
            'password' => 'required|string|min:8|confirmed',
            'role'     => 'required|in:client,artisan',
            'city'     => 'required|string|min:4',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'city'     => $request->city,
            'password' => Hash::make($request->password),
            'roles'    => $request->roles,
        ]);
        Auth::login($user);
        return Redirect('/dashboard');
    }
    public function logout()
    {
        auth::logout();
        return Redirect('/');
    }
}
