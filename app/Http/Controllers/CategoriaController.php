<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::latest()->get();

        return view(
            'admin.categorias.index',
            compact('categorias')
        );
    }

    public function create()
    {
        return view('admin.categorias.create');
    }

    public function store(Request $request)
    {
        $request->validate([

            'nome' => 'required|max:100',

            'descricao' => 'nullable',

            'status' => 'required'

        ]);

        Categoria::create($request->all());

        return redirect()
            ->route('categorias.index')
            ->with(
                'success',
                'Categoria cadastrada com sucesso!'
            );
    }

    public function edit(Categoria $categoria)
    {
        return view(
            'admin.categorias.edit',
            compact('categoria')
        );
    }

    public function update(
        Request $request,
        Categoria $categoria
    ) {

        $request->validate([

            'nome' => 'required|max:100',

            'descricao' => 'nullable',

            'status' => 'required'

        ]);

        $categoria->update($request->all());

        return redirect()
            ->route('categorias.index')
            ->with(
                'success',
                'Categoria atualizada!'
            );
    }

    public function destroy(Categoria $categoria)
    {
        $categoria->delete();

        return redirect()
            ->route('categorias.index')
            ->with(
                'success',
                'Categoria removida!'
            );
    }
}