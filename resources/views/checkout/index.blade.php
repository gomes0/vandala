@extends('layouts.app')

@section('title', 'Checkout | Vândala')

@section('content')

<section class="checkout">

    <div class="container">

        <div class="checkout-header">

            <span>VÂNDALA</span>

            <h1>FINALIZAR COMPRA</h1>

        </div>

        <div class="checkout-grid">

            {{-- DADOS DO CLIENTE --}}
            <div class="checkout-form">

                <h2>Dados para entrega</h2>

                <form action="#" method="POST" id="checkout-form">

                    @csrf

                    <div class="form-group">
                        <label for="nome">Nome</label>

                        <input
                            type="text"
                            id="nome"
                            name="nome"
                            required
                        >
                    </div>

                    <div class="form-group">
                        <label for="email">E-mail</label>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            required
                        >
                    </div>

                    <div class="checkout-dupla">

                        <div class="form-group">
                            <label for="cpf">CPF</label>

                            <input
                                type="text"
                                id="cpf"
                                name="cpf"
                                required
                            >
                        </div>

                        <div class="form-group">
                            <label for="telefone">Telefone</label>

                            <input
                                type="text"
                                id="telefone"
                                name="telefone"
                                required
                            >
                        </div>

                    </div>

                    <div class="checkout-dupla">

                        <div class="form-group">
                            <label for="cep">CEP</label>

                            <input
                                type="text"
                                id="cep"
                                name="cep"
                                required
                            >
                        </div>

                        <div class="form-group">
                            <label for="estado">Estado</label>

                            <input
                                type="text"
                                id="estado"
                                name="estado"
                                required
                            >
                        </div>

                    </div>

                    <div class="form-group">
                        <label for="cidade">Cidade</label>

                        <input
                            type="text"
                            id="cidade"
                            name="cidade"
                            required
                        >
                    </div>

                    <div class="form-group">
                        <label for="bairro">Bairro</label>

                        <input
                            type="text"
                            id="bairro"
                            name="bairro"
                            required
                        >
                    </div>

                    <div class="checkout-dupla">

                        <div class="form-group">
                            <label for="endereco">Endereço</label>

                            <input
                                type="text"
                                id="endereco"
                                name="endereco"
                                required
                            >
                        </div>

                        <div class="form-group">
                            <label for="numero">Número</label>

                            <input
                                type="text"
                                id="numero"
                                name="numero"
                                required
                            >
                        </div>

                    </div>

                    <div class="form-group">
                        <label for="complemento">
                            Complemento
                        </label>

                        <input
                            type="text"
                            id="complemento"
                            name="complemento"
                        >
                    </div>

                </form>

            </div>


            {{-- RESUMO --}}
            <div class="checkout-resumo">

                <h2>Resumo do pedido</h2>

                @foreach($carrinho as $item)

                    <div class="checkout-produto">

                        <div>

                            <strong>
                                {{ $item['nome'] }}
                            </strong>

                            <span>
                                {{ $item['quantidade'] }}x
                            </span>

                        </div>

                        <strong>
                            R$
                            {{ number_format(
                                $item['preco'] * $item['quantidade'],
                                2,
                                ',',
                                '.'
                            ) }}
                        </strong>

                    </div>

                @endforeach

                <div class="checkout-total">

                    <span>TOTAL</span>

                    <strong>
                        R$ {{ number_format($total, 2, ',', '.') }}
                    </strong>

                </div>

                <button
                    type="submit"
                    form="checkout-form"
                    class="checkout-finalizar"
                >
                    FINALIZAR PEDIDO
                </button>

            </div>

        </div>

    </div>

</section>

@endsection