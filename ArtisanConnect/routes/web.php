<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArtisanController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\userController;
use Faker\Guesser\Name;
use Illuminate\Support\Facades\Route;

// ---------------------------Visiteur---------------------------
Route::get('/', function () {
    return view('welcome');
});

// ---------------------------Auth---------------------------
Route::get('/login', [AuthController::class, 'show_login']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'show_register']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/logout', [AuthController::class, 'logout']);
// ---------------------------User---------------------------

Route::middleware(['Auth', 'CheckRoles'])->group(function () {
    Route::get('/dashboard', function () {})->name('dashboard');

    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/artisan/dashboard', [ArtisanController::class, 'index'])->name('artisan.dashboard');
    Route::get('/client/dashboard', [ClientController::class, 'index'])->name('client.dashboard');
    Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {});
});
Route::get('admin/categories', [CategoryController::class, 'index'])->name('admin.categories.index');
Route::put('admin/ban_user/{user}', [AdminController::class, 'ban_user'])->name('admin.ban_user');
Route::post('admin/categories', [CategoryController::class, 'store'])->name('admin.categories.store');
Route::delete('/admin/categories/{category}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');


Route::get('/admin/users', [userController::class, 'index'])->name('admin.users.index');
Route::post('/admin/users/{user}/toggle', [userController::class, 'toggleStatus'])->name('admin.users.toggle');

Route::get('/artisan/profile/edit', [ArtisanController::class, 'edit'])->name('artisan.profile.edit');
Route::put('/artisan/profile/update', [ArtisanController::class, 'update'])->name('artisan.profile.update');
// Portfolio
Route::get('/artisan/Mon_Portfolio', [PortfolioController::class, 'index'])->name('artisan.Mon_Portfolio');
