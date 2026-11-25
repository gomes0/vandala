@extends('layouts.app')

@section('title', 'Checkout | Vândala')

@section('content')

    <section class="checkout">

        <div class="container">

            @if (session('erro'))
                <div class="checkout-erros">
                    {{ session('erro') }}
                </div>
            @endif

            @if (session('sucesso'))
                <div class="checkout-sucesso">
                    {{ session('sucesso') }}
                </div>
            @endif

            <div class="checkout-header">

                <span>VÂNDALA</span>

                <h1>FINALIZAR COMPRA</h1>

            </div>

            @if ($errors->any())
                <div class="checkout-erros">
                    @foreach ($errors->all() as $erro)
                        <p>{{ $erro }}</p>
                    @endforeach
                </div>
            @endif

            <div class="checkout-grid">

                {{-- DADOS DO CLIENTE --}}
                <div class="checkout-form">

                    <h2>Dados para entrega</h2>

                    <form action="{{ route('checkout.store') }}" method="POST" id="checkout-form">

                        @csrf

                        <div class="form-group">
                            <label for="nome">Nome</label>

                            <input type="text" id="nome" name="nome" value="{{ old('nome') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="email">E-mail</label>

                            <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                        </div>

                        <div class="checkout-dupla">

                            <div class="form-group">
                                <label for="cpf">CPF</label>

                                <input type="text" id="cpf" name="cpf" value="{{ old('cpf') }}"
                                    maxlength="14" required>
                            </div>

                            <div class="form-group">
                                <label for="telefone">Telefone</label>

                                <input type="text" id="telefone" name="telefone" value="{{ old('telefone') }}"
                                    maxlength="20" required>
                            </div>

                            @if ($enderecos->isNotEmpty())

                                @php
                                    $enderecoPadrao = $enderecos->firstWhere('principal', true) ?? $enderecos->first();
                                @endphp

                                <div class="form-group checkout-endereco-salvo">

                                    <label for="endereco_id">Escolha um endereço cadastrado</label>

                                    <select name="endereco_id" id="endereco_id">

                                        <option value="">
                                            Cadastrar ou informar outro endereço
                                        </option>

                                        @foreach ($enderecos as $endereco)
                                            <option value="{{ $endereco->id }}" data-cep="{{ $endereco->cep }}"
                                                data-estado="{{ $endereco->estado }}"
                                                data-cidade="{{ $endereco->cidade }}"
                                                data-bairro="{{ $endereco->bairro }}" data-rua="{{ $endereco->rua }}"
                                                data-numero="{{ $endereco->numero }}"
                                                data-complemento="{{ $endereco->complemento }}"
                                                {{ (string) old('endereco_id', $enderecoPadrao->id) === (string) $endereco->id ? 'selected' : '' }}>
                                                {{ $endereco->nome_destinatario }}
                                                — {{ $endereco->rua }}, {{ $endereco->numero }}
                                                {{ $endereco->principal ? '(Principal)' : '' }}
                                            </option>
                                        @endforeach

                                    </select>

                                </div>

                            @endif

                        </div>

                        <div class="checkout-dupla">

                            <div class="form-group">
                                <label for="cep">CEP</label>

                                <input type="text" id="cep" name="cep" value="{{ old('cep') }}"
                                    maxlength="9" required>
                            </div>

                            <div class="form-group">
                                <label for="estado">Estado</label>

                                <input type="text" id="estado" name="estado" value="{{ old('estado') }}"
                                    maxlength="2" required>
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="cidade">Cidade</label>

                            <input type="text" id="cidade" name="cidade" value="{{ old('cidade') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="bairro">Bairro</label>

                            <input type="text" id="bairro" name="bairro" value="{{ old('bairro') }}" required>
                        </div>

                        <div class="checkout-dupla">

                            <div class="form-group">
                                <label for="endereco">Endereço</label>

                                <input type="text" id="endereco" name="endereco" value="{{ old('endereco') }}"
                                    required>
                            </div>

                            <div class="form-group">
                                <label for="numero">Número</label>

                                <input type="text" id="numero" name="numero" value="{{ old('numero') }}" required>
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="complemento">
                                Complemento
                            </label>

                            <input type="text" id="complemento" name="complemento" value="{{ old('complemento') }}">
                        </div>

                        {{-- PAGAMENTO --}}
                        <div class="checkout-pagamento">

                            <h2>Forma de pagamento</h2>

                            <div class="pagamento-opcoes">

                                <label class="pagamento-opcao">

                                    <input type="radio" name="forma_pagamento" value="pix"
                                        {{ old('forma_pagamento', 'pix') === 'pix' ? 'checked' : '' }} required>

                                    <span>
                                        <strong>PIX</strong>
                                        <small>Pagamento simulado</small>
                                    </span>

                                </label>

                                <label class="pagamento-opcao">

                                    <input type="radio" name="forma_pagamento" value="cartao"
                                        {{ old('forma_pagamento') === 'cartao' ? 'checked' : '' }}>

                                    <span>
                                        <strong>Cartão de crédito</strong>
                                        <small>Aprovação simulada</small>
                                    </span>

                                </label>

                                <label class="pagamento-opcao">

                                    <input type="radio" name="forma_pagamento" value="boleto"
                                        {{ old('forma_pagamento') === 'boleto' ? 'checked' : '' }}>

                                    <span>
                                        <strong>Boleto</strong>
                                        <small>Emissão fictícia</small>
                                    </span>

                                </label>

                            </div>

                        </div>

                    </form>

                </div>


                {{-- RESUMO --}}
                <div class="checkout-resumo">

                    <h2>Resumo do pedido</h2>

                    @foreach ($carrinho as $item)
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
                                {{ number_format($item['preco'] * $item['quantidade'], 2, ',', '.') }}
                            </strong>

                        </div>
                    @endforeach

                    <div class="checkout-total">

                        <span>TOTAL</span>

                        <strong>
                            R$ {{ number_format($total, 2, ',', '.') }}
                        </strong>

                    </div>

                    <button type="submit" form="checkout-form" class="checkout-finalizar">
                        FINALIZAR PEDIDO
                    </button>

                    <p class="checkout-aviso">
                        Ambiente demonstrativo. Nenhuma cobrança real será realizada.
                    </p>

                </div>

            </div>

        </div>

    </section>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    const seletor = document.getElementById('endereco_id');

    const campos = {
        cep: document.getElementById('cep'),
        estado: document.getElementById('estado'),
        cidade: document.getElementById('cidade'),
        bairro: document.getElementById('bairro'),
        endereco: document.getElementById('endereco'),
        numero: document.getElementById('numero'),
        complemento: document.getElementById('complemento')
    };

    // Liberar ou bloquear os campos
    function bloquearCampos(bloquear) {
        Object.values(campos).forEach(campo => {
            if (campo) {
                campo.readOnly = bloquear;
            }
        });
    }

    // Limpar os campos para um novo endereço
    function limparCampos() {
        Object.values(campos).forEach(campo => {
            if (campo) {
                campo.value = '';
            }
        });
    }

    // Selecionar endereço cadastrado
    function preencherEndereco(option) {

        if (!option || !option.value) {
            bloquearCampos(false);
            limparCampos();
            return;
        }

        campos.cep.value = option.dataset.cep || '';
        campos.estado.value = option.dataset.estado || '';
        campos.cidade.value = option.dataset.cidade || '';
        campos.bairro.value = option.dataset.bairro || '';
        campos.endereco.value = option.dataset.rua || '';
        campos.numero.value = option.dataset.numero || '';
        campos.complemento.value = option.dataset.complemento || '';

        bloquearCampos(true);
    }

    // Evento de seleção de endereço
    if (seletor) {

        seletor.addEventListener('change', function () {
            preencherEndereco(this.selectedOptions[0]);
        });

        if (seletor.value) {
            preencherEndereco(seletor.selectedOptions[0]);
        } else {
            bloquearCampos(false);
        }
    }

    // Consulta de CEP
    if (campos.cep) {

        campos.cep.addEventListener('blur', async function () {

            if (seletor && seletor.value) {
                return;
            }

            const cep = this.value.replace(/\D/g, '');

            if (cep.length !== 8) {
                return;
            }

            try {

                const resposta = await fetch(
                    'https://viacep.com.br/ws/' + cep + '/json/'
                );

                if (!resposta.ok) {
                    throw new Error('Falha na consulta');
                }

                const dados = await resposta.json();

                if (dados.erro) {
                    alert('CEP não encontrado.');
                    return;
                }

                campos.estado.value = dados.uf || '';
                campos.cidade.value = dados.localidade || '';
                campos.bairro.value = dados.bairro || '';
                campos.endereco.value = dados.logradouro || '';

                campos.numero.focus();

            } catch (erro) {

                alert('Não foi possível consultar o CEP. Verifique sua conexão.');

            }

        });

    }

});
</script>
@endpush
