@extends('layouts.app')

@section('title', 'Meus favoritos | VÂNDALA')

@section('content')

    <section class="favoritos-page">

        <div class="favoritos-container">

            {{-- CABEÇALHO --}}
            <div class="favoritos-header">

                <div class="favoritos-titulo">

                    <span class="favoritos-eyebrow">
                        SUA SELEÇÃO VÂNDALA
                    </span>

                    <h1>MEUS <span>FAVORITOS</span></h1>

                    <p>
                        As peças que representam seu estilo.
                    </p>

                </div>

                <div class="favoritos-acoes">

                    <div class="favoritos-contagem">
                        <i class="bi bi-heart-fill"></i>

                        <span>
                            {{ $produtos->total() }}
                            {{ $produtos->total() === 1 ? 'PRODUTO SALVO' : 'PRODUTOS SALVOS' }}
                        </span>
                    </div>
                </div>
            </div>

            {{-- MENSAGEM DE SUCESSO --}}
            @if (session('success'))
                <div class="favoritos-alerta">
                    <i class="bi bi-check-circle"></i>
                    {{ session('success') }}
                </div>
            @endif

            {{-- LISTAGEM --}}
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
                {{-- LISTA VAZIA --}}
                <div class="favoritos-vazio">

                    <div class="favoritos-vazio-icone">
                        <i class="bi bi-heart"></i>
                    </div>

                    <span class="favoritos-eyebrow">
                        SUA LISTA ESTÁ VAZIA
                    </span>

                    <h2>NENHUM FAVORITO POR ENQUANTO.</h2>

                    <p>
                        Explore nossa loja e salve as peças
                        que mais combinam com você.
                    </p>

                    <a href="{{ route('loja.index') }}" class="favoritos-btn">
                        EXPLORAR PRODUTOS
                        <i class="bi bi-arrow-right"></i>
                    </a>

                </div>

            @endif

        </div>

    </section>

@endsection
