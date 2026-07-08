@extends('layouts.auth')

@section('title', 'Criar Conta | Vândala')

@section('content')

<div class="auth-container">

    <!-- Lado esquerdo -->
    <div class="auth-banner">

        <div class="overlay">

            <h1>VÂNDALA</h1>

            <p>Faça parte da nossa comunidade.</p>

        </div>

    </div>

    <!-- Lado direito -->
    <div class="auth-form">

        <div class="auth-card register-card">

            <div class="auth-logo">

                <h2>Criar Conta</h2>

                <p>Cadastre-se para começar.</p>

            </div>

            <form method="POST" action="{{ route('register') }}">

                @csrf

                <!-- Nome -->
                <div class="form-group">

                    <label for="name">Nome</label>

                    <input
                        id="name"
                        type="text"
                        name="name"
                        class="form-control"
                        value="{{ old('name') }}"
                        required
                        autofocus
                    >

                    @error('name')
                        <small class="error">{{ $message }}</small>
                    @enderror

                </div>

                <!-- Email -->
                <div class="form-group">

                    <label for="email">Email</label>

                    <input
                        id="email"
                        type="email"
                        name="email"
                        class="form-control"
                        value="{{ old('email') }}"
                        required
                    >

                    @error('email')
                        <small class="error">{{ $message }}</small>
                    @enderror

                </div>

                <!-- Senha -->
                <div class="form-group">

                    <label for="password">Senha</label>

                    <input
                        id="password"
                        type="password"
                        name="password"
                        class="form-control"
                        required
                    >

                    @error('password')
                        <small class="error">{{ $message }}</small>
                    @enderror

                </div>

                <!-- Confirmar Senha -->
                <div class="form-group">

                    <label for="password_confirmation">Confirmar Senha</label>

                    <input
                        id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        class="form-control"
                        required
                    >

                </div>

                <button type="submit" class="btn-auth">

                    Criar Conta

                </button>

            </form>

            <div class="divider"></div>

            <div class="auth-links">

                <span>Já possui uma conta?</span>

                <br><br>

                <a href="{{ route('login') }}">

                    Fazer Login

                </a>

            </div>

        </div>

    </div>

</div>

@endsection