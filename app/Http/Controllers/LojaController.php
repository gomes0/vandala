<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Produto;
use Illuminate\Http\Request;

class LojaController extends Controller
{
    public function index(Request $request)
    {
        $busca = $request->input('busca');
        $categoriaId = $request->input('categoria');
        $precoMin = $request->input('preco_min');
        $precoMax = $request->input('preco_max');

        $ordenacao = $request->input('ordenar', 'recentes');

        // Consulta inicial: somente produtos ativos.
        $consulta = Produto::with(['categoria', 'imagens'])
            ->where('status', 'ativo');

        // Busca pelo nome do produto.
        if (is_string($busca) && trim($busca) !== '') {
            $consulta->where('nome', 'like', '%' . trim($busca) . '%');
        }

        // Filtro por categoria.
        if (is_scalar($categoriaId) && $categoriaId !== '') {
            $consulta->where('categoria_id', $categoriaId);
        }

        // Preço mínimo.
        if (
            $precoMin !== null &&
            $precoMin !== '' &&
            is_numeric($precoMin) &&
            (float) $precoMin >= 0
        ) {
            $consulta->where('preco', '>=', (float) $precoMin);
        }

        // Preço máximo.
        if (
            $precoMax !== null &&
            $precoMax !== '' &&
            is_numeric($precoMax) &&
            (float) $precoMax >= 0
        ) {
            $consulta->where('preco', '<=', (float) $precoMax);
        }

        // Ordenação.
        switch ($ordenacao) {
            case 'menor_preco':
                $consulta->orderBy('preco', 'asc');
                break;

            case 'maior_preco':
                $consulta->orderBy('preco', 'desc');
                break;

            case 'nome':
                $consulta->orderBy('nome', 'asc');
                break;

            case 'recentes':
            default:
                $consulta->latest();
                $ordenacao = 'recentes';
                break;
        }

        // Mantém os filtros ao navegar entre páginas.
        $produtos = $consulta
            ->paginate(12)
            ->withQueryString();

        $categorias = Categoria::orderBy('nome', 'asc')->get();

        return view('loja.index', compact(
            'produtos',
            'categorias',
            'busca',
            'categoriaId',
            'precoMin',
            'precoMax',
            'ordenacao'
        ));
    }
}