<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'nom' => 'Admin',
            'prenom' => 'CSJ',
            'email' => 'admin@csj-sn.org',
            'password' => Hash::make('password'),
        ]);
    }
}
