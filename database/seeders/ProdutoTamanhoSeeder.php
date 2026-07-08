<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProdutoTamanhoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('produto_tamanho')->insert([

            [
                'produto_id' => 1,
                'tamanho_id' => 2
            ],

            [
                'produto_id' => 1,
                'tamanho_id' => 3
            ],

            [
                'produto_id' => 1,
                'tamanho_id' => 4
            ],

            [
                'produto_id' => 2,
                'tamanho_id' => 3
            ],

            [
                'produto_id' => 2,
                'tamanho_id' => 4
            ],

            [
                'produto_id' => 2,
                'tamanho_id' => 5
            ]

        ]);
    }
}
