<?php

namespace App\Http\Controllers;

use App\Models\Produto;

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
        ->get();

        return view('home.index', compact('produtos'));
    }
}