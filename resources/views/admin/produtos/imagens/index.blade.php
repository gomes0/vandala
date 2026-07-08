@extends('admin.layouts.admin')

@section('title', 'Imagens')

@section('content')

    <div class="page-header">

        <div>

            <h1>{{ $produto->nome }}</h1>

            <p>Gerenciar imagens do produto</p>

        </div>

    </div>

    @if (session('success'))
        <div class="alert-success">

            {{ session('success') }}

        </div>
    @endif

    <form action="{{ route('produto-imagens.store', $produto) }}" method="POST" enctype="multipart/form-data"
        class="upload-form">

        @csrf

        <input type="file" name="imagem" required>

        <label>

            <input type="checkbox" name="principal">

            Imagem principal

        </label>

        <button class="btn-primary">

            Enviar

        </button>

    </form>

    <div class="galeria">

        @forelse($produto->imagens as $imagem)
            <div class="card-imagem">

                <img src="{{ asset($imagem->caminho) }}">

                @if ($imagem->principal)
                    <span class="badge">

                        Principal

                    </span>
                @else
                    <form method="POST" action="{{ route('produto-imagens.principal', $imagem) }}">

                        @csrf

                        @method('PUT')

                        <button class="btn-secondary">

                            Definir Principal

                        </button>

                    </form>
                @endif

                <form method="POST" action="{{ route('produto-imagens.destroy', $imagem) }}">

                    @csrf

                    @method('DELETE')

                    <button class="btn-delete" onclick="return confirm('Excluir imagem?')">

                        Excluir

                    </button>

                </form>

            </div>

        @empty

            <p>Nenhuma imagem cadastrada.</p>
        @endforelse

    </div>

@endsection
