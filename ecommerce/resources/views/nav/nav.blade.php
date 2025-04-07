    <div class="container">
        <div class="d-flex justify-content-center">
            <div class="">
                <a class="navbar-brand text-secondary" href="{{ route('home.home') }}"><strong>Ecommerce</strong></a>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-md navbar-light border-bottom shadow-s">
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".navbar-collapse"
                aria-label="Abrir menu de navegação">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse collapse">
            </div>
            <div class="navbar-collapse collapse ml-4">
                <ul class="navbar-nav justify-content-center ml-4">
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
            <div class="navbar-collapse collapse justify-content-center">
                <!-- Botão acionar modal -->
                <button type="button" class=" navbar-brand text-secondary border-0 bg-transparent" data-toggle="modal"
                    data-target="#modalExemplo">
                    <i class="fa-solid fa-magnifying-glass"></i> </button>

                <!-- Modal -->
                <div class="modal fade" id="modalExemplo" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header justify-content-center border-0">
                                <h5 class="modal-title" id="exampleModalLabel">LOGO
                                </h5>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('product.search') }}" method="post">
                                    @csrf
                                    <div class="input-group">
                                        <input type="text" class="form-control text-center" name="search"
                                            placeholder="O que você procura?">
                                        <div class="input-group-append">
                                            <button type="submit" class="input-group-text btn"><i
                                                    class="fa-solid fa-magnifying-glass"></i></button>
                                        </div>
                                    </div>
                                </form>
                                <div class="container p-4">
                                    <div class="row align-items-center text-center ">
                                        <div class="col-6 my-2">
                                            <a href="{{ route('category.categorias', ['nome' => 'calcas']) }}"
                                                class="text-secondary">Calças</a>
                                        </div>
                                        <div class="col-6 my-2">
                                            <a href="{{ route('category.categorias', ['nome' => 'camisas']) }}"
                                                class="text-secondary">Camisas</a>
                                        </div>
                                        <div class="col-6 my-2">
                                            <a href="{{ route('category.categorias', ['nome' => 'blusas']) }}"
                                                class="text-secondary">Blusas</a>
                                        </div>
                                        <div class="col-6 my-2">
                                            <a href="{{ route('category.categorias', ['nome' => 'acessorios']) }}"
                                                class="text-secondary">Acessorios</a>
                                        </div>
                                        <div class="col-6 my-2">
                                            <a href="{{ route('category.categorias', ['nome' => 'camisetas']) }}"
                                                class="text-secondary">Alfaiataria</a>
                                        </div>
                                        <div class="col-6 my-2">
                                            <a href="{{ route('category.categorias', ['nome' => 'polos']) }}"
                                                class="text-secondary">Promoção</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @auth
                    <div class="dropdown p-1 mr-1">
                        <button class="btn btn-secundary dropdown-toggle" type="button" id="dropdownMenuButton"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Olá {{ Auth::user()->name }}
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <li><a class="dropdown-item text-secondary" href="#">Meus dados</a></li>
                            <li><a class="dropdown-item text-secondary" href="{{ route('logout') }}">Sair</a></li>
                        </ul>
                    </div>
                    <a class="navbar-brand text-secondary p-1" href="{{ route('home.home') }}"><i
                            class="fa-solid fa-heart"></i></a>
                    <a class="navbar-brand text-secondary" href="{{ route('cart.cart') }}"> <i
                            class="fa-solid fa-bag-shopping"></i>
                    </a>
                @endauth

                @guest
                    <a class="navbar-brand text-secondary" href="{{ route('home.login') }}"><i
                            class="fa-solid fa-user"></i></a>
                    <a class="navbar-brand text-secondary" href="{{ route('home.home') }}"><i
                            class="fa-solid fa-heart"></i></a>
                    <a class="navbar-brand text-secondary" href="{{ route('cart.cart') }}"> <i
                            class="fa-solid fa-bag-shopping "></i>
                    </a>
                @endguest
            </div>
        </div>
    </nav>
