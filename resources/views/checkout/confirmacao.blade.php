@extends('layouts.app')

@section('title', 'Pedido confirmado | VÂNDALA')

@section('content')

<section class="checkout-confirmacao">

    <div class="container">

        <div class="confirmacao-card">

            <div class="confirmacao-icone">
                ✓
            </div>

            <span class="confirmacao-eyebrow">
                VÂNDALA
            </span>

            <h1>PEDIDO REALIZADO!</h1>

            <p class="confirmacao-mensagem">
                Sua compra foi registrada com sucesso.
                Obrigado por comprar na VÂNDALA!
            </p>

            <div class="confirmacao-numero">

                <span>NÚMERO DO PEDIDO</span>

                <strong>
                    #{{ str_pad($pedido->id, 6, '0', STR_PAD_LEFT) }}
                </strong>

            </div>

            <div class="confirmacao-status">

                <div>
                    <span>Status do pedido</span>
                    <strong>{{ ucfirst(str_replace('_', ' ', $pedido->status)) }}</strong>
                </div>

                <div>
                    <span>Pagamento</span>
                    <strong>{{ ucfirst($pedido->status_pagamento) }}</strong>
                </div>

                <div>
                    <span>Forma de pagamento</span>
                    <strong>{{ strtoupper($pedido->forma_pagamento) }}</strong>
                </div>

            </div>

            <div class="confirmacao-itens">

                <h2>Produtos comprados</h2>

                @foreach($pedido->itens as $item)

                    <div class="confirmacao-item">

                        <div>
                            <strong>{{ $item->nome_produto }}</strong>
                            <span>{{ $item->quantidade }} unidade(s)</span>
                        </div>

                        <strong>
                            R$ {{ number_format($item->subtotal, 2, ',', '.') }}
                        </strong>

                    </div>

                @endforeach

            </div>

            <div class="confirmacao-total">

                <span>Subtotal</span>

                <strong>
                    R$ {{ number_format($pedido->subtotal, 2, ',', '.') }}
                </strong>

                <span>Frete</span>

                <strong>
                    R$ {{ number_format($pedido->frete, 2, ',', '.') }}
                </strong>

                <span>TOTAL</span>

                <strong>
                    R$ {{ number_format($pedido->total, 2, ',', '.') }}
                </strong>

            </div>

            <div class="confirmacao-endereco">

                <h2>Endereço de entrega</h2>

                <p>
                    {{ $pedido->nome }}<br>
                    {{ $pedido->endereco }}, {{ $pedido->numero }}
                    @if($pedido->complemento)
                        - {{ $pedido->complemento }}
                    @endif
                    <br>
                    {{ $pedido->bairro }} -
                    {{ $pedido->cidade }}/{{ $pedido->estado }}
                    <br>
                    CEP: {{ $pedido->cep }}
                </p>

            </div>

            <p class="confirmacao-aviso">
                Esta é uma compra demonstrativa.
                Nenhum pagamento real foi realizado.
            </p>

            <div class="confirmacao-acoes">

                @auth
                    <a href="{{ route('meus-pedidos.index') }}">
                        MEUS PEDIDOS
                    </a>
                @endauth

                <a href="{{ route('loja.index') }}">
                    CONTINUAR COMPRANDO
                </a>

            </div>

        </div>

    </div>

</section>

@endsection