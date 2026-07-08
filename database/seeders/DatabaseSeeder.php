<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([

            UsuarioSeeder::class,
            CategoriaSeeder::class,
            ProdutoSeeder::class,
            CorSeeder::class,
            TamanhoSeeder::class,
            ProdutoCorSeeder::class,
            ProdutoTamanhoSeeder::class,
            ImagemProdutoSeeder::class,
            CarrinhoSeeder::class,
            ItemCarrinhoSeeder::class,
            PedidoSeeder::class,
            ItemPedidoSeeder::class,
            
        ]);
    }
}