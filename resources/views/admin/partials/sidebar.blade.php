<aside class="sidebar">

    <div class="logo">

        <h1>VÂNDALA</h1>

        <span>ADMIN</span>

    </div>

    <nav>

        <a href="{{ route('admin.dashboard') }}" class="active">

            <i class="bi bi-grid-fill"></i>

            Dashboard

        </a>

        <a href="{{ route('produtos.index') }}">

            <i class="bi bi-box-seam"></i>

            Produtos

        </a>

        <a href="{{ route('categorias.index') }}">

            <i class="bi bi-tags-fill"></i>

            Categorias

        </a>

        <a href="#">

            <i class="bi bi-palette-fill"></i>

            Cores

        </a>

        <a href="#">

            <i class="bi bi-rulers"></i>

            Tamanhos

        </a>

        <a href="#">

            <i class="bi bi-cart-fill"></i>

            Pedidos

        </a>

        <a href="#">

            <i class="bi bi-people-fill"></i>

            Clientes

        </a>

    </nav>

    <div class="logout">

        <form method="POST" action="{{ route('logout') }}">

            @csrf

            <button>

                <i class="bi bi-box-arrow-right"></i>

                Sair

            </button>

        </form>

    </div>

</aside>
