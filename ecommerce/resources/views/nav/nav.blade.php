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
            <div class="navbar-collapse collapse justify-content-center">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="{{ route('index.home') }}" class="nav-link">%OFF</a>
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
                <a class="navbar-brand text-secondary" href="{{ route('index.home') }}"><i
                        class="fa-solid fa-magnifying-glass"></i></a>
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
