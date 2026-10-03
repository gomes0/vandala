@extends('layouts.app')

@section('title', 'Carrinho | Vândala')

@section('content')

<section class="carrinho">

    <div class="container">

        <div class="carrinho-header">
            <span>VÂNDALA</span>
            <h1>SEU CARRINHO</h1>
        </div>

        @if(session('sucesso'))
            <div class="carrinho-mensagem sucesso">
                {{ session('sucesso') }}
            </div>
        @endif

        @if(session('erro'))
            <div class="carrinho-mensagem erro">
                {{ session('erro') }}
            </div>
        @endif

        @if(empty($carrinho))

            <div class="carrinho-vazio">
                <h2>Seu carrinho está vazio.</h2>

                <a href="{{ route('home') }}">
                    CONTINUAR COMPRANDO 
                </a>
            </div>

        @else

            @php
                $total = 0;
            @endphp

            <div class="carrinho-lista">

                @foreach($carrinho as $item)

                    @php
                        $subtotal = $item['preco'] * $item['quantidade'];
                        $total += $subtotal;
                    @endphp

                    <div class="carrinho-item">

                        <div class="carrinho-item-imagem">

                            @if($item['imagem'])
                                <img
                                    src="{{ asset($item['imagem']) }}"
                                    alt="{{ $item['nome'] }}"
                                >
                            @else
                                <span>Sem imagem</span>
                            @endif

                        </div>

                        <div class="carrinho-item-info">

                            <h2>{{ $item['nome'] }}</h2>

                            <p>
                                R$ {{ number_format($item['preco'], 2, ',', '.') }}
                            </p>

                            <div class="carrinho-quantidade">

                                <form
                                    action="{{ route('carrinho.diminuir', $item['id']) }}"
                                    method="POST"
                                >
                                    @csrf

                                    <button type="submit">−</button>
                                </form>

                                <span>
                                    {{ $item['quantidade'] }}
                                </span>

                                <form
                                    action="{{ route('carrinho.aumentar', $item['id']) }}"
                                    method="POST"
                                >
                                    @csrf

                                    <button type="submit">+</button>
                                </form>

                            </div>

                        </div>

                        <div class="carrinho-item-total">

                            <strong>
                                R$ {{ number_format($subtotal, 2, ',', '.') }}
                            </strong>

                            <form
                                action="{{ route('carrinho.remover', $item['id']) }}"
                                method="POST"
                            >
                                @csrf

                                <button type="submit">
                                    REMOVER
                                </button>
                            </form>

                        </div>

                    </div>

                @endforeach

            </div>

            <div class="carrinho-resumo">

                <span>TOTAL</span>

                <strong>
                    R$ {{ number_format($total, 2, ',', '.') }}
                </strong>

            </div>

            <div class="carrinho-finalizar">

                <a href="{{ route('checkout.index') }}">
                    FINALIZAR COMPRA 
                </a>

            </div>

        @endif

    </div>

</section>

@endsection