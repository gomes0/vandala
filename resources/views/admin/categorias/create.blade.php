@extends('admin.layouts.admin')

@section('title', 'Nova Categoria')

@section('content')

    <h1>Nova Categoria</h1>

    <form action="{{ route('categorias.store') }}" method="POST">

        @csrf

        @include('admin.categorias.form')

    </form>

@endsection
