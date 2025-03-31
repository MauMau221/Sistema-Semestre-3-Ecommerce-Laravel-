@extends('master')

@section('content')
    @if (empty($itens))
        <div class="alert alert-danger mt-0">
            <p>Itens não encontrados para a categoria selecionada</p>
        </div>
    @endif
    <!-- Breadcrumb -->
    <div class="container mt-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#" class="text-decoration-none text-secondary">Home</a></li>
                <li class="breadcrumb-item"><a href="#" class="text-decoration-none text-secondary">Roupas</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ ucfirst($categoria) }}</li> <!-- ucfisrt deixa a primeira letra maiuscula -->
            </ol>
        </nav>
    </div>

    <!-- Conteúdo Principal -->
    <div class="container">
        <div class="row">
            <!-- Filtros - Coluna Lateral -->
            <div class="col-lg-3 d-none d-lg-block">
                <h4 class="mb-4">FILTROS</h4>

                <!-- Filtro de Categorias -->
                <div class="filter-card">
                    <div class="filter-header">CATEGORIAS</div>
                    <div class="filter-option">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="cat1">
                            <label class="form-check-label" for="cat1">Camisetas (45)</label>
                        </div>
                    </div>
                    <div class="filter-option">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="cat2">
                            <label class="form-check-label" for="cat2">Polos (32)</label>
                        </div>
                    </div>
                    <div class="filter-option">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="cat3">
                            <label class="form-check-label" for="cat3">Camisas (28)</label>
                        </div>
                    </div>
                    <div class="filter-option">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="cat4">
                            <label class="form-check-label" for="cat4">Regatas (12)</label>
                        </div>
                    </div>
                </div>

                <!-- Filtro de Preço -->
                <div class="filter-card">
                    <div class="filter-header">PREÇO</div>
                    <div class="filter-option">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="price1">
                            <label class="form-check-label" for="price1">Até R$ 150</label>
                        </div>
                    </div>
                    <div class="filter-option">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="price2">
                            <label class="form-check-label" for="price2">R$ 151 - R$ 250</label>
                        </div>
                    </div>
                    <div class="filter-option">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="price3">
                            <label class="form-check-label" for="price3">R$ 251 - R$ 350</label>
                        </div>
                    </div>
                    <div class="filter-option">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="price4">
                            <label class="form-check-label" for="price4">Acima de R$ 350</label>
                        </div>
                    </div>
                </div>

                <!-- Filtro de Cor -->
                <div class="filter-card">
                    <div class="filter-header">COR</div>
                    <div class="filter-option">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="color1">
                            <label class="form-check-label" for="color1">Azul (18)</label>
                        </div>
                    </div>
                    <div class="filter-option">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="color2">
                            <label class="form-check-label" for="color2">Preto (24)</label>
                        </div>
                    </div>
                    <div class="filter-option">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="color3">
                            <label class="form-check-label" for="color3">Branco (16)</label>
                        </div>
                    </div>
                    <div class="filter-option">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="color4">
                            <label class="form-check-label" for="color4">Cinza (12)</label>
                        </div>
                    </div>
                </div>

                <!-- Filtro de Tamanho -->
                <div class="filter-card">
                    <div class="filter-header">TAMANHO</div>
                    <div class="d-flex flex-wrap">
                        <div class="me-2 mb-2">
                            <input type="checkbox" class="btn-check" id="size-p" autocomplete="off">
                            <label class="btn btn-outline-secondary btn-sm" for="size-p">P</label>
                        </div>
                        <div class="me-2 mb-2">
                            <input type="checkbox" class="btn-check" id="size-m" autocomplete="off">
                            <label class="btn btn-outline-secondary btn-sm" for="size-m">M</label>
                        </div>
                        <div class="me-2 mb-2">
                            <input type="checkbox" class="btn-check" id="size-g" autocomplete="off">
                            <label class="btn btn-outline-secondary btn-sm" for="size-g">G</label>
                        </div>
                        <div class="me-2 mb-2">
                            <input type="checkbox" class="btn-check" id="size-gg" autocomplete="off">
                            <label class="btn btn-outline-secondary btn-sm" for="size-gg">GG</label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Produtos -->
            <div class="col-lg-9">
                <!-- Cabeçalho de resultados -->
                <div class="results-header d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="mb-0">{{ ucfirst($categoria) }}</h4>
                        <p class="text-muted mb-0">117 produtos encontrados</p>
                    </div>
                    <div class="d-flex align-items-center">
                        <label for="sort" class="me-2">Ordenar por:</label>
                        <select id="sort" class="sort-select">
                            <option>Relevância</option>
                            <option>Menor preço</option>
                            <option>Maior preço</option>
                            <option>Mais vendidos</option>
                            <option>Lançamentos</option>
                        </select>
                    </div>
                </div>

                <!-- Grade de Produtos (4 por linha em desktop) -->
                <div class="row">
                    <!-- Produto 1 -->
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="card product-card border-0">
                            <div class="position-relative">
                                <a href="#" class="text-decoration-none">
                                    <img src="/api/placeholder/300/400" alt="Camiseta 1" class="card-img-top">
                                </a>
                                <button class="wishlist-btn">
                                    <i class="bi bi-heart"></i>
                                </button>
                            </div>
                            <div class="card-body p-2">
                                <h5 class="product-title">CAMISETA MANGA CURTA BÁSICA</h5>
                                <div class="product-price">R$ 229,90</div>
                                <div class="product-installments">ou 6x de R$ 38,32</div>
                                <div class="product-colors">
                                    <div class="color-option" style="background-color: navy;"></div>
                                    <div class="color-option" style="background-color: black;"></div>
                                    <div class="color-option" style="background-color: white;"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Produto 2 -->
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="card product-card border-0">
                            <div class="position-relative">
                                <a href="#" class="text-decoration-none">
                                    <img src="/api/placeholder/300/400" alt="Camiseta 2" class="card-img-top">
                                </a>
                                <button class="wishlist-btn">
                                    <i class="bi bi-heart"></i>
                                </button>
                                <div class="badge-discount">-20%</div>
                            </div>
                            <div class="card-body p-2">
                                <h5 class="product-title">CAMISETA ESTAMPADA</h5>
                                <div class="product-price">R$ 199,90</div>
                                <div class="product-installments">ou 6x de R$ 33,32</div>
                                <div class="product-colors">
                                    <div class="color-option" style="background-color: gray;"></div>
                                    <div class="color-option" style="background-color: black;"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Produto 3 -->
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="card product-card border-0">
                            <div class="position-relative">
                                <a href="#" class="text-decoration-none">
                                    <img src="/api/placeholder/300/400" alt="Camiseta 3" class="card-img-top">
                                </a>
                                <button class="wishlist-btn">
                                    <i class="bi bi-heart"></i>
                                </button>
                            </div>
                            <div class="card-body p-2">
                                <h5 class="product-title">CAMISETA GOLA V SLIM</h5>
                                <div class="product-price">R$ 249,90</div>
                                <div class="product-installments">ou 6x de R$ 41,65</div>
                                <div class="product-colors">
                                    <div class="color-option" style="background-color: white;"></div>
                                    <div class="color-option" style="background-color: blue;"></div>
                                    <div class="color-option" style="background-color: black;"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Produto 4 -->
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="card product-card border-0">
                            <div class="position-relative">
                                <a href="#" class="text-decoration-none">
                                    <img src="/api/placeholder/300/400" alt="Camiseta 4" class="card-img-top">
                                </a>
                                <button class="wishlist-btn">
                                    <i class="bi bi-heart"></i>
                                </button>
                            </div>
                            <div class="card-body p-2">
                                <h5 class="product-title">CAMISETA MANGA LONGA</h5>
                                <div class="product-price">R$ 279,90</div>
                                <div class="product-installments">ou 6x de R$ 46,65</div>
                                <div class="product-colors">
                                    <div class="color-option" style="background-color: navy;"></div>
                                    <div class="color-option" style="background-color: maroon;"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Produto 5 -->
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="card product-card border-0">
                            <div class="position-relative">
                                <a href="#" class="text-decoration-none">
                                    <img src="/api/placeholder/300/400" alt="Camiseta 5" class="card-img-top">
                                </a>
                                <button class="wishlist-btn">
                                    <i class="bi bi-heart"></i>
                                </button>
                            </div>
                            <div class="card-body p-2">
                                <h5 class="product-title">CAMISETA LISTRADA</h5>
                                <div class="product-price">R$ 239,90</div>
                                <div class="product-installments">ou 6x de R$ 39,98</div>
                                <div class="product-colors">
                                    <div class="color-option" style="background-color: lightblue;"></div>
                                    <div class="color-option" style="background-color: gray;"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Produto 6 -->
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="card product-card border-0">
                            <div class="position-relative">
                                <a href="#" class="text-decoration-none">
                                    <img src="/api/placeholder/300/400" alt="Camiseta 6" class="card-img-top">
                                </a>
                                <button class="wishlist-btn">
                                    <i class="bi bi-heart"></i>
                                </button>
                                <div class="badge-discount">-15%</div>
                            </div>
                            <div class="card-body p-2">
                                <h5 class="product-title">CAMISETA ESTAMPA FLORAL</h5>
                                <div class="product-price">R$ 219,90</div>
                                <div class="product-installments">ou 6x de R$ 36,65</div>
                                <div class="product-colors">
                                    <div class="color-option" style="background-color: black;"></div>
                                    <div class="color-option" style="background-color: white;"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Produto 7 -->
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="card product-card border-0">
                            <div class="position-relative">
                                <a href="#" class="text-decoration-none">
                                    <img src="/api/placeholder/300/400" alt="Camiseta 7" class="card-img-top">
                                </a>
                                <button class="wishlist-btn">
                                    <i class="bi bi-heart"></i>
                                </button>
                            </div>
                            <div class="card-body p-2">
                                <h5 class="product-title">CAMISETA BÁSICA GOLA REDONDA</h5>
                                <div class="product-price">R$ 199,90</div>
                                <div class="product-installments">ou 6x de R$ 33,32</div>
                                <div class="product-colors">
                                    <div class="color-option" style="background-color: black;"></div>
                                    <div class="color-option" style="background-color: gray;"></div>
                                    <div class="color-option" style="background-color: navy;"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Produto 8 -->
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="card product-card border-0">
                            <div class="position-relative">
                                <a href="#" class="text-decoration-none">
                                    <img src="/api/placeholder/300/400" alt="Camiseta 8" class="card-img-top">
                                </a>
                                <button class="wishlist-btn">
                                    <i class="bi bi-heart"></i>
                                </button>
                            </div>
                            <div class="card-body p-2">
                                <h5 class="product-title">CAMISETA COM BORDADO</h5>
                                <div class="product-price">R$ 259,90</div>
                                <div class="product-installments">ou 6x de R$ 43,32</div>
                                <div class="product-colors">
                                    <div class="color-option" style="background-color: white;"></div>
                                    <div class="color-option" style="background-color: navy;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Paginação -->
                <div class="d-flex justify-content-center my-5">
                    <nav aria-label="Navegação de páginas">
                        <ul class="pagination">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" aria-label="Anterior">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Próximo">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Newsletter -->
    <section class="newsletter-section mt-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 text-center">
                    <h3 class="mb-3">CADASTRE-SE E RECEBA NOVIDADES</h3>
                    <p class="mb-4">Receba em primeira mão nossas novidades e promoções exclusivas.</p>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Seu e-mail" aria-label="Seu e-mail">
                        <button class="btn btn-dark" type="button">CADASTRAR</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
