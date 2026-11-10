
@php
    $imagem = $produto->imagens()
        ->where('principal', true)
        ->first();

    $imagem = $imagem ?? $produto->imagens()->first();

    $favoritado = auth()->check()
        && auth()->user()->favoritos->contains('id', $produto->id);
@endphp

<div class="produto-card-wrapper">

    {{-- Botão de favorito --}}
    @auth
        <form
            action="{{ route('favoritos.store', $produto) }}"
            method="POST"
            class="favorito-form"
            data-store-url="{{ route('favoritos.store', $produto) }}"
            data-destroy-url="{{ route('favoritos.destroy', $produto) }}"
            data-favoritado="{{ $favoritado ? 'true' : 'false' }}"
        >
            @csrf

            <button
                type="submit"
                class="favorito-btn {{ $favoritado ? 'favoritado' : '' }}"
                aria-label="{{ $favoritado ? 'Remover dos favoritos' : 'Adicionar aos favoritos' }}"
                title="{{ $favoritado ? 'Remover dos favoritos' : 'Adicionar aos favoritos' }}"
            >
                <i class="{{ $favoritado ? 'fa-solid' : 'fa-regular' }} fa-heart"></i>
            </button>
        </form>
    @else
        <a
            href="{{ route('login') }}"
            class="favorito-btn"
            aria-label="Entre para adicionar aos favoritos"
            title="Entre para adicionar aos favoritos"
        >
            <i class="fa-regular fa-heart"></i>
        </a>
    @endauth

    {{-- Link do produto --}}
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

</div>


@once
    @push('scripts')
        <script>
            document.addEventListener('submit', async function (event) {

                const form = event.target.closest('.favorito-form');

                if (!form) {
                    return;
                }

                event.preventDefault();

                const button = form.querySelector('.favorito-btn');
                const icon = button.querySelector('i');

                if (button.disabled) {
                    return;
                }

                const favoritado = form.dataset.favoritado === 'true';

                const url = favoritado
                    ? form.dataset.destroyUrl
                    : form.dataset.storeUrl;

                const dados = new FormData(form);

                // Utiliza POST com method spoofing para permitir DELETE no Laravel.
                if (favoritado) {
                    dados.append('_method', 'DELETE');
                }

                button.disabled = true;

                try {
                    const response = await fetch(url, {
                        method: 'POST',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        },
                        body: dados
                    });

                    const data = await response.json();

                    if (!response.ok || !data.success) {
                        throw new Error(
                            data.message || 'Não foi possível atualizar os favoritos.'
                        );
                    }

                    form.dataset.favoritado = data.favoritado ? 'true' : 'false';

                    button.classList.toggle('favoritado', data.favoritado);

                    button.setAttribute(
                        'aria-label',
                        data.favoritado
                            ? 'Remover dos favoritos'
                            : 'Adicionar aos favoritos'
                    );

                    button.title = data.favoritado
                        ? 'Remover dos favoritos'
                        : 'Adicionar aos favoritos';

                    icon.classList.toggle('fa-solid', data.favoritado);
                    icon.classList.toggle('fa-regular', !data.favoritado);

                } catch (error) {
                    console.error('Erro nos favoritos:', error);
                    alert(error.message);

                } finally {
                    button.disabled = false;
                }
            });
        </script>
    @endpush
@endonce

