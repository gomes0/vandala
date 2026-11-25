<aside class="sidebar">

    <div class="logo">
        <h1>VÂNDALA</h1>
        <span>ADMIN</span>
    </div>

    <nav>

        <a href="{{ route('admin.dashboard') }}"
           class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="bi bi-grid-fill"></i>
            Dashboard
        </a>

        <a href="{{ route('admin.produtos.index') }}"
           class="{{ request()->routeIs('admin.produtos.*') ? 'active' : '' }}">
            <i class="bi bi-box-seam"></i>
            Produtos
        </a>

        <a href="{{ route('admin.categorias.index') }}"
           class="{{ request()->routeIs('admin.categorias.*') ? 'active' : '' }}">
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

        <a href="{{ route('admin.pedidos.index') }}"
           class="{{ request()->routeIs('admin.pedidos.*') ? 'active' : '' }}">
            <i class="bi bi-cart-fill"></i>
            Pedidos
        </a>

        <a href="{{ route('admin.clientes.index') }}"
   	 class="{{ request()->routeIs('admin.clientes.*') ? 'active' : '' }}">
    	<i class="bi bi-people-fill"></i>
    	Clientes
	</a>

        <a href="{{ route('home') }}">
            <i class="bi bi-shop"></i>
            Voltar à loja
        </a>

    </nav>

    <div class="logout">
        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit">
                <i class="bi bi-box-arrow-right"></i>
                Sair
            </button>
        </form>
    </div>

</aside>
