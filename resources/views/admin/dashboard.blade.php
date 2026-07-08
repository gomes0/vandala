@extends('admin.layouts.admin')

@section('title', 'Dashboard')

@section('content')

<h1 class="page-title">

    Bem-vindo,
    {{ auth()->user()->name }}

</h1>

<div class="cards">

    <div class="card">

        <i class="bi bi-box-seam"></i>

        <h2>0</h2>

        <span>Produtos</span>

    </div>

    <div class="card">

        <i class="bi bi-tags-fill"></i>

        <h2>0</h2>

        <span>Categorias</span>

    </div>

    <div class="card">

        <i class="bi bi-cart-fill"></i>

        <h2>0</h2>

        <span>Pedidos</span>

    </div>

    <div class="card">

        <i class="bi bi-people-fill"></i>

        <h2>0</h2>

        <span>Clientes</span>

    </div>

</div>

<div class="panel">

    <h3>Resumo</h3>

    <p>

        Bem-vindo ao painel administrativo da Vândala.

        Utilize o menu lateral para gerenciar os produtos,
        categorias, pedidos e clientes.

    </p>

</div>

@endsection