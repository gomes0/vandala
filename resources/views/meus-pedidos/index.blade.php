@extends('layouts.app')

@section('title', 'Meus pedidos | VÂNDALA')

@section('content')

<section class="meus-pedidos-page">

    <div class="container">

        <div class="meus-pedidos-header">
            <span>ÁREA DO CLIENTE</span>
            <h1>MEUS PEDIDOS</h1>
            <p>Acompanhe suas compras e consulte os detalhes dos pedidos.</p>
        </div>

        @if($pedidos->isEmpty())

            <div class="meus-pedidos-vazio">
                <h2>NENHUM PEDIDO ENCONTRADO</h2>
                <p>Você ainda não realizou nenhuma compra.</p>

                <a href="{{ route('loja.index') }}">
                    EXPLORAR LOJA
                </a>
            </div>

        @else

            <div class="meus-pedidos-lista">

                @foreach($pedidos as $pedido)

                    <article class="meu-pedido-card">

                        <div class="meu-pedido-header">

                            <div>
                                <span>Pedido</span>
                                <strong>
                                    #{{ str_pad($pedido->id, 6, '0', STR_PAD_LEFT) }}
                                </strong>
                            </div>

                            <div>
                                <span>Data da compra</span>
                                <strong>
                                    {{ $pedido->created_at->format('d/m/Y H:i') }}
                                </strong>
                            </div>

                            <div>
                                <span>Status</span>
                                <strong>
                                    {{ ucfirst(str_replace('_', ' ', $pedido->status)) }}
                                </strong>
                            </div>

                        </div>

                        <div class="meu-pedido-itens">

                            @foreach($pedido->itens as $item)

                                <div class="meu-pedido-item">

                                    <div>
                                        <strong>{{ $item->nome_produto }}</strong>
                                        <span>
                                            {{ $item->quantidade }} unidade(s)
                                        </span>
                                    </div>

                                    <strong>
                                        R$ {{ number_format($item->subtotal, 2, ',', '.') }}
                                    </strong>

                                </div>

                            @endforeach

                        </div>

                        <div class="meu-pedido-footer">

                            <div>
                                <span>Pagamento</span>
                                <strong>
                                    {{ strtoupper($pedido->forma_pagamento ?? 'Não informado') }}
                                </strong>
                            </div>

                            <div>
                                <span>Total</span>
                                <strong>
                                    R$ {{ number_format($pedido->total, 2, ',', '.') }}
                                </strong>
                            </div>

                        </div>

                        @if($pedido->codigo_rastreamento)

                            <div class="meu-pedido-rastreamento">
                                <strong>Código de rastreamento:</strong>
                                {{ $pedido->codigo_rastreamento }}
                            </div>

                        @endif

                        @if($pedido->observacao_admin)

                            <div class="meu-pedido-observacao">
                                <strong>Observação da loja:</strong>
                                {{ $pedido->observacao_admin }}
                            </div>

                        @endif

                    </article>

                @endforeach

            </div>

            <div class="meus-pedidos-paginacao">
                {{ $pedidos->links() }}
            </div>

        @endif

    </div>

</section>

@endsection
