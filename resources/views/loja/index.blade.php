@extends('layouts.app')

@section('content')
<section class="loja-page">

    <header class="loja-hero">
        <div class="loja-hero-conteudo">
            <span class="loja-eyebrow">VÂNDALA STREETWEAR</span>
            <h1>NOSSA LOJA</h1>
            <p>Nascida no concreto. Feita para as ruas.</p>
        </div>
    </header>

    <div class="loja-container">

        <div class="loja-titulo">
            <div>
                <span class="loja-eyebrow">EXPRESSE SUA IDENTIDADE</span>
                <h2>EXPLORE AS PEÇAS</h2>
            </div>

            <span class="loja-contagem">
                {{ $produtos->total() }}
                {{ $produtos->total() === 1 ? 'PRODUTO' : 'PRODUTOS' }}
            </span>
        </div>

        <form action="{{ route('loja.index') }}"
              method="GET"
              class="loja-filtros">

            <div class="loja-campo loja-campo-busca">
                <label for="busca">Buscar produto</label>
                <input
                    type="search"
                    name="busca"
                    id="busca"
                    placeholder="Ex.: camiseta oversized"
                    value="{{ $busca }}"
                >
            </div>

            <div class="loja-campo">
                <label for="categoria">Categoria</label>
                <select name="categoria" id="categoria">
                    <option value="">Todas as categorias</option>

                    @foreach ($categorias as $categoria)
                        <option
                            value="{{ $categoria->id }}"
                            @selected((string) $categoriaId === (string) $categoria->id)
                        >
                            {{ $categoria->nome }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="loja-campo">
                <label for="preco_min">Preço mínimo (R$)</label>
                <input
                    type="number"
                    name="preco_min"
                    id="preco_min"
                    min="0"
                    step="0.01"
                    placeholder="0,00"
                    value="{{ $precoMin }}"
                >
            </div>

            <div class="loja-campo">
                <label for="preco_max">Preço máximo (R$)</label>
                <input
                    type="number"
                    name="preco_max"
                    id="preco_max"
                    min="0"
                    step="0.01"
                    placeholder="999,99"
                    value="{{ $precoMax }}"
                >
            </div>

            <div class="loja-campo">
                <label for="ordenar">Ordenar por</label>
                <select name="ordenar" id="ordenar">
                    <option value="recentes"
                        @selected($ordenacao === 'recentes')>
                        Mais recentes
                    </option>

                    <option value="menor_preco"
                        @selected($ordenacao === 'menor_preco')>
                        Menor preço
                    </option>

                    <option value="maior_preco"
                        @selected($ordenacao === 'maior_preco')>
                        Maior preço
                    </option>

                    <option value="nome"
                        @selected($ordenacao === 'nome')>
                        Nome: A–Z
                    </option>
                </select>
            </div>

            <div class="loja-acoes-filtro">
                <button type="submit" class="loja-btn-filtrar">
                    APLICAR FILTROS
                </button>

                <a href="{{ route('loja.index') }}"
                   class="loja-btn-limpar">
                    LIMPAR
                </a>
            </div>
        </form>

        @if ($precoMin !== null && $precoMin !== ''
            && $precoMax !== null && $precoMax !== ''
            && is_numeric($precoMin) && is_numeric($precoMax)
            && (float) $precoMin > (float) $precoMax)
            <p class="loja-aviso">
                O preço mínimo é maior que o máximo. Ajuste os valores.
            </p>
        @endif

        @if ($produtos->count() > 0)
            <div class="loja-grade">
                @foreach ($produtos as $produto)
                    <x-produto-card :produto="$produto" />
                @endforeach
            </div>

            <div class="loja-paginacao">
                {{ $produtos->links() }}
            </div>
        @else
            <div class="loja-vazia">
                <span class="loja-eyebrow">NENHUMA PEÇA ENCONTRADA</span>
                <h2>NÃO ENCONTRAMOS ESSES PRODUTOS.</h2>
                <p>Tente alterar os filtros ou faça uma nova busca.</p>

                <a href="{{ route('loja.index') }}"
                   class="loja-btn-filtrar">
                    VER TODOS OS PRODUTOS
                </a>
            </div>
        @endif

    </div>
</section>
@endsection