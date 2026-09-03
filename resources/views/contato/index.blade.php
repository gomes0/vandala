@extends('layouts.app')

@section('title', 'Contato')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/contato.css') }}">
@endsection

@section('content')

    <!-- BANNER -->
    <section class="contato-banner">

        <div class="contato-banner-overlay">

            <h1>CONTATO</h1>

            <p>
                Tem alguma dúvida? Fale com a Vândala.
            </p>

        </div>

    </section>


    <!-- CONTEÚDO -->
    <section class="contato-section">

        <div class="container contato-grid">


            <!-- INFORMAÇÕES -->
            <div class="contato-info">

                <span class="contato-subtitulo">
                    FALE COM A GENTE
                </span>

                <h2>
                    Estamos aqui para ouvir você.
                </h2>

                <p class="contato-descricao">
                    Entre em contato com a Vândala para tirar dúvidas,
                    enviar sugestões ou conversar com nossa equipe.
                </p>


                <div class="contato-item">

                    <div class="contato-icon">

                        <i class="fa-solid fa-envelope"></i>

                    </div>

                    <div>

                        <span>E-mail</span>

                        <a href="mailto:contato@vandala.com">
                            contato@vandala.com
                        </a>

                    </div>

                </div>


                <div class="contato-item">

                    <div class="contato-icon">

                        <i class="fa-brands fa-whatsapp"></i>

                    </div>

                    <div>

                        <span>WhatsApp</span>

                        <a href="#">
                            (00) 00000-0000
                        </a>

                    </div>

                </div>


                <div class="contato-item">

                    <div class="contato-icon">

                        <i class="fa-brands fa-instagram"></i>

                    </div>

                    <div>

                        <span>Instagram</span>

                        <a href="#">
                            @vandala
                        </a>

                    </div>

                </div>


                <div class="contato-redes">

                    <a href="#">
                        <i class="fa-brands fa-instagram"></i>
                    </a>

                    <a href="#">
                        <i class="fa-brands fa-tiktok"></i>
                    </a>

                </div>

            </div>


            <!-- FORMULÁRIO -->
            <div class="contato-form-box">

                <h2>
                    Envie uma mensagem
                </h2>

                <p>
                    Preencha o formulário e entraremos em contato.
                </p>


                <form action="#" method="POST">

                    @csrf


                    <div class="form-group">

                        <label for="nome">
                            Nome
                        </label>

                        <input
                            type="text"
                            id="nome"
                            name="nome"
                            placeholder="Digite seu nome"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label for="email">
                            E-mail
                        </label>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            placeholder="Digite seu e-mail"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label for="assunto">
                            Assunto
                        </label>

                        <input
                            type="text"
                            id="assunto"
                            name="assunto"
                            placeholder="Qual é o assunto?"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label for="mensagem">
                            Mensagem
                        </label>

                        <textarea
                            id="mensagem"
                            name="mensagem"
                            placeholder="Digite sua mensagem..."
                            required
                        ></textarea>

                    </div>


                    <button type="submit" class="contato-btn">

                        <i class="fa-solid fa-paper-plane"></i>

                        ENVIAR MENSAGEM

                    </button>

                </form>

            </div>

        </div>

    </section>


    <!-- FAQ -->
    <section class="contato-faq">

        <div class="container">

            <div class="faq-header">

                <span>DÚVIDAS</span>

                <h2>Perguntas frequentes</h2>

            </div>


            <div class="faq-grid">

                <div class="faq-item">

                    <h3>
                        <i class="fa-solid fa-truck"></i>
                        Como funciona a entrega?
                    </h3>

                    <p>
                        Após a confirmação do pedido, ele será preparado e enviado
                        para o endereço informado durante a compra.
                    </p>

                </div>


                <div class="faq-item">

                    <h3>
                        <i class="fa-solid fa-rotate-left"></i>
                        Posso trocar um produto?
                    </h3>

                    <p>
                        Sim. Caso precise realizar uma troca, entre em contato
                        com nossa equipe para receber as orientações.
                    </p>

                </div>


                <div class="faq-item">

                    <h3>
                        <i class="fa-solid fa-shirt"></i>
                        Como escolher o tamanho?
                    </h3>

                    <p>
                        Cada produto poderá possuir informações sobre tamanhos
                        para ajudar você a escolher a peça ideal.
                    </p>

                </div>

            </div>

        </div>

    </section>

@endsection