<?php

namespace App\Http\Controllers;

use App\Models\Pedido;

class MeusPedidosController extends Controller
{
    public function index()
    {
        $pedidos = Pedido::where('usuario_id', auth()->id())
            ->with('itens')
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('meus-pedidos.index', compact('pedidos'));
    }
}
