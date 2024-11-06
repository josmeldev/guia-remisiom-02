<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        // Crear usuario administrador
        $adminUser = User::create([
            'name' => 'Administrador',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
        ]);

        // Asignar rol de administrador
        $adminUser->assignRole('Administrador');
    }
}