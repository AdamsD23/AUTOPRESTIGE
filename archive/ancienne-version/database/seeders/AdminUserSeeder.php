<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'prenom' => 'Admin',
            'nom' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'telephone' => '0123456789',
            'adresse' => '123 Rue Admin',
            'ville' => 'Ville',
            'role' => 'admin',
        ]);
    }
}
