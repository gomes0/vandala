
@extends('layouts.app')

@section('title', 'Editar endereço | VÂNDALA')

@section('content')
<section class="enderecos-page">
    <div class="enderecos-container">

        <a href="{{ route('enderecos.index') }}" class="endereco-voltar">
            <i class="bi bi-arrow-left"></i> Voltar aos endereços
        </a>

        <div class="enderecos-heading">
            <span>ÁREA DO CLIENTE</span>
            <h1>EDITAR <strong>ENDEREÇO</strong></h1>
            <p>Atualize as informações do endereço cadastrado.</p>
        </div>

        @if ($errors->any())
            <div class="endereco-alerta">
                @foreach ($errors->all() as $erro)
                    <p>{{ $erro }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('enderecos.update', $endereco->id) }}" method="POST" class="endereco-form">
            @method('PUT')
            @include('enderecos._form', ['botao' => 'SALVAR ALTERAÇÕES'])
        </form>

    </div>
</section>
@endsection

@section('styles')
<style>
/* Os estilos desta tela são os mesmos da tela de cadastro. */
</style>
@endsection
