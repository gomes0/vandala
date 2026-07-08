<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categorias')->insert([
            ['nome' => 'Camisetas'],
            ['nome' => 'Moletons'],
            ['nome' => 'Calças'],
            ['nome' => 'Bonés'],
            ['nome' => 'Acessórios']
        ]);
    }
}
