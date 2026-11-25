@extends('admin.layouts.admin')

@section('title', 'Pedidos')

@section('content')

    <div class="page-header">
        <h1>Pedidos</h1>
    </div>

    @if (session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert-success">
            {{ session('error') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Data</th>
                <th>Pagamento</th>
                <th>Total</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($pedidos as $pedido)
                <tr>
                    <td>
                        #{{ str_pad($pedido->id, 6, '0', STR_PAD_LEFT) }}
                    </td>

                    <td>{{ $pedido->nome }}</td>

                    <td>
                        {{ $pedido->created_at->format('d/m/Y H:i') }}
                    </td>

                    <td>
                        {{ strtoupper($pedido->forma_pagamento ?? 'Não informado') }}
                    </td>

                    <td>
                        R$ {{ number_format($pedido->total, 2, ',', '.') }}
                    </td>

                    <td>
                        {{ ucfirst(str_replace('_', ' ', $pedido->status)) }}
                    </td>

                    <td>
                        <a href="{{ route('admin.pedidos.show', $pedido) }}"
                           class="btn-edit"
                           title="Visualizar pedido">
                            <i class="bi bi-eye-fill"></i>
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">
                        Nenhum pedido realizado.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="pagination">
        {{ $pedidos->links() }}
    </div>

@endsection