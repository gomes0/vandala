@extends('admin.layouts.admin')

@section('title', 'Editar Produto')

@section('content')

<div class="page-header">

    <h1>Editar Produto</h1>

</div>

<form
    action="{{ route('produtos.update', $produto) }}"
    method="POST"
>

    @csrf

    @method('PUT')

    @include('admin.produtos.form')

</form>

@endsection