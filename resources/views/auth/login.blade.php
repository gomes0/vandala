@extends('layouts.auth')

@section('title', 'Login | Vândala')

@section('content')

<div class="auth-container">

    {{-- Área da marca --}}
    <section class="auth-banner">
        <div class="auth-brand">
            <span class="auth-brand-line"></span>

            <h1>VÂNDALA</h1>

            <p>Vista atitude.</p>

            <span class="auth-brand-description">
                SUA IDENTIDADE. SEU ESTILO. SUA ATITUDE.
            </span>
        </div>
    </section>

    {{-- Área do formulário --}}
    <section class="auth-form">

        <div class="auth-card login-card">

            <div class="auth-logo">
                <span class="auth-eyebrow">ÁREA DO CLIENTE</span>
                <h2>Entrar<span>.</span></h2>
                <p>Bem-vindo de volta.</p>
            </div>

            @if (session('status'))
                <div class="success">
                    <i class="fa-solid fa-circle-check"></i>
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any() && !$errors->has('email') && !$errors->has('password'))
                <div class="error">
                    Não foi possível realizar o login. Verifique seus dados.
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label for="email">E-mail</label>

                    <div class="auth-input-wrapper">
                        <i class="fa-regular fa-envelope"></i>

                        <input
                            id="email"
                            type="email"
                            name="email"
                            class="form-control"
                            value="{{ old('email') }}"
                            placeholder="Digite seu e-mail"
                            autocomplete="username"
                            required
                            autofocus
                        >
                    </div>

                    @error('email')
                        <small class="error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Senha</label>

                    <div class="auth-input-wrapper">
                        <i class="fa-solid fa-lock"></i>

                        <input
                            id="password"
                            type="password"
                            name="password"
                            class="form-control"
                            placeholder="Digite sua senha"
                            autocomplete="current-password"
                            required
                        >
                    </div>

                    @error('password')
                        <small class="error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="auth-options">
                    <label class="checkbox" for="remember">
                        <input
                            id="remember"
                            type="checkbox"
                            name="remember"
                            value="1"
                            {{ old('remember') ? 'checked' : '' }}
                        >

                        <span>Lembrar-me</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">
                            Esqueceu a senha?
                        </a>
                    @endif
                </div>

                <button type="submit" class="btn-auth">
                    <span>ENTRAR</span>
                    <i class="fa-solid fa-arrow-right"></i>
                </button>

            </form>

            <div class="auth-divider">
                <span></span>
                <small>NOVO POR AQUI?</small>
                <span></span>
            </div>

            <div class="auth-links">
                <p>
                    Não possui uma conta?
                    <a href="{{ route('register') }}">Criar conta</a>
                </p>
            </div>

            <div class="auth-card-footer">
                <i class="fa-solid fa-shield-halved"></i>
                <span>Seus dados estão protegidos.</span>
            </div>

        </div>

    </section>

</div>

@endsection