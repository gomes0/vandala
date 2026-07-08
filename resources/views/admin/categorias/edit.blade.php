@extends('admin.layouts.admin')

@section('title', 'Editar Categoria')

@section('content')

    <h1>Editar Categoria</h1>

    <form action="{{ route('categorias.update', $categoria) }}" method="POST">

        @csrf

        @method('PUT')

        @include('admin.categorias.form')

    </form>

@endsection
