    <div class="container">
        <div class="d-flex justify-content-center">
            <div class="">
                <a class="navbar-brand text-secondary" href="{{ route('home.home') }}"><strong>Ecommerce</strong></a>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-md navbar-light border-bottom shadow-sm bg-white">
        <div class="container py-2">
            <div class="d-flex align-items-center w-100">
                <!-- Logo -->
                <a class="navbar-brand text-secondary me-3" href="{{ route('home.home') }}">
                    <strong>Ecommerce</strong>
                </a>

                <!-- Search Bar -->
                <div class="flex-grow-1 mx-2">
                    <form action="{{ route('product.search') }}" method="post" class="w-100">
                        @csrf
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="O que você procura?" style="border-radius: 4px 0 0 4px;">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-outline-secondary" style="border-radius: 0 4px 4px 0; border-left: none;">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Icons -->
                <div class="d-flex align-items-center">
                    @auth
                        <div class="dropdown">
                            <button class="btn text-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-user me-1"></i>
                                {{ Auth::user()->name }}
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <li><a class="dropdown-item text-secondary" href="#">Meus dados</a></li>
                                <li><a class="dropdown-item text-secondary" href="{{ route('logout') }}">Sair</a></li>
                            </ul>
                        </div>
                    @endauth

                    @guest
                        <a class="text-secondary mx-3" href="{{ route('home.login') }}">
                            <i class="fa-solid fa-user"></i>
                        </a>
                    @endguest

                    <a class="text-secondary mx-3" href="{{ route('home.home') }}">
                        <i class="fa-solid fa-heart"></i>
                    </a>
                    <a class="text-secondary mx-3" href="{{ route('cart.cart') }}">
                        <i class="fa-solid fa-bag-shopping"></i>
                    </a>
                </div>
            </div>
        </div>
    </nav>
    
    <!-- Submenu de categorias -->
    <nav class="navbar navbar-expand-md navbar-light bg-white border-bottom">
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".navbar-collapse"
                aria-label="Abrir menu de navegação">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav justify-content-center">
                    <li class="nav-item sale-nav">
                        <a id="sale-text" href="{{ route('home.home', ['nome' => 'camisas']) }}"
                            class="nav-link">%OFF</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('category.categorias', ['nome' => 'camisas']) }}" class="nav-link">Roupas</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('category.categorias', ['nome' => 'calcados']) }}"
                            class="nav-link">Calçados</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('category.categorias', ['nome' => 'acessorios']) }}"
                            class="nav-link">Acessórios</a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link">Outlet</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
