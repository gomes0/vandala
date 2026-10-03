<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class CarrinhoController extends Controller
{
    public function index()
    {
        $carrinho = session()->get('carrinho', []);

        return view('carrinho.index', compact('carrinho'));
    }

    public function adicionar(Request $request, Produto $produto)
    {
        if ($produto->estoque <= 0) {
            return back()->with('erro', 'Produto sem estoque.');
        }

        $carrinho = session()->get('carrinho', []);

        if (isset($carrinho[$produto->id])) {

            if ($carrinho[$produto->id]['quantidade'] >= $produto->estoque) {
                return back()->with('erro', 'Quantidade máxima disponível em estoque.');
            }

            $carrinho[$produto->id]['quantidade']++;

        } else {

            $imagem = $produto->imagens()
                ->where('principal', true)
                ->first();

            $imagem = $imagem ?? $produto->imagens()->first();

            $carrinho[$produto->id] = [
                'id' => $produto->id,
                'nome' => $produto->nome,
                'preco' => $produto->preco,
                'quantidade' => 1,
                'estoque' => $produto->estoque,
                'imagem' => $imagem ? $imagem->caminho : null,
            ];
        }

        session()->put('carrinho', $carrinho);

        return redirect()
            ->route('carrinho.index')
            ->with('sucesso', 'Produto adicionado ao carrinho.');
    }

    public function remover(Produto $produto)
    {
        $carrinho = session()->get('carrinho', []);

        if (isset($carrinho[$produto->id])) {
            unset($carrinho[$produto->id]);
        }

        session()->put('carrinho', $carrinho);

        return back()->with('sucesso', 'Produto removido do carrinho.');
    }

    public function aumentar(Produto $produto)
    {
        $carrinho = session()->get('carrinho', []);

        if (!isset($carrinho[$produto->id])) {
            return back();
        }

        if ($carrinho[$produto->id]['quantidade'] < $produto->estoque) {
            $carrinho[$produto->id]['quantidade']++;
        }

        session()->put('carrinho', $carrinho);

        return back();
    }

    public function diminuir(Produto $produto)
    {
        $carrinho = session()->get('carrinho', []);

        if (!isset($carrinho[$produto->id])) {
            return back();
        }

        if ($carrinho[$produto->id]['quantidade'] > 1) {
            $carrinho[$produto->id]['quantidade']--;
        }

        session()->put('carrinho', $carrinho);

        return back();
    }
}