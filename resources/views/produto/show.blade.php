@extends('layouts.app')

@section('title', $produto->nome . ' | Vândala')

@section('content')

<section class="produto-detalhes">

    <div class="container">

        <div class="produto-detalhes-grid">

            {{-- IMAGENS --}}
            <div class="produto-galeria">

                <div class="produto-imagem-principal">

                    @php
                        $imagemPrincipal = $produto->imagens
                            ->where('principal', true)
                            ->first();

                        $imagemPrincipal = $imagemPrincipal
                            ?? $produto->imagens->first();
                    @endphp

                    @if($imagemPrincipal)
                        <img
                            id="imagem-principal"
                            src="{{ asset($imagemPrincipal->caminho) }}"
                            alt="{{ $produto->nome }}"
                        >
                    @else
                        <div class="sem-imagem">
                            Sem imagem
                        </div>
                    @endif

                </div>

                {{-- MINIATURAS --}}
                @if($produto->imagens->count() > 1)

                    <div class="produto-miniaturas">

                        @foreach($produto->imagens as $imagem)

                            <button
                                type="button"
                                onclick="trocarImagem('{{ asset($imagem->caminho) }}')"
                            >
                                <img
                                    src="{{ asset($imagem->caminho) }}"
                                    alt="{{ $produto->nome }}"
                                >
                            </button>

                        @endforeach

                    </div>

                @endif

            </div>


            {{-- INFORMAÇÕES --}}
            <div class="produto-detalhes-info">

                @if($produto->categoria)
                    <span class="produto-detalhes-categoria">
                        {{ $produto->categoria->nome }}
                    </span>
                @endif

                <h1>{{ $produto->nome }}</h1>

                <div class="produto-detalhes-preco">
                    R$ {{ number_format($produto->preco, 2, ',', '.') }}
                </div>

                @if($produto->descricao)
                    <div class="produto-detalhes-descricao">

                        <h3>Descrição</h3>

                        <p>
                            {{ $produto->descricao }}
                        </p>

                    </div>
                @endif

                <div class="produto-detalhes-estoque">

                    @if($produto->estoque > 0)

                        <span class="disponivel">
                            Em estoque
                        </span>

                        <small>
                            {{ $produto->estoque }} unidades disponíveis
                        </small>

                    @else

                        <span class="esgotado">
                            Produto esgotado
                        </span>

                    @endif

                </div>

                @if($produto->estoque > 0)

                    <button class="produto-adicionar">
                        ADICIONAR AO CARRINHO
                    </button>

                @endif

            </div>

        </div>

    </div>

</section>

@endsection


@section('scripts')

<script>

function trocarImagem(imagem) {

    document.getElementById('imagem-principal').src = imagem;

}

</script>

@endsection