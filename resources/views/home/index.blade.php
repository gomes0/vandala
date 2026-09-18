@extends('layouts.app')

@section('title', 'Home')

@section('content')

    {{-- HERO --}}
    <section class="hero">

        <video class="hero-video" autoplay muted loop playsinline>
            <source src="{{ asset('videos/bigrushgif.mp4') }}" type="video/mp4">
        </video>

        <div class="hero-overlay"></div>

        <div class="container hero-content">

            <h1>VISTA A REBELDIA</h1>

            <p>Nascida no concreto. Feita para as ruas.</p>

            <a href="/loja" class="btn">
                Explorar Coleção
            </a>

        </div>

    </section>


    {{-- CATEGORIAS --}}
    <section class="categorias-home">

        <div class="container">

            <h2>EXPLORE POR CATEGORIA</h2>

            <div class="categorias-grid">

                @forelse($categorias as $categoria)

                    <a href="#" class="categoria-card">

                        <h3>{{ $categoria->nome }}</h3>

                        <span>VER PRODUTOS →</span>

                    </a>

                @empty

                    <p>Nenhuma categoria cadastrada.</p>

                @endforelse

            </div>

        </div>

    </section>
    {{-- LANÇAMENTOS --}}
    <section class="lancamentos">

    <div class="container">

        <div class="lancamentos-header">

            <div>
                <span>VÂNDALA</span>
                <h2>LANÇAMENTOS</h2>
            </div>

            <a href="#" class="ver-todos">
                VER TODOS →
            </a>

        </div>

        <div class="produtos-grid">

            @forelse($produtos as $produto)

                <x-produto-card :produto="$produto" />

            @empty

                <p>Nenhum produto disponível.</p>

            @endforelse

        </div>

    </div>

</section>

@endsection