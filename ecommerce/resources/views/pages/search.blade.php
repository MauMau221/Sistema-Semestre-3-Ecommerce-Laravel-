@extends('master')

@section('content')
    <div class="container mt-3">
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
                        <h4 class="mb-0">CAMISETAS</h4>
                        <p class="text-muted mb-0">{{ $produtos->count() }} produtos encontrados</p>
                    </div>
                    <div class="d-flex align-items-center">
                        <label for="sort" class="mt-2 mr-1">Ordenar por:</label>
                        <select id="sort" class="sort-select border-0">
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
                    @foreach ($produtos as $produto)
                        <div class="col-6 col-md-4 col-lg-3">
                            <div class="card product-card border-0">
                                <div class="position-relative">
                                    <a href="{{ route('product.show', $produto['id']) }}" class="text-decoration-none">
                                        <img src="{{ $produto['url'] ?? asset('https://cdn-icons-png.flaticon.com/512/2071/2071149.png') }}"
                                            alt="Sem foto" class="card-img-top">

                                    </a>
                                </div>
                                <div class="card-body p-2">
                                    <a href="{{ route('product.show', $produto['id']) }}" >
                                        <h5 class="font-weight-bold text-dark">{{ $produto['nome'] }}</h5>
                                    </a>
                                    <strong>R${{ number_format($produto['preco'], 2, ',', '.') }}</strong>
                                    <div class="product-installments">
                                        <p>Ou 6x de R$ {{ number_format($produto['preco'] / 6, 2, ',', '.') }}</p>
                                    </div>
                                    <div class="product-colors">
                                        <div class="color-option" style="background-color: navy;"></div>
                                        <div class="color-option" style="background-color: black;"></div>
                                        <div class="color-option" style="background-color: white;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
