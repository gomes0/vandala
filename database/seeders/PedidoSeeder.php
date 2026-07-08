<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PedidoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pedidos')->insert([

            [
                'usuario_id' => 2,

                'valor_total' => 259.80,

                'status' => 'pendente',

                'data_pedido' => now()

            ]

        ]);
    }
}
