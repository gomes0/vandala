
@extends('layouts.app')

@section('title', 'Adicionar endereço | VÂNDALA')

@section('content')
<section class="enderecos-page">
    <div class="enderecos-container">

        <a href="{{ route('enderecos.index') }}" class="endereco-voltar">
            <i class="bi bi-arrow-left"></i> Voltar aos endereços
        </a>

        <div class="enderecos-heading">
            <span>ÁREA DO CLIENTE</span>
            <h1>ADICIONAR <strong>ENDEREÇO</strong></h1>
            <p>Preencha os dados para cadastrar um novo endereço.</p>
        </div>

        @if ($errors->any())
            <div class="endereco-alerta">
                @foreach ($errors->all() as $erro)
                    <p>{{ $erro }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('enderecos.store') }}" method="POST" class="endereco-form">
            @include('enderecos._form', ['botao' => 'SALVAR ENDEREÇO'])
        </form>

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
    max-width: 850px;
    margin: auto;
}
.endereco-voltar {
    color: #aaa;
    text-decoration: none;
}
.endereco-voltar:hover { color: #A11212; }
.enderecos-heading { margin: 35px 0; }
.enderecos-heading span {
    color: #A11212;
    font-size: 12px;
    letter-spacing: 3px;
}
.enderecos-heading h1 {
    font-family: 'Anton', sans-serif;
    font-size: clamp(30px, 5vw, 45px);
    margin: 10px 0;
}
.enderecos-heading h1 strong { color: #A11212; }
.enderecos-heading p { color: #999; }
.endereco-form {
    background: #141414;
    border: 1px solid #292929;
    border-radius: 12px;
    padding: 30px;
}
.endereco-form-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 22px;
}
.endereco-campo {
    display: flex;
    flex-direction: column;
    gap: 9px;
}
.endereco-campo label {
    color: #ccc;
    font-size: 13px;
}
.endereco-campo input {
    width: 100%;
    padding: 13px;
    background: #0a0a0a;
    border: 1px solid #333;
    border-radius: 6px;
    color: #fff;
    outline: none;
}
.endereco-campo input:focus { border-color: #A11212; }
.endereco-principal {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-top: 25px;
    color: #ccc;
    font-size: 14px;
}
.endereco-principal input { accent-color: #A11212; }
.endereco-acoes {
    display: flex;
    justify-content: flex-end;
    gap: 15px;
    margin-top: 30px;
}
.endereco-acoes a, .endereco-acoes button {
    padding: 12px 20px;
    border-radius: 6px;
    font-weight: 600;
    text-decoration: none;
    cursor: pointer;
}
.endereco-acoes a {
    color: #ccc;
    border: 1px solid #444;
}
.endereco-acoes button {
    color: #fff;
    background: #A11212;
    border: none;
}
.endereco-acoes button:hover { background: #c01818; }
.endereco-alerta {
    padding: 12px 18px;
    margin-bottom: 20px;
    background: #321313;
    border: 1px solid #702020;
    border-radius: 6px;
    color: #ffbaba;
}
@media (max-width: 600px) {
    .endereco-form { padding: 20px; }
    .endereco-form-grid { grid-template-columns: 1fr; }
}
</style>
@endsection
