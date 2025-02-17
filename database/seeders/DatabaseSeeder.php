<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin123@gmail.com',
            'phone' => '09654789321',
            'role' => 'admin',
            'gender' => 'male',
            'address' => 'Yangon',
            'password' => Hash::make('admin123')
        ]);
    }
}
