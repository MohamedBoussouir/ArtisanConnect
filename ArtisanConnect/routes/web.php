<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArtisanController;
use App\Http\Controllers\ArtisanProfileController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\userController;
use Faker\Guesser\Name;
use Illuminate\Support\Facades\Route;

// ---------------------------Visiteur---------------------------
Route::get('/', [ClientController::class, 'index']);
// Route::get('/', function () {
//     return view('welcome');
// });

// ---------------------------Auth---------------------------
Route::get('/login', [AuthController::class, 'show_login']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'show_register']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
// ---------------------------User---------------------------

Route::middleware(['Auth', 'CheckRoles'])->group(function () {
    Route::get('/dashboard', function () {})->name('dashboard');

    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/artisan/dashboard', [ArtisanController::class, 'index'])->name('artisan.dashboard');
    Route::get('/client', [ClientController::class, 'index'])->name('client');
    Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {});
});



Route::get('/user/dashboard', [ClientController::class, 'dashboard'])->name('client.dashboard');
Route::get('/client/bookings', [ClientController::class, 'bookings'])->middleware('auth')->name('client.bookings');
Route::delete('/client/bookings/{id}', [ClientController::class, 'destroy'])->name('client.bookings.destroy');
Route::get('/profile/settings', [userController::class, 'profile_edit'])->middleware('auth')->name('client.profile');
Route::put('/profile/settings', [userController::class, 'profile_update'])->name('client.profile.update');

Route::get('admin/categories', [CategoryController::class, 'index'])->name('admin.categories.index');
Route::put('admin/ban_user/{user}', [AdminController::class, 'ban_user'])->name('admin.ban_user');
Route::post('admin/categories', [CategoryController::class, 'store'])->name('admin.categories.store');
Route::delete('/admin/categories/{category}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');


Route::get('/admin/users', [userController::class, 'index'])->name('admin.users.index');
Route::post('/admin/users/{user}/toggle', [userController::class, 'toggleStatus'])->name('admin.users.toggle');

Route::get('/artisan/profile/edit', [ArtisanController::class, 'edit'])->name('artisan.profile.edit');
Route::put('/artisan/profile/update', [ArtisanController::class, 'update'])->name('artisan.profile.update');


Route::get('/artisan/profile/settings', [ArtisanController::class, 'settings'])->name('artisan.profile');


Route::get('/artisan/Mon_Portfolio', [ArtisanProfileController::class, 'index'])->name('artisan.Mon_Portfolio');
Route::get('/artisan/profile/{id}', [ClientController::class, 'showProfile'])->name('artisan.profile');


Route::post('/portfolio/store', [ArtisanProfileController::class, 'store'])->name('artisan.portfolio.store');


Route::delete('/portfolio/{portfolio}', [ArtisanProfileController::class, 'destroy'])->name('artisan.portfolio.destroy');


Route::get('/services', [ServiceController::class, 'index'])->name('artisan.services.index');
Route::post('/services/store', [ServiceController::class, 'store'])->name('artisan.services.store');
Route::delete('/services/{service}', [ServiceController::class, 'destroy'])->name('artisan.services.destroy');
Route::get('/service/{id}', [ClientController::class, 'showService'])->name('services.show');

Route::get('/search', [ClientController::class, 'search'])->name('artisans.search');


Route::get('/admin/City', [CityController::class, 'index'])->name('cities.index');
Route::post('/admin/cities', [CityController::class, 'store'])->name('City.store');
Route::delete('/admin/cities/{city}', [CityController::class, 'destroy'])->name('cities.destroy');


Route::get('/artisan/bookings', [BookingController::class, 'index'])->name('artisan.bookings');
Route::get('/service/{id}/book', [BookingController::class, 'create'])->name('bookings.create');
Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
Route::patch('/bookings/{id}/status', [BookingController::class, 'updateStatus'])->name('bookings.updateStatus');
