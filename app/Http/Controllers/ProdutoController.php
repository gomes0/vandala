<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Categoria;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function index()
    {
        $produtos = Produto::with('categoria')
                    ->latest()
                    ->get();

        return view('admin.produtos.index', compact('produtos'));
    }

    public function create()
    {
        $categorias = Categoria::all();

        return view('admin.produtos.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        $request->validate([

            'nome' => 'required|max:255',

            'descricao' => 'nullable',

            'preco' => 'required|numeric',

            'estoque' => 'required|integer',

            'categoria_id' => 'required|exists:categorias,id',

            'status' => 'required'

        ]);

        Produto::create($request->all());

        return redirect()
            ->route('produtos.index')
            ->with('success', 'Produto cadastrado com sucesso!');
    }

    public function edit(Produto $produto)
    {
        $categorias = Categoria::all();

        return view(
            'admin.produtos.edit',
            compact('produto', 'categorias')
        );
    }

    public function update(Request $request, Produto $produto)
    {
        $request->validate([

            'nome' => 'required|max:255',

            'descricao' => 'nullable',

            'preco' => 'required|numeric',

            'estoque' => 'required|integer',

            'categoria_id' => 'required|exists:categorias,id',

            'status' => 'required'

        ]);

        $produto->update($request->all());

        return redirect()
            ->route('produtos.index')
            ->with('success', 'Produto atualizado!');
    }

    public function destroy(Produto $produto)
    {
        $produto->delete();

        return redirect()
            ->route('produtos.index')
            ->with('success', 'Produto removido!');
    }
}