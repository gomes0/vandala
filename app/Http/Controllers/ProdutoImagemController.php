<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\ProdutoImagem;
use Illuminate\Http\Request;

class ProdutoImagemController extends Controller
{
    public function index(Produto $produto)
    {
        return view(
            'admin.produtos.imagens.index',
            compact('produto')
        );
    }

    public function store(Request $request, Produto $produto)
    {
        $request->validate([
            'imagem' => 'required|image|max:4096'
        ]);

        $arquivo = $request->file('imagem');

        $nome = time() . '_' . uniqid() . '.' . $arquivo->extension();

        $arquivo->move(
            public_path('uploads/produtos'),
            $nome
        );

        if ($request->has('principal')) {

            ProdutoImagem::where(
                'produto_id',
                $produto->id
            )->update([
                'principal' => false
            ]);
        }

        ProdutoImagem::create([

            'produto_id' => $produto->id,

            'caminho' => 'uploads/produtos/' . $nome,

            'nome_original' => $arquivo->getClientOriginalName(),

            'principal' => $request->has('principal'),

            'ordem' => 1

        ]);

        return back()->with(
            'success',
            'Imagem adicionada!'
        );
    }

    public function principal(ProdutoImagem $imagem)
    {
        ProdutoImagem::where(
            'produto_id',
            $imagem->produto_id
        )->update([
            'principal' => false
        ]);

        $imagem->update([
            'principal' => true
        ]);

        return back();
    }

    public function destroy(ProdutoImagem $imagem)
    {
        if (file_exists(public_path($imagem->caminho))) {

            unlink(public_path($imagem->caminho));
        }

        $imagem->delete();

        return back()->with(
            'success',
            'Imagem removida!'
        );
    }
}
