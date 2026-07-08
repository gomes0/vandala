@extends('admin.layouts.admin')

@section('title', 'Cadastrar Produto')

@section('content')

<div class="page-header">

    <h1>Novo Produto</h1>

</div>

<form
    action="{{ route('produtos.store') }}"
    method="POST"
>

    @csrf

    @include('admin.produtos.form')

</form>

@endsection