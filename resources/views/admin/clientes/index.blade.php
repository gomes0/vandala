
@extends('admin.layouts.admin')

@section('title', 'Clientes')

@section('content')

<div class="page-header">
    <h1>Clientes</h1>
    <p>Gerencie os clientes cadastrados na VÂNDALA.</p>
</div>

<div class="panel">

    <form method="GET" action="{{ route('admin.clientes.index') }}"
          style="display: flex; gap: 12px; margin-bottom: 25px;">

        <input
            type="text"
            name="busca"
            value="{{ request('busca') }}"
            placeholder="Pesquisar por nome ou e-mail..."
            style="flex: 1; padding: 12px; border-radius: 6px;"
        >

        <button type="submit" class="btn-primary">
            <i class="bi bi-search"></i> Pesquisar
        </button>

        @if(request('busca'))
            <a href="{{ route('admin.clientes.index') }}" class="btn-primary">
                Limpar
            </a>
        @endif
    </form>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Cliente</th>
                    <th>E-mail</th>
                    <th>Cadastro</th>
                    <th>Pedidos</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
                @forelse($clientes as $cliente)
                    <tr>
                        <td>{{ $cliente->name }}</td>
                        <td>{{ $cliente->email }}</td>
                        <td>{{ $cliente->created_at?->format('d/m/Y') }}</td>
                        <td>{{ $cliente->pedidos_count }}</td>
                        <td>{{ ucfirst($cliente->status ?? 'indefinido') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">
                            Nenhum cliente encontrado.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="margin-top: 20px;">
        {{ $clientes->links() }}
    </div>

</div>

@endsection
