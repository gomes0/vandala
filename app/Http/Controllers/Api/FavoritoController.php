<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Produto;
use Illuminate\Http\Request;

class FavoritoController extends Controller
{
    public function index(Request $request)
    {
        $produtos = $request->user()
            ->favoritos()
            ->with(['categoria', 'imagens'])
            ->where('status', 'ativo')
            ->latest('favoritos.created_at')
            ->get();

        return response()->json([
            'favoritos' => $produtos,
        ]);
    }

    public function store(Request $request, Produto $produto)
    {
        if ($produto->status !== 'ativo') {
            return response()->json([
                'mensagem' => 'Este produto não está disponível.',
            ], 422);
        }

        $request->user()->favoritos()->syncWithoutDetaching([$produto->id]);

        return response()->json([
            'sucesso' => true,
            'favoritado' => true,
            'mensagem' => 'Produto adicionado aos favoritos.',
        ], 201);
    }

    public function destroy(Request $request, Produto $produto)
    {
        $request->user()->favoritos()->detach($produto->id);

        return response()->json([
            'sucesso' => true,
            'favoritado' => false,
            'mensagem' => 'Produto removido dos favoritos.',
        ]);
    }

    public function verificar(Request $request, Produto $produto)
    {
        $favoritado = $request->user()
            ->favoritos()
            ->where('produtos.id', $produto->id)
            ->exists();

        return response()->json([
            'favoritado' => $favoritado,
        ]);
    }
}
