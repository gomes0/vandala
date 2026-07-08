<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cores')->insert([

            [
                'nome' => 'Preto',
                'codigo_hex' => '#000000'
            ],

            [
                'nome' => 'Branco',
                'codigo_hex' => '#FFFFFF'
            ],

            [
                'nome' => 'Cinza',
                'codigo_hex' => '#7A7A7A'
            ],

            [
                'nome' => 'Verde Militar',
                'codigo_hex' => '#556B2F'
            ]
        ]);
    }
}