<header>
    <div class="container">
        <div class="d-flex justify-content-center">
            <div class="">
                <a class="navbar-brand text-secondary" href="{{ route('index.home') }}"><strong>Ecommerce</strong></a>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-md navbar-light border-bottom shadow-s">
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".navbar-collapse"
                aria-label="Abrir menu de navegação">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse collapse justify-content-start">

            </div>
            <div class="navbar-collapse collapse justify-content-center">
                <ul class="navbar-nav">
                    <li class="nav-item sale-nav">
                        <a id="sale-text" href="{{ route('index.home') }}" class="nav-link">%OFF</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('info.privacidade') }}" class="nav-link">Roupas</a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link">Calçados</a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link">Acessórios</a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link">Outlet</a>
                    </li>
                </ul>
            </div>
            <div class="">
                <!-- Botão para acionar modal -->
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
                                <form action="">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="O que você procura?">
                                        <div class="input-group-append">
                                            <button type="submit" class="input-group-text btn"><i
                                                    class="fa-solid fa-magnifying-glass"></i></button>
                                        </div>
                                    </div>
                                </form>
                                <div class="p-4 row">
                                    <ul>
                                        <li>1</li>
                                        <li>2</li>
                                        <li>3</li>
                                        <li>4</li>
                                        <li>5</li>
                                        <li>6</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <a class="navbar-brand text-secondary" href="{{ route('index.home') }}"><i
                        class="fa-solid fa-user"></i></a>
                <a class="navbar-brand text-secondary" href="{{ route('index.home') }}"><i
                        class="fa-solid fa-heart"></i></a>
                <a class="navbar-brand text-secondary" href="{{ route('index.home') }}"><i
                        class="fa-solid fa-cart-shopping"></i></a>
            </div>
        </div>
    </nav>
</header>
