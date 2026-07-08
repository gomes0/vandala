<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TamanhoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tamanhos')->insert([

            ['nome' => 'PP'],
            ['nome' => 'P'],
            ['nome' => 'M'],
            ['nome' => 'G'],
            ['nome' => 'GG']

        ]);
    }
}
