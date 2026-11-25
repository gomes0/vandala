<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProdutos = DB::table('produtos')->count();

        $totalCategorias = DB::table('categorias')->count();

        $totalPedidos = DB::table('pedidos')->count();

        $totalClientes = DB::table('usuarios')
            ->where('tipo', 'cliente')
            ->count();

        $totalVendas = DB::table('pedidos')
            ->where('status_pagamento', 'aprovado')
            ->sum('total');

        $pedidosRecentes = DB::table('pedidos')
            ->orderByDesc('created_at')
            ->limit(5)
            ->get();

        $produtosEstoqueBaixo = DB::table('produtos')
            ->where('estoque', '<=', 5)
            ->orderBy('estoque')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalProdutos',
            'totalCategorias',
            'totalPedidos',
            'totalClientes',
            'totalVendas',
            'pedidosRecentes',
            'produtosEstoqueBaixo'
        ));
    }
}