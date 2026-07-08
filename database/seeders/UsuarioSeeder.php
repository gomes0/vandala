<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('usuarios')->insert([
            [
                'name' => 'Administrador',
                'email' => 'admin@vandala.com',
                'password' => Hash::make('123456'),
                'tipo' => 'admin',
                'status' => 'ativo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Elias Gomes',
                'email' => 'elias@gmail.com',
                'password' => Hash::make('123456'),
                'tipo' => 'cliente',
                'status' => 'ativo',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}