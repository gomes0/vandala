@php
    $imagem = $produto->imagens()
        ->where('principal', true)
        ->first();

    $imagem = $imagem ?? $produto->imagens()->first();
@endphp

<a href="{{ route('produto.show', $produto) }}" class="produto-card">

    @if ($imagem)

        <div class="produto-imagem">

            <img
                src="{{ asset($imagem->caminho) }}"
                alt="{{ $produto->nome }}"
            >

        </div>

    @else

        <div class="produto-imagem sem-imagem">
            <p>Sem imagem</p>
        </div>

    @endif

    <div class="produto-info">

        <span class="produto-categoria">
            {{ $produto->categoria->nome }}
        </span>

        <h2>{{ $produto->nome }}</h2>

        <p class="produto-preco">
            R$ {{ number_format($produto->preco, 2, ',', '.') }}
        </p>

        <span class="produto-ver">
            VER PRODUTO →
        </span>

    </div>

</a>