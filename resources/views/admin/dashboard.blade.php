@extends('admin.layouts.admin')

@section('title', 'Dashboard')

@section('content')

<div class="page-header">
    <h1>Bem-vindo, {{ auth()->user()->name }}</h1>
    <p>Resumo geral da loja VÂNDALA.</p>
</div>

<div class="cards">

    <div class="card">
        <i class="bi bi-box-seam"></i>
        <h2>{{ $totalProdutos }}</h2>
        <span>Produtos cadastrados</span>
    </div>

    <div class="card">
        <i class="bi bi-tags-fill"></i>
        <h2>{{ $totalCategorias }}</h2>
        <span>Categorias</span>
    </div>

    <div class="card">
        <i class="bi bi-cart-fill"></i>
        <h2>{{ $totalPedidos }}</h2>
        <span>Pedidos realizados</span>
    </div>

    <div class="card">
        <i class="bi bi-people-fill"></i>
        <h2>{{ $totalClientes }}</h2>
        <span>Clientes cadastrados</span>
    </div>

    <div class="card">
        <i class="bi bi-currency-dollar"></i>
        <h2>R$ {{ number_format($totalVendas, 2, ',', '.') }}</h2>
        <span>Vendas aprovadas</span>
    </div>

</div>

<div class="panel">
    <h3><i class="bi bi-clock-history"></i> Pedidos recentes</h3>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Pedido</th>
                    <th>Cliente</th>
                    <th>Data</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Ação</th>
                </tr>
            </thead>

            <tbody>
                @forelse($pedidosRecentes as $pedido)
                    <tr>
                        <td>#{{ str_pad($pedido->id, 6, '0', STR_PAD_LEFT) }}</td>
                        <td>{{ $pedido->nome }}</td>
                        <td>{{ \Carbon\Carbon::parse($pedido->created_at)->format('d/m/Y H:i') }}</td>
                        <td>R$ {{ number_format($pedido->total, 2, ',', '.') }}</td>
                        <td>{{ ucfirst(str_replace('_', ' ', $pedido->status)) }}</td>
                        <td>
                            <a href="{{ route('admin.pedidos.show', $pedido->id) }}">
                                Ver pedido
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">Nenhum pedido foi realizado ainda.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="panel" style="margin-top: 25px;">
    <h3><i class="bi bi-exclamation-triangle"></i> Estoque baixo</h3>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Produto</th>
                    <th>Quantidade em estoque</th>
                </tr>
            </thead>

            <tbody>
                @forelse($produtosEstoqueBaixo as $produto)
                    <tr>
                        <td>{{ $produto->nome }}</td>
                        <td>{{ $produto->estoque }} unidades</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2">Nenhum produto com estoque baixo.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
