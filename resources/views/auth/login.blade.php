@extends('layouts.auth')

@section('title', 'Login | Vândala')

@section('content')

<div class="auth-container">

    <!-- Lado esquerdo -->
    <div class="auth-banner">

        <div class="overlay">

            <h1>VÂNDALA</h1>

            <p>Vista atitude.</p>

        </div>

    </div>

    <!-- Lado direito -->
    <div class="auth-form">

        <div class="auth-card login-card">

            <div class="auth-logo">

                <h2>Entrar</h2>

                <p>Bem-vindo de volta.</p>

            </div>

            @if(session('status'))

                <div class="success">

                    {{ session('status') }}

                </div>

            @endif

            <form method="POST" action="{{ route('login') }}">

                @csrf

                <div class="form-group">

                    <label>Email</label>

                    <input
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

                <div class="form-group">

                    <label>Senha</label>

                    <input
                        type="password"
                        name="password"
                        class="form-control"
                        required
                    >

                    @error('password')

                        <small class="error">{{ $message }}</small>

                    @enderror

                </div>

                <div class="checkbox">

                    <input
                        type="checkbox"
                        name="remember"
                    >

                    <label>Lembrar-me</label>

                </div>

                <button class="btn-auth">

                    Entrar

                </button>

            </form>

            <div class="auth-links">

                @if (Route::has('password.request'))

                    <a href="{{ route('password.request') }}">

                        Esqueceu sua senha?

                    </a>

                @endif

                <br><br>

                <span>

                    Não possui conta?

                </span>

                <a href="{{ route('register') }}">

                    Criar conta

                </a>

            </div>

        </div>

    </div>

</div>

@endsection