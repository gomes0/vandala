
@extends('layouts.app')

@section('title', 'Meus endereços | VÂNDALA')

@section('content')

<section class="enderecos-page">
    <div class="enderecos-container">

        <div class="enderecos-heading">
            <span>ÁREA DO CLIENTE</span>
            <h1>MEUS <strong>ENDEREÇOS</strong></h1>
            <p>Gerencie os endereços utilizados em suas compras.</p>
        </div>

        <div class="enderecos-topo">
            <a href="{{ route('profile.edit') }}" class="endereco-voltar">
                <i class="bi bi-arrow-left"></i> Minha conta
            </a>

            <a href="{{ route('enderecos.create') }}" class="btn-adicionar-endereco">
                <i class="bi bi-plus-lg"></i> ADICIONAR ENDEREÇO
            </a>
        </div>

        @if(session('success'))
            <div class="endereco-sucesso">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="endereco-alerta">
                @foreach($errors->all() as $erro)
                    <p>{{ $erro }}</p>
                @endforeach
            </div>
        @endif

        @if($enderecos->isEmpty())

            <div class="enderecos-vazio">
                <i class="bi bi-geo-alt"></i>
                <h2>NENHUM ENDEREÇO CADASTRADO</h2>
                <p>Você ainda não possui endereços cadastrados.</p>

                <a href="{{ route('enderecos.create') }}">
                    CADASTRAR MEU PRIMEIRO ENDEREÇO
                </a>
            </div>

        @else

            <div class="enderecos-lista">

                @foreach($enderecos as $endereco)

                    <article class="endereco-card">

                        <div class="endereco-card-header">
                            <div>
                                <h3>{{ $endereco->nome_destinatario }}</h3>

                                @if($endereco->principal)
                                    <span class="endereco-badge">
                                        <i class="bi bi-check-circle-fill"></i>
                                        ENDEREÇO PRINCIPAL
                                    </span>
                                @endif
                            </div>

                            <i class="bi bi-geo-alt endereco-icone"></i>
                        </div>

                        <div class="endereco-informacoes">

                            @if($endereco->telefone)
                                <p>
                                    <i class="bi bi-telephone"></i>
                                    {{ $endereco->telefone }}
                                </p>
                            @endif

                            <p>
                                <i class="bi bi-signpost"></i>
                                {{ $endereco->rua }}, {{ $endereco->numero }}

                                @if($endereco->complemento)
                                    - {{ $endereco->complemento }}
                                @endif
                            </p>

                            <p>
                                <i class="bi bi-pin-map"></i>
                                {{ $endereco->bairro }} -
                                {{ $endereco->cidade }}/{{ $endereco->estado }}
                            </p>

                            <p>
                                <i class="bi bi-mailbox"></i>
                                CEP: {{ $endereco->cep }}
                            </p>

                        </div>

                        <div class="endereco-card-acoes">

                            <a href="{{ route('enderecos.edit', $endereco->id) }}">
                                <i class="bi bi-pencil"></i> EDITAR
                            </a>

                            @unless($endereco->principal)
                                <form action="{{ route('enderecos.principal', $endereco->id) }}"
                                      method="POST">
                                    @csrf
                                    @method('PATCH')

                                    <button type="submit">
                                        <i class="bi bi-check-circle"></i>
                                        DEFINIR COMO PRINCIPAL
                                    </button>
                                </form>
                            @endunless

                            <form action="{{ route('enderecos.destroy', $endereco->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Deseja realmente excluir este endereço?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn-excluir-endereco">
                                    <i class="bi bi-trash"></i> EXCLUIR
                                </button>
                            </form>

                        </div>

                    </article>

                @endforeach

            </div>

        @endif

    </div>
</section>

@endsection

@section('styles')
<style>
.enderecos-page {
    min-height: 75vh;
    padding: 60px 20px;
    background: #0a0a0a;
    color: #fff;
}

.enderecos-container {
    max-width: 1000px;
    margin: auto;
}

.enderecos-heading {
    margin-bottom: 35px;
}

.enderecos-heading span {
    color: #A11212;
    font-size: 12px;
    letter-spacing: 3px;
}

.enderecos-heading h1 {
    font-family: 'Anton', sans-serif;
    font-size: clamp(32px, 5vw, 46px);
    margin: 10px 0;
}

.enderecos-heading h1 strong {
    color: #A11212;
}

.enderecos-heading p {
    color: #999;
}

.enderecos-topo {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 15px;
    margin-bottom: 25px;
    flex-wrap: wrap;
}

.endereco-voltar {
    color: #aaa;
    text-decoration: none;
}

.endereco-voltar:hover {
    color: #A11212;
}

.btn-adicionar-endereco {
    background: #A11212;
    color: #fff;
    padding: 13px 20px;
    border-radius: 6px;
    text-decoration: none;
    font-size: 12px;
    font-weight: 700;
}

.btn-adicionar-endereco:hover {
    background: #c01818;
}

.enderecos-lista {
    display: grid;
    gap: 20px;
}

.endereco-card {
    background: #141414;
    border: 1px solid #292929;
    border-radius: 10px;
    padding: 25px;
}

.endereco-card-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    border-bottom: 1px solid #292929;
    padding-bottom: 18px;
}

.endereco-card-header h3 {
    font-size: 18px;
    margin: 0 0 10px;
}

.endereco-badge {
    display: inline-block;
    color: #e5a0a0;
    background: #351313;
    padding: 6px 10px;
    border-radius: 4px;
    font-size: 10px;
    font-weight: 700;
}

.endereco-icone {
    color: #A11212;
    font-size: 25px;
}

.endereco-informacoes {
    padding: 15px 0;
}

.endereco-informacoes p {
    color: #bbb;
    font-size: 14px;
    margin: 10px 0;
}

.endereco-informacoes i {
    color: #A11212;
    margin-right: 8px;
}

.endereco-card-acoes {
    display: flex;
    gap: 18px;
    flex-wrap: wrap;
    border-top: 1px solid #292929;
    padding-top: 18px;
}

.endereco-card-acoes a,
.endereco-card-acoes button {
    background: none;
    border: none;
    color: #ccc;
    text-decoration: none;
    font-size: 11px;
    font-weight: 700;
    cursor: pointer;
}

.endereco-card-acoes a:hover,
.endereco-card-acoes button:hover {
    color: #A11212;
}

.endereco-card-acoes .btn-excluir-endereco {
    color: #d45b5b;
}

.endereco-card-acoes form {
    margin: 0;
}

.enderecos-vazio {
    text-align: center;
    background: #141414;
    border: 1px solid #292929;
    border-radius: 10px;
    padding: 55px 20px;
}

.enderecos-vazio > i {
    color: #A11212;
    font-size: 45px;
}

.enderecos-vazio h2 {
    font-family: 'Anton', sans-serif;
    margin: 20px 0 10px;
}

.enderecos-vazio p {
    color: #999;
    margin-bottom: 25px;
}

.enderecos-vazio a {
    display: inline-block;
    background: #A11212;
    color: white;
    padding: 13px 20px;
    border-radius: 5px;
    text-decoration: none;
    font-size: 12px;
    font-weight: 700;
}

.endereco-sucesso,
.endereco-alerta {
    padding: 15px;
    margin-bottom: 20px;
    border-radius: 6px;
}

.endereco-sucesso {
    background: #142719;
    border: 1px solid #285b35;
    color: #a6e5b4;
}

.endereco-alerta {
    background: #321313;
    border: 1px solid #702020;
    color: #ffbaba;
}

@media(max-width: 600px) {
    .endereco-card {
        padding: 18px;
    }

    .endereco-card-acoes {
        flex-direction: column;
        gap: 15px;
    }
}
</style>
@endsection
