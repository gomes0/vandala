<header>

    <div class="logo">
        <a href="/">VÂNDALA</a>
    </div>

    <nav>

        <ul>

            <li><a href="/">Home</a></li>

            <li><a href="/loja">Loja</a></li>

            <li><a href="/colecoes">Coleções</a></li>

            <li><a href="/sobre">Sobre</a></li>

            <li><a href="/contato">Contato</a></li>

        </ul>

    </nav>

    <div class="icons">

        <a href="#">
            <i class="bi bi-search"></i>
        </a>

        <a href="#">
            <i class="bi bi-cart-fill"></i>
        </a>

        @auth

            @if (auth()->user()->tipo == 'admin')
                <a href="{{ route('admin.dashboard') }}">
                    <i class="bi bi-person-fill"></i>
                </a>
            @else
                <a href="{{ route('profile.edit') }}">
                    <i class="bi bi-person-fill"></i>
                </a>
            @endif
        @else
            <a href="{{ route('login') }}">
                <i class="bi bi-person-fill"></i>
            </a>

        @endauth

    </div>

</header>
