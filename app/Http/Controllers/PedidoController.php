<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    /**
     * Lista todos os pedidos.
     */
    public function index()
    {
        $pedidos = Pedido::with('usuario')
            ->orderByDesc('created_at')
            ->paginate(15);

        return view('admin.pedidos.index', compact('pedidos'));
    }

    /**
     * Não será utilizado.
     */
    public function create()
    {
        return redirect()->route('admin.pedidos.index');
    }

    public function store(Request $request)
    {
        return redirect()->route('admin.pedidos.index');
    }

    /**
     * Exibe os detalhes de um pedido.
     */
    public function show(Pedido $pedido)
    {
        $pedido->load(['usuario', 'itens']);

        return view('admin.pedidos.show', compact('pedido'));
    }

    public function edit(Pedido $pedido)
    {
        return redirect()->route('admin.pedidos.show', $pedido);
    }

    /**
     * Atualiza os dados administrativos do pedido.
     */
    public function update(Request $request, Pedido $pedido)
    {
        $dados = $request->validate([
            'status' => [
                'required',
                'in:pendente,pagamento_aprovado,em_separacao,enviado,entregue,cancelado',
            ],
            'codigo_rastreamento' => [
                'nullable',
                'string',
                'max:255',
            ],
            'observacao_admin' => [
                'nullable',
                'string',
                'max:2000',
            ],
        ]);

        $pedido->update($dados);

        return redirect()
            ->route('admin.pedidos.show', $pedido)
            ->with('success', 'Pedido atualizado com sucesso!');
    }

    /**
     * Não permitir exclusão de pedidos pelo painel.
     */
    public function destroy(Pedido $pedido)
    {
        return redirect()
            ->route('admin.pedidos.index')
            ->with('error', 'A exclusão de pedidos não está disponível.');
    }
}
