@extends('master')

@section('content')
    @if (empty($dadosCategoria['produtos']) || $dadosCategoria['produtos']->count() === 0)
        <div class="alert alert-danger mt-0">
            <p>Itens não encontrados para a categoria selecionada</p>
        </div>
    @endif
    <!-- Breadcrumb -->
    <div class="container mt-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home.home') }}"
                        class="text-decoration-none text-secondary">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ ucfirst($dadosCategoria['nome']) }}</li>
                <!-- ucfisrt deixa a primeira letra maiuscula -->
            </ol>
        </nav>
    </div>

    <!-- Conteúdo Principal -->
    <div class="container">
        <div class="row">
            <!-- Filtros - Coluna Lateral -->
            <div class="col-lg-3 d-none d-lg-block">
                <h4 class="mb-4">FILTROS</h4>

                <form action="{{ route('product.search') }}" method="GET">
                    @csrf
                    <!-- Filtro de Preço -->
                    <div class="filter-card">
                        <div class="filter-header">PREÇO</div>
                        <div class="filter-option">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="price1" onchange="this.form.submit()">
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
                        <div class="d-flex flex-column">
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
            </form>
            <!-- Produtos -->
            <div class="col-lg-9">
                <!-- Cabeçalho de resultados -->
                <div class="results-header d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="mb-0">{{ $dadosCategoria['nome'] }}</h4>
                        <p class="text-muted mb-0">{{ $dadosCategoria['produtos']->count() }} produtos encontrados</p>
                    </div>
                    <div class="d-flex align-items-center">
                        <label for="sort" class="me-2 mt-1">Ordenar por:</label>
                        <select id="sort" class="sort-select border-0 p-1">
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
                    @foreach ($dadosCategoria['produtos'] as $produto)
                        <div class="col-6 col-md-4 col-lg-3 mt-3">
                            <div class="card product-card h-100">
                                <a href="{{ route('product.show', $produto['id']) }}" class="text-decoration-none">
                                    @php
                                        $imagem = "image/cards/{$dadosCategoria['nome']}/{$dadosCategoria['nome']}{$produto['id']}.jpg";
                                    @endphp
                                    <img src="{{ asset($imagem) }}" alt="{{ $produto->nome }}" class="card-img-top">
                                </a>
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title">{{ $produto['nome'] }}</h5>
                                    <p class="card-text">
                                        <s>R${{ number_format(floatval($produto['preco']) + 99.99, 2, ',', '.') }}</s>
                                        <strong>R${{ number_format(floatval($produto['preco']), 2, ',', '.') }}</strong>
                                    </p>
                                    <a href="{{ route('product.show', $produto['id']) }}"
                                        class="btn btn-outline-dark w-100 mt-auto">Ver Produto</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- Paginação -->

                <div class="d-flex flex-column align-items-center my-5">
                    <div class="mb-2 text-muted small">
                        Exibindo {{ $dadosCategoria['produtos']->firstItem() }} a
                        {{ $dadosCategoria['produtos']->lastItem() }} de {{ $dadosCategoria['produtos']->total() }}
                        resultados
                    </div>
                    <nav aria-label="Navegação de páginas">
                        {{ $dadosCategoria['produtos']->links('vendor.pagination.custom') }}
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection
