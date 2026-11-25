@extends('admin.layouts.admin')

@section('title', 'Detalhes do Pedido')

@section('content')

<div class="page-header">
    <div>
        <h1>Pedido #{{ str_pad($pedido->id, 6, '0', STR_PAD_LEFT) }}</h1>
        <p class="pedido-subtitulo">Visualize e gerencie os detalhes deste pedido.</p>
    </div>
    <a href="{{ route('admin.pedidos.index') }}" class="btn-primary">Voltar aos pedidos</a>
</div>

@if (session('success'))
    <div class="pedido-alerta">{{ session('success') }}</div>
@endif

@if ($errors->any())
    <div class="pedido-alerta">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

<div class="pedido-status-banner">
    <div>
        <span>Status atual</span>
        <strong>{{ ucfirst(str_replace('_', ' ', $pedido->status)) }}</strong>
    </div>
    <div>
        <span>Pagamento</span>
        <strong>{{ ucfirst($pedido->status_pagamento ?? 'Não informado') }}</strong>
    </div>
</div>

<div class="pedido-grid">

    <section class="pedido-card">
        <h2><i class="bi bi-person"></i> Dados do cliente</h2>
        <div class="pedido-info">
            <p><strong>Nome</strong><span>{{ $pedido->nome }}</span></p>
            <p><strong>E-mail</strong><span>{{ $pedido->email }}</span></p>
            <p><strong>CPF</strong><span>{{ $pedido->cpf }}</span></p>
            <p><strong>Telefone</strong><span>{{ $pedido->telefone }}</span></p>
        </div>
    </section>

    <section class="pedido-card">
        <h2><i class="bi bi-geo-alt"></i> Endereço de entrega</h2>
        <div class="pedido-info">
            <p><strong>CEP</strong><span>{{ $pedido->cep }}</span></p>
            <p><strong>Estado</strong><span>{{ $pedido->estado }}</span></p>
            <p><strong>Cidade</strong><span>{{ $pedido->cidade }}</span></p>
            <p><strong>Bairro</strong><span>{{ $pedido->bairro }}</span></p>
            <p><strong>Endereço</strong><span>{{ $pedido->endereco }}, {{ $pedido->numero }}</span></p>
            <p><strong>Complemento</strong><span>{{ $pedido->complemento ?? 'Não informado' }}</span></p>
        </div>
    </section>

</div>

<section class="pedido-card pedido-produtos">
    <h2><i class="bi bi-box-seam"></i> Produtos do pedido</h2>
    <div class="pedido-tabela-container">
        <table class="table">
            <thead>
                <tr>
                    <th>Produto</th>
                    <th>Preço unitário</th>
                    <th>Quantidade</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pedido->itens as $item)
                    <tr>
                        <td>{{ $item->nome_produto }}</td>
                        <td>R$ {{ number_format($item->preco_unitario, 2, ',', '.') }}</td>
                        <td>{{ $item->quantidade }}</td>
                        <td>R$ {{ number_format($item->subtotal, 2, ',', '.') }}</td>
                    </tr>
                @empty
                    <tr><td colspan="4">Nenhum produto encontrado.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</section>

<div class="pedido-grid">

    <section class="pedido-card">
        <h2><i class="bi bi-receipt"></i> Resumo financeiro</h2>
        <div class="pedido-total-linha">
            <span>Subtotal</span>
            <strong>R$ {{ number_format($pedido->subtotal, 2, ',', '.') }}</strong>
        </div>
        <div class="pedido-total-linha">
            <span>Frete</span>
            <strong>R$ {{ number_format($pedido->frete, 2, ',', '.') }}</strong>
        </div>
        <div class="pedido-total-linha pedido-total-final">
            <span>Total</span>
            <strong>R$ {{ number_format($pedido->total, 2, ',', '.') }}</strong>
        </div>
        <div class="pedido-info">
            <p><strong>Forma de pagamento</strong><span>{{ strtoupper($pedido->forma_pagamento ?? 'Não informado') }}</span></p>
        </div>
    </section>

    <section class="pedido-card">
        <h2><i class="bi bi-truck"></i> Atualizar pedido</h2>
        <p class="pedido-form-descricao">Atualize o andamento e as informações de entrega.</p>

        <form action="{{ route('admin.pedidos.update', $pedido) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="pedido-form-grid">
                <div class="pedido-campo pedido-campo-completo">
                    <label for="status">Status do pedido</label>
                    <select name="status" id="status" required>
                        <option value="pendente" @selected($pedido->status === 'pendente')>Pendente</option>
                        <option value="pagamento_aprovado" @selected($pedido->status === 'pagamento_aprovado')>Pagamento aprovado</option>
                        <option value="em_separacao" @selected($pedido->status === 'em_separacao')>Em separação</option>
                        <option value="enviado" @selected($pedido->status === 'enviado')>Enviado</option>
                        <option value="entregue" @selected($pedido->status === 'entregue')>Entregue</option>
                        <option value="cancelado" @selected($pedido->status === 'cancelado')>Cancelado</option>
                    </select>
                </div>

                <div class="pedido-campo pedido-campo-completo">
                    <label for="codigo_rastreamento">Código de rastreamento</label>
                    <input type="text" name="codigo_rastreamento" id="codigo_rastreamento"
                        value="{{ old('codigo_rastreamento', $pedido->codigo_rastreamento) }}"
                        placeholder="Informe o código de rastreamento">
                </div>

                <div class="pedido-campo pedido-campo-completo">
                    <label for="observacao_admin">Observação para o cliente</label>
                    <textarea name="observacao_admin" id="observacao_admin" rows="4"
                        placeholder="Digite uma observação, se necessário">{{ old('observacao_admin', $pedido->observacao_admin) }}</textarea>
                </div>
            </div>

            <div class="pedido-form-acoes">
                <button type="submit" class="btn-primary">Salvar alterações</button>
            </div>
        </form>
    </section>

</div>

@endsection
