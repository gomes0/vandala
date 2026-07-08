@extends('layouts.app')

@section('title', 'Home')

@section('content')

    <section class="hero">

        <div class="container">

            <h1>VISTA A REBELDIA</h1>

            <p>Nascida no concreto. Feita para as ruas.</p>

            <a href="#" class="btn">
                Explorar Coleção
            </a>

        </div>

    </section>

    <section class="produtos-home">

        <div class="container">

            <h2>Produtos</h2>

            <div class="produtos-grid">

                @foreach ($produtos as $produto)
                    <x-produto-card :produto="$produto" />
                @endforeach

            </div>

        </div>

    </section>

@endsection
