<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ImagemProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('imagens_produto')->insert([

            [
                'produto_id' => 1,
                'imagem' => 'camiseta-chaos-frente.jpg',
                'ordem' => 1
            ],

            [
                'produto_id' => 1,
                'imagem' => 'camiseta-chaos-costas.jpg',
                'ordem' => 2
            ],

            [
                'produto_id' => 2,
                'imagem' => 'moletom-ruinas-frente.jpg',
                'ordem' => 1
            ]

        ]);
    }
}
