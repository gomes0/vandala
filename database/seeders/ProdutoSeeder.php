<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('produtos')->insert([

            [
                'nome' => 'Camiseta Chaos',

                'descricao' => 'Camiseta oversized em algodão premium.',

                'preco' => 129.90,

                'estoque' => 20,

                'categoria_id' => 1

            ],

            [
                'nome' => 'Moletom Ruínas',

                'descricao' => 'Moletom flanelado streetwear.',

                'preco' => 249.90,

                'estoque' => 10,

                'categoria_id' => 2

            ],

            [
                'nome' => 'Calça Cargo Underground',

                'descricao' => 'Calça cargo em sarja.',

                'preco' => 229.90,

                'estoque' => 8,

                'categoria_id' => 3

            ]

        ]);
    }
}
