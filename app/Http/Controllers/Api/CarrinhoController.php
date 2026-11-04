<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Carrinho;
use App\Models\ItemCarrinho;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CarrinhoController extends Controller
{
    /**
     * Retorna o carrinho do usuário autenticado.
     */
    public function index(Request $request)
    {
        $carrinho = $this->obterCarrinho($request);

        $carrinho->load('itens.produto.categoria', 'itens.produto.imagens');

        return response()->json([
            'sucesso' => true,
            'carrinho' => $carrinho,
            'subtotal' => $carrinho->itens->sum(
                fn($item) => $item->preco * $item->quantidade
            ),
        ]);
    }

    /**
     * Adiciona um produto ao carrinho.
     */
    public function adicionar(Request $request)
    {
        $dados = $request->validate([
            'produto_id' => ['required', 'integer', 'exists:produtos,id'],
            'quantidade' => ['nullable', 'integer', 'min:1'],
            'cor_id' => ['nullable', 'integer', 'exists:cores,id'],
            'tamanho_id' => ['nullable', 'integer', 'exists:tamanhos,id'],
        ]);

        return DB::transaction(function () use ($request, $dados) {
            $produto = Produto::where('status', 'ativo')
                ->lockForUpdate()
                ->findOrFail($dados['produto_id']);

            $quantidade = $dados['quantidade'] ?? 1;

            $carrinho = $this->obterCarrinho($request);

            $item = ItemCarrinho::where('carrinho_id', $carrinho->id)
                ->where('produto_id', $produto->id)
                ->where('cor_id', $dados['cor_id'] ?? null)
                ->where('tamanho_id', $dados['tamanho_id'] ?? null)
                ->lockForUpdate()
                ->first();

            $novaQuantidade = $quantidade + ($item?->quantidade ?? 0);

            if ($produto->estoque < $novaQuantidade) {
                return response()->json([
                    'sucesso' => false,
                    'mensagem' => 'Estoque insuficiente para essa quantidade.',
                    'estoque_disponivel' => $produto->estoque,
                ], 422);
            }

            if ($item) {
                $item->quantidade = $novaQuantidade;
                $item->preco = $produto->preco;
                $item->save();
            } else {
                $item = ItemCarrinho::create([
                    'carrinho_id' => $carrinho->id,
                    'produto_id' => $produto->id,
                    'cor_id' => $dados['cor_id'] ?? null,
                    'tamanho_id' => $dados['tamanho_id'] ?? null,
                    'quantidade' => $quantidade,
                    'preco' => $produto->preco,
                ]);
            }

            return response()->json([
                'sucesso' => true,
                'mensagem' => 'Produto adicionado ao carrinho.',
                'item' => $item->load('produto'),
            ], 201);
        });
    }

    /**
     * Atualiza a quantidade de um item.
     */
    public function atualizar(Request $request, int $id)
    {
        $dados = $request->validate([
            'quantidade' => ['required', 'integer', 'min:1'],
        ]);

        $carrinho = $this->obterCarrinho($request);

        $item = ItemCarrinho::where('carrinho_id', $carrinho->id)
            ->findOrFail($id);

        $produto = Produto::findOrFail($item->produto_id);

        if ($produto->status !== 'ativo') {
            return response()->json([
                'sucesso' => false,
                'mensagem' => 'Este produto não está mais disponível.',
            ], 422);
        }

        if ($dados['quantidade'] > $produto->estoque) {
            return response()->json([
                'sucesso' => false,
                'mensagem' => 'Estoque insuficiente.',
                'estoque_disponivel' => $produto->estoque,
            ], 422);
        }

        $item->quantidade = $dados['quantidade'];
        $item->preco = $produto->preco;
        $item->save();

        return response()->json([
            'sucesso' => true,
            'mensagem' => 'Quantidade atualizada.',
            'item' => $item->load('produto'),
        ]);
    }

    /**
     * Remove um item do carrinho.
     */
    public function remover(Request $request, int $id)
    {
        $carrinho = $this->obterCarrinho($request);

        $item = ItemCarrinho::where('carrinho_id', $carrinho->id)
            ->findOrFail($id);

        $item->delete();

        return response()->json([
            'sucesso' => true,
            'mensagem' => 'Produto removido do carrinho.',
        ]);
    }

    /**
     * Localiza ou cria o carrinho do usuário autenticado.
     */

    private function obterCarrinho(Request $request): Carrinho
    {
        $usuario = $request->user();

        if (!$usuario) {
            abort(401, 'Usuário não autenticado.');
        }

        return Carrinho::firstOrCreate([
            'user_id' => $usuario->id,
        ]);
    }
}
