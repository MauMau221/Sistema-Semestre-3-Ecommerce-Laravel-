<header>
    <div class="container">
        <div class="d-flex justify-content-center">
            <div class="">
                <a class="navbar-brand text-secondary" href="{{ route('index.home') }}"><strong>Ecommerce
                        Online</strong></a>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-md navbar-light border-bottom shadow-s">
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".navbar-collapse"
                aria-label="Abrir menu de navegação">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse collapse justify-content-center">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="{{ route('index.home') }}" class="nav-link">Principal</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('info.privacidade') }}" class="nav-link">Politica de
                            privacidade</a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link">Quero me cadastrar</a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link">Entrar</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fa-solid fa-cart-shopping"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
