<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\ItemPedido;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class CheckoutController extends Controller
{
    public function index()
    {
        $carrinho = session()->get('carrinho', []);

        if (empty($carrinho)) {
            return redirect()
                ->route('carrinho.index')
                ->with('erro', 'Seu carrinho está vazio.');
        }

        $total = 0;

        foreach ($carrinho as $item) {
            $total += $item['preco'] * $item['quantidade'];
        }

        $enderecos = auth()->check()
            ? auth()->user()->enderecos()
                ->orderByDesc('principal')
                ->orderByDesc('id')
                ->get()
            : collect();

        return view('checkout.index', compact(
            'carrinho',
            'total',
            'enderecos'
        ));
    }

    public function store(Request $request)
    {
        $dados = $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'cpf' => ['required', 'string', 'max:14'],
            'telefone' => ['required', 'string', 'max:20'],

            'endereco_id' => ['nullable', 'integer'],

            'forma_pagamento' => [
                'required',
                Rule::in(['pix', 'cartao', 'boleto'])
            ],
        ]);

        // Verificar se foi selecionado um endereço salvo
        if ($request->filled('endereco_id')) {

            $enderecoSalvo = auth()->check()
                ? auth()->user()->enderecos()->find($request->endereco_id)
                : null;

            if (!$enderecoSalvo) {
                return back()
                    ->withErrors([
                        'endereco_id' => 'O endereço selecionado não é válido.'
                    ])
                    ->withInput();
            }

            $dadosEndereco = [
                'cep' => $enderecoSalvo->cep,
                'estado' => $enderecoSalvo->estado,
                'cidade' => $enderecoSalvo->cidade,
                'bairro' => $enderecoSalvo->bairro,
                'endereco' => $enderecoSalvo->rua,
                'numero' => $enderecoSalvo->numero,
                'complemento' => $enderecoSalvo->complemento,
            ];

        } else {

            // Validar endereço informado manualmente
            $dadosEndereco = $request->validate([
                'cep' => ['required', 'string', 'max:9'],
                'estado' => ['required', 'string', 'size:2'],
                'cidade' => ['required', 'string', 'max:255'],
                'bairro' => ['required', 'string', 'max:255'],
                'endereco' => ['required', 'string', 'max:255'],
                'numero' => ['required', 'string', 'max:20'],
                'complemento' => ['nullable', 'string', 'max:255'],
            ]);
        }

        $carrinho = session()->get('carrinho', []);

        if (empty($carrinho)) {
            return redirect()
                ->route('carrinho.index')
                ->with('erro', 'Seu carrinho está vazio.');
        }

        try {

            $pedido = DB::transaction(function () use (
                $dados,
                $dadosEndereco,
                $carrinho
            ) {

                $produtos = [];
                $subtotal = 0;

                foreach ($carrinho as $item) {

                    $produto = Produto::whereKey($item['id'])
                        ->lockForUpdate()
                        ->first();

                    if (!$produto || $produto->status !== 'ativo') {
                        throw new \RuntimeException(
                            'Um dos produtos do carrinho não está mais disponível.'
                        );
                    }

                    $quantidade = (int) $item['quantidade'];

                    if ($quantidade <= 0 || $produto->estoque < $quantidade) {
                        throw new \RuntimeException(
                            'Estoque insuficiente para o produto: ' . $produto->nome
                        );
                    }

                    $preco = (float) $produto->preco;
                    $valorItem = $preco * $quantidade;
                    $subtotal += $valorItem;

                    $produtos[] = [
                        'produto' => $produto,
                        'quantidade' => $quantidade,
                        'preco' => $preco,
                        'subtotal' => $valorItem,
                    ];
                }

                $frete = 0;
                $total = $subtotal + $frete;

                $pedido = Pedido::create([

                    'usuario_id' => auth()->id(),

                    'nome' => $dados['nome'],
                    'email' => $dados['email'],
                    'cpf' => $dados['cpf'],
                    'telefone' => $dados['telefone'],

                    'cep' => $dadosEndereco['cep'],
                    'estado' => strtoupper($dadosEndereco['estado']),
                    'cidade' => $dadosEndereco['cidade'],
                    'bairro' => $dadosEndereco['bairro'],
                    'endereco' => $dadosEndereco['endereco'],
                    'numero' => $dadosEndereco['numero'],
                    'complemento' => $dadosEndereco['complemento'] ?? null,

                    'subtotal' => $subtotal,
                    'frete' => $frete,
                    'total' => $total,

                    'forma_pagamento' => $dados['forma_pagamento'],
                    'status_pagamento' => 'aprovado',
                    'status' => 'pagamento_aprovado',
                ]);

                foreach ($produtos as $item) {

                    ItemPedido::create([
                        'pedido_id' => $pedido->id,
                        'produto_id' => $item['produto']->id,
                        'nome_produto' => $item['produto']->nome,
                        'preco_unitario' => $item['preco'],
                        'quantidade' => $item['quantidade'],
                        'subtotal' => $item['subtotal'],
                    ]);

                    $item['produto']->decrement(
                        'estoque',
                        $item['quantidade']
                    );
                }

                return $pedido;
            });

            session()->forget('carrinho');

            return redirect()
                ->route('checkout.confirmacao', $pedido->id);

        } catch (\RuntimeException $e) {

            return redirect()
                ->route('checkout.index')
                ->withInput()
                ->with('erro', $e->getMessage());
        }
    }

    public function confirmacao(Pedido $pedido)
    {
        if (
            auth()->check() &&
            $pedido->usuario_id !== auth()->id()
        ) {
            abort(403);
        }

        if (!auth()->check() && $pedido->usuario_id !== null) {
            abort(403);
        }

        $pedido->load('itens');

        return view('checkout.confirmacao', compact('pedido'));
    }
}
