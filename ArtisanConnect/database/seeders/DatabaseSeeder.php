<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\City;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        
        $cities = [
            ['name' => 'Casablanca'],
            ['name' => 'Rabat'],
            ['name' => 'Marrakech'],
            ['name' => 'Youssoufia'],
            ['name' => 'Safi'],
        ];

        foreach ($cities as $city) {
            City::create($city);
        }

       
        $categories = [
            ['name' => 'Plomberie', 'icon' => 'fa-faucet'],
            ['name' => 'Électricité', 'icon' => 'fa-bolt'],
            ['name' => 'Menuiserie', 'icon' => 'fa-hammer'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        
        User::factory()->create([
            'name' => 'Mohammed Dev',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin@admin.com'),
            'city' => 'Youssoufia',
            'roles' => 'Admin', 
            'phone' => '0600000000', 
        ]);
    }
}
