@php
    $imagem = $produto->imagens()->where('principal', true)->first();
@endphp

<div style="border:1px solid #000; padding:20px;">

    @if ($imagem)
        <div class="produto-imagem">

            <img src="{{ asset($imagem->caminho) }}" alt="{{ $produto->nome }}">

        </div>
    @else
        <p>Sem imagem</p>
    @endif

    <h2>{{ $produto->nome }}</h2>

    <p>{{ $produto->categoria->nome }}</p>

    <p>R$ {{ number_format($produto->preco, 2, ',', '.') }}</p>

</div>
