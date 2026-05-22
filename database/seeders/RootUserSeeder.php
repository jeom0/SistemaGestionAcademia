<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RootUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Usuario Root',
            'email' => 'root@conduser.com',
            'password' => Hash::make('password123'),
            'role' => 'root',
            'status' => 'activo',
        ]);
    }
}
