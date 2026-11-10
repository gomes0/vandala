@extends('layouts.app')

@section('title', 'Minha conta | VÂNDALA')

@section('content')

    <section class="perfil-page">

        <div class="perfil-container">

            {{-- CABEÇALHO --}}
            <div class="perfil-header">
                <span class="perfil-eyebrow">ÁREA DO CLIENTE</span>

                <h1>MINHA <span>CONTA</span></h1>

                <p>
                    Gerencie suas informações pessoais e a segurança da sua conta.
                </p>
            </div>

            {{-- MENSAGENS --}}
            @if (session('status') === 'profile-updated')
                <div class="perfil-alerta sucesso">
                    <i class="bi bi-check-circle"></i>
                    Informações atualizadas com sucesso.
                </div>
            @endif

            @if (session('status') === 'password-updated')
                <div class="perfil-alerta sucesso">
                    <i class="bi bi-check-circle"></i>
                    Senha alterada com sucesso.
                </div>
            @endif

            @if (session('status') === 'verification-link-sent')
                <div class="perfil-alerta sucesso">
                    <i class="bi bi-check-circle"></i>
                    Um novo link de verificação foi enviado para seu e-mail.
                </div>
            @endif

            <div class="perfil-layout">

                {{-- MENU LATERAL --}}
                <aside class="perfil-sidebar">

                    <div class="perfil-usuario">

                        <div class="perfil-avatar">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>

                        <div class="perfil-usuario-info">
                            <strong>{{ $user->name }}</strong>
                            <span>{{ $user->email }}</span>
                        </div>

                    </div>

                    <nav class="perfil-menu">

                        <a href="#informacoes" class="ativo">
                            <i class="bi bi-person"></i>
                            Meus dados
                        </a>
                        <a href="{{ route('favoritos.index') }}">
                            <i class="bi bi-heart"></i>
                            Meus favoritos
                        </a>

                        <a href="#senha">
                            <i class="bi bi-lock"></i>
                            Alterar senha
                        </a>

                        <a href="#excluir-conta">
                            <i class="bi bi-trash3"></i>
                            Excluir conta
                        </a>

                        <a href="{{ route('loja.index') }}">
                            <i class="bi bi-bag"></i>
                            Continuar comprando
                        </a>

                    </nav>

                    <div class="perfil-sidebar-footer">

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <button type="submit">
                                <i class="bi bi-box-arrow-right"></i>
                                Sair da conta
                            </button>
                        </form>

                    </div>

                </aside>

                {{-- CONTEÚDO PRINCIPAL --}}
                <div class="perfil-conteudo">

                    {{-- INFORMAÇÕES PESSOAIS --}}
                    <article class="perfil-card" id="informacoes">

                        <div class="perfil-card-header">

                            <div>
                                <span class="perfil-card-etiqueta">
                                    01 / INFORMAÇÕES
                                </span>

                                <h2>Dados pessoais</h2>

                                <p>
                                    Atualize seu nome e endereço de e-mail.
                                </p>
                            </div>

                            <i class="bi bi-person-circle"></i>

                        </div>

                        {{-- FORMULÁRIO DE VERIFICAÇÃO --}}
                        <form id="send-verification" method="POST" action="{{ route('verification.send') }}">
                            @csrf
                        </form>

                        {{-- FORMULÁRIO DE ATUALIZAÇÃO --}}
                        <form method="POST" action="{{ route('profile.update') }}" class="perfil-form">

                            @csrf
                            @method('PATCH')

                            <div class="perfil-campo">

                                <label for="name">Nome completo</label>

                                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                                    placeholder="Digite seu nome" required autofocus autocomplete="name">

                                @error('name')
                                    <span class="perfil-erro">
                                        {{ $message }}
                                    </span>
                                @enderror

                            </div>

                            <div class="perfil-campo">

                                <label for="email">E-mail</label>

                                <input type="email" id="email" name="email"
                                    value="{{ old('email', $user->email) }}" placeholder="Digite seu e-mail" required
                                    autocomplete="username">

                                @error('email')
                                    <span class="perfil-erro">
                                        {{ $message }}
                                    </span>
                                @enderror

                            </div>

                            {{-- VERIFICAÇÃO DE E-MAIL --}}
                            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                                <div class="perfil-verificacao">

                                    <p>
                                        <i class="bi bi-exclamation-circle"></i>
                                        Seu endereço de e-mail ainda não foi verificado.
                                    </p>

                                    <button type="submit" form="send-verification">
                                        Reenviar e-mail de verificação
                                    </button>

                                </div>
                            @endif

                            <div class="perfil-form-footer">

                                <button type="submit" class="perfil-btn">
                                    SALVAR ALTERAÇÕES
                                    <i class="bi bi-arrow-right"></i>
                                </button>

                            </div>

                        </form>

                    </article>

                    {{-- ALTERAR SENHA --}}
                    <article class="perfil-card" id="senha">

                        <div class="perfil-card-header">

                            <div>
                                <span class="perfil-card-etiqueta">
                                    02 / SEGURANÇA
                                </span>

                                <h2>Alterar senha</h2>

                                <p>
                                    Escolha uma senha segura para proteger sua conta.
                                </p>
                            </div>

                            <i class="bi bi-shield-lock"></i>

                        </div>

                        <form method="POST" action="{{ route('password.update') }}" class="perfil-form">

                            @csrf
                            @method('PUT')

                            <div class="perfil-campo">

                                <label for="current_password">
                                    Senha atual
                                </label>

                                <input type="password" id="current_password" name="current_password"
                                    placeholder="Digite sua senha atual" autocomplete="current-password">

                                @if ($errors->updatePassword->has('current_password'))
                                    <span class="perfil-erro">
                                        {{ $errors->updatePassword->first('current_password') }}
                                    </span>
                                @endif

                            </div>

                            <div class="perfil-campo">

                                <label for="password">
                                    Nova senha
                                </label>

                                <input type="password" id="password" name="password" placeholder="Digite a nova senha"
                                    autocomplete="new-password">

                                @if ($errors->updatePassword->has('password'))
                                    <span class="perfil-erro">
                                        {{ $errors->updatePassword->first('password') }}
                                    </span>
                                @endif

                            </div>

                            <div class="perfil-campo">

                                <label for="password_confirmation">
                                    Confirmar nova senha
                                </label>

                                <input type="password" id="password_confirmation" name="password_confirmation"
                                    placeholder="Digite novamente a nova senha" autocomplete="new-password">

                                @if ($errors->updatePassword->has('password_confirmation'))
                                    <span class="perfil-erro">
                                        {{ $errors->updatePassword->first('password_confirmation') }}
                                    </span>
                                @endif

                            </div>

                            <div class="perfil-form-footer">

                                <button type="submit" class="perfil-btn">
                                    ATUALIZAR SENHA
                                    <i class="bi bi-arrow-right"></i>
                                </button>

                            </div>

                        </form>

                    </article>

                    {{-- EXCLUIR CONTA --}}
                    <article class="perfil-card perfil-card-perigo" id="excluir-conta">

                        <div class="perfil-card-header">

                            <div>
                                <span class="perfil-card-etiqueta">
                                    03 / ZONA DE PERIGO
                                </span>

                                <h2>Excluir conta</h2>

                                <p>
                                    Essa ação é permanente e não poderá ser desfeita.
                                </p>
                            </div>

                            <i class="bi bi-trash3"></i>

                        </div>

                        <div class="perfil-exclusao">

                            <p>
                                Ao excluir sua conta, seus dados e informações
                                associados poderão ser removidos permanentemente.
                            </p>

                            <form method="POST" action="{{ route('profile.destroy') }}" class="perfil-form"
                                onsubmit="return confirm('Tem certeza de que deseja excluir sua conta? Essa ação não poderá ser desfeita.');">

                                @csrf
                                @method('DELETE')

                                <div class="perfil-campo">

                                    <label for="delete_password">
                                        Confirme sua senha
                                    </label>

                                    <input type="password" id="delete_password" name="password"
                                        placeholder="Digite sua senha para confirmar" autocomplete="current-password"
                                        required>

                                    @if ($errors->userDeletion->has('password'))
                                        <span class="perfil-erro">
                                            {{ $errors->userDeletion->first('password') }}
                                        </span>
                                    @endif

                                </div>

                                <div class="perfil-form-footer">

                                    <button type="submit" class="perfil-btn perfil-btn-perigo">
                                        EXCLUIR MINHA CONTA
                                        <i class="bi bi-trash3"></i>
                                    </button>

                                </div>

                            </form>

                        </div>

                    </article>

                </div>

            </div>

        </div>

    </section>

@endsection
