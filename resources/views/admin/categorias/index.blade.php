@extends('admin.layouts.admin')

@section('title', 'Categorias')

@section('content')

    <div class="page-header">

        <h1>Categorias</h1>

        <a href="{{ route('categorias.create') }}" class="btn-primary">
            Nova Categoria
        </a>

    </div>

    <table class="table">

        <thead>

            <tr>

                <th>ID</th>

                <th>Nome</th>

                <th>Status</th>

                <th>Ações</th>

            </tr>

        </thead>

        <tbody>

            @foreach ($categorias as $categoria)
                <tr>

                    <td>{{ $categoria->id }}</td>

                    <td>{{ $categoria->nome }}</td>

                    <td>{{ $categoria->status }}</td>

                    <td>

                        <a href="{{ route('categorias.edit', $categoria) }} " class="btn-editar" style="display:inline">
                            Editar
                        </a>

                        <form action="{{ route('categorias.destroy', $categoria) }}" method="POST" style="display:inline">

                            @csrf

                            @method('DELETE')

                            <button class="btn-excluir" type="submit" onclick="return confirm('Tem certeza que deseja excluir esta categoria?')">

                                Excluir

                            </button>

                        </form>

                    </td>

                </tr>
            @endforeach

        </tbody>

    </table>

@endsection
