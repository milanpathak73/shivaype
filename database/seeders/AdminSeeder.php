<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    public function run()
    {
        Admin::create([
            'username' => 'milanpathak73@gmail.com',
            'password' => Hash::make('6619.Milan'),
        ]);
    }
}
