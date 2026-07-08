@extends('admin.layouts.admin')

@section('title', 'Produtos')

@section('content')

    <div class="page-header">

        <h1>Produtos</h1>

        <a href="{{ route('produtos.create') }}" class="btn-primary">

            <i class="bi bi-plus-circle"></i>

            Novo Produto

        </a>

    </div>

    @if (session('success'))
        <div class="alert-success">

            {{ session('success') }}

        </div>
    @endif

    <table class="table">

        <thead>

            <tr>

                <th>ID</th>

                <th>Nome</th>

                <th>Categoria</th>

                <th>Preço</th>

                <th>Estoque</th>

                <th>Status</th>

                <th width="180">Ações</th>

            </tr>

        </thead>

        <tbody>

            @forelse($produtos as $produto)
                <tr>

                    <td>{{ $produto->id }}</td>

                    <td>{{ $produto->nome }}</td>

                    <td>{{ $produto->categoria->nome }}</td>

                    <td>R$ {{ number_format($produto->preco, 2, ',', '.') }}</td>

                    <td>{{ $produto->estoque }}</td>

                    <td>{{ ucfirst($produto->status) }}</td>

                    <td>

                        <a href="{{ route('produtos.edit', $produto) }}" class="btn-edit">

                            <i class="bi bi-pencil-square"></i>

                        </a>

                        <a href="{{ route('produto-imagens.index', $produto) }}" class="btn-image"
                            title="Gerenciar imagens">

                            <i class="bi bi-images"></i>

                        </a>


                        <form action="{{ route('produtos.destroy', $produto) }}" method="POST" style="display:inline;">

                            @csrf

                            @method('DELETE')

                            <button class="btn-delete" onclick="return confirm('Deseja excluir este produto?')">

                                <i class="bi bi-trash-fill"></i>

                            </button>

                        </form>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="7">

                        Nenhum produto cadastrado.

                    </td>

                </tr>
            @endforelse

        </tbody>

    </table>

@endsection
