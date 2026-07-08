<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProdutoCorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('produto_cor')->insert([

            [
                'produto_id' => 1,
                'cor_id' => 1
            ],

            [
                'produto_id' => 1,
                'cor_id' => 2
            ],

            [
                'produto_id' => 2,
                'cor_id' => 1
            ],

            [
                'produto_id' => 3,
                'cor_id' => 4
            ]

        ]);
    }
}
