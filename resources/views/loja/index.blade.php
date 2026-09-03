@extends('layouts.app')

@section('title', 'Sobre')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/sobre.css') }}">
@endsection

@section('content')

<section class="sobre-banner">

    <div class="overlay">

        <h1>SOBRE A VÂNDALA</h1>

        <p>Mais que roupas. Uma identidade.</p>

    </div>

</section>

<section class="sobre-historia">

    <div class="container">

        <div class="texto">

            <h2>Nossa História</h2>

            <p>
                A Vândala nasceu da paixão pela cultura urbana e pela liberdade de
                expressão. Inspirada nas ruas, na arte e na autenticidade, a marca
                busca criar peças que representem personalidade e atitude para quem
                deseja vestir seu próprio estilo.
            </p>

        </div>

        <div class="imagem">

            <img src="{{ asset('img/sobre.jpg') }}" alt="Vândala">

        </div>

    </div>

</section>

<section class="missao">

    <div class="container">

        <div class="card">

            <i class="fa-solid fa-bullseye"></i>

            <h3>Missão</h3>

            <p>
                Criar roupas que representem autenticidade, conforto e atitude.
            </p>

        </div>

        <div class="card">

            <i class="fa-solid fa-eye"></i>

            <h3>Visão</h3>

            <p>
                Ser referência no mercado streetwear nacional.
            </p>

        </div>

        <div class="card">

            <i class="fa-solid fa-gem"></i>

            <h3>Valores</h3>

            <p>
                Qualidade, criatividade, respeito e originalidade.
            </p>

        </div>

    </div>

</section>

<section class="cta">

    <div class="container">

        <h2>Vista sua identidade.</h2>

        <p>
            Conheça nossa coleção e encontre peças que representam quem você é.
        </p>

        <a href="/loja" class="btn">
            Explorar Coleção
        </a>

    </div>

</section>

@endsection