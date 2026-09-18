<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Categoria;

class HomeController extends Controller
{
    public function index()
    {
        $produtos = Produto::with([
            'categoria',
            'imagens'
        ])
        ->where('status', 'ativo')
        ->latest()
        ->take(12)
        ->get();

        $categorias = Categoria::all();

        return view('home.index', compact(
            'produtos',
            'categorias'
        ));
    }
}