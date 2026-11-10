<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class FavoritoController extends Controller
{
    /**
     * Exibe os produtos favoritos do usuário.
     */
    public function index(Request $request): View
    {
        $produtos = $request->user()
            ->favoritos()
            ->with(['categoria', 'imagens'])
            ->orderByPivot('created_at', 'desc')
            ->paginate(12);

        return view('favoritos.index', compact('produtos'));
    }

    /**
     * Adiciona um produto aos favoritos.
     */
    public function store(
        Request $request,
        Produto $produto
    ): JsonResponse|RedirectResponse {

        $request->user()
            ->favoritos()
            ->syncWithoutDetaching([$produto->id]);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'favoritado' => true,
                'message' => 'Produto adicionado aos favoritos!',
            ]);
        }

        return back()->with(
            'success',
            'Produto adicionado aos favoritos!'
        );
    }

    /**
     * Remove um produto dos favoritos.
     */
    public function destroy(
        Request $request,
        Produto $produto
    ): JsonResponse|RedirectResponse {

        $request->user()
            ->favoritos()
            ->detach($produto->id);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'favoritado' => false,
                'message' => 'Produto removido dos favoritos!',
            ]);
        }

        return back()->with(
            'success',
            'Produto removido dos favoritos!'
        );
    }
}
