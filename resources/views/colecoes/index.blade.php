@extends('layouts.app')

@section('content')
<section class="colecoes-page">

    <header class="colecoes-hero">
        <span>VÂNDALA STREETWEAR</span>
        <h1>NOSSAS COLEÇÕES</h1>
        <p>Vista a rebeldia. Encontre sua identidade.</p>
    </header>

    <div class="colecoes-container">

        <div class="colecoes-intro">
            <span>EXPLORE A VÂNDALA</span>
            <h2>ESCOLHA SUA VIBE.</h2>
            <p>
                Descubra nossas categorias e encontre as peças
                que combinam com o seu estilo.
            </p>
        </div>

        <div class="colecoes-grid">
            @forelse ($categorias as $categoria)
                <a
                    href="{{ route('loja.index', ['categoria' => $categoria->id]) }}"
                    class="colecao-card"
                >
                    <div class="colecao-card-conteudo">
                        <span class="colecao-numero">
                            {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                        </span>

                        <h3>{{ $categoria->nome }}</h3>

                        <p>
                            {{ $categoria->produtos_count }}
                            {{ $categoria->produtos_count === 1 ? 'produto disponível' : 'produtos disponíveis' }}
                        </p>

                        <span class="colecao-link">
                            EXPLORAR COLEÇÃO →
                        </span>
                    </div>
                </a>
            @empty
                <div class="colecoes-vazio">
                    <h3>Nenhuma coleção encontrada.</h3>
                    <p>Cadastre categorias para exibi-las aqui.</p>
                </div>
            @endforelse
        </div>

        <div class="colecoes-cta">
            <h2>SEU PRÓXIMO LOOK COMEÇA AQUI.</h2>
            <a href="{{ route('loja.index') }}">
                VER TODOS OS PRODUTOS →
            </a>
        </div>

    </div>
</section>
@endsection