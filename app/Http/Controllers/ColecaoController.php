<?php

namespace App\Http\Controllers;

use App\Models\Categoria;

class ColecaoController extends Controller
{
    public function index()
    {
        $categorias = Categoria::withCount([
            'produtos' => function ($query) {
                $query->where('status', 'ativo');
            }
        ])->get();

        return view('colecoes.index', compact('categorias'));
    }
}