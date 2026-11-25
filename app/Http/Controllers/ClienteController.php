<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index(Request $request)
    {
        $clientes = User::where('tipo', 'cliente')
            ->withCount('pedidos')
            ->when($request->filled('busca'), function ($query) use ($request) {
                $busca = $request->busca;

                $query->where(function ($q) use ($busca) {
                    $q->where('name', 'like', "%{$busca}%")
                      ->orWhere('email', 'like', "%{$busca}%");
                });
            })
            ->orderByDesc('created_at')
            ->paginate(10)
            ->withQueryString();

        return view('admin.clientes.index', compact('clientes'));
    }
}