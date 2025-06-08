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
                <li class="breadcrumb-item active" aria-current="page">
                    @if (isset($dadosCategoria['isSearch']))
                        Pesquisa
                    @else
                        {{ ucfirst($dadosCategoria['nome']) }}
                    @endif
                </li>
            </ol>
        </nav>
    </div>

    <!-- Conteúdo Principal -->
    <div class="container">
        <div class="row">
            <!-- Filtros - Coluna Lateral -->
            <div class="col-lg-3 d-none d-lg-block">
                <h4 class="mb-4">FILTROS</h4>

                <form
                    action="{{ isset($dadosCategoria['isSearch']) ? route('product.search') : route('category.categorias') }}"
                    method="GET">
                    @if (isset($dadosCategoria['isSearch']))
                        <input type="hidden" name="search" value="{{ request('search') }}">
                    @else
                        <input type="hidden" name="nome" value="{{ request('nome') }}">
                    @endif
                    <!-- Filtro de Preço -->
                    <div class="filter-card">
                        <div class="filter-header">PREÇO</div>
                        <div class="filter-option">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="preco[]" value="0-150" id="price1"
                                    {{ in_array('0-150', request('preco', [])) ? 'checked' : '' }}
                                    onchange="this.form.submit()">
                                <label class="form-check-label" for="price1">Até R$ 150</label>
                            </div>
                        </div>
                        <div class="filter-option">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="preco[]" value="151-250"
                                    id="price2" {{ in_array('151-250', request('preco', [])) ? 'checked' : '' }}
                                    onchange="this.form.submit()">
                                <label class="form-check-label" for="price2">R$ 151 - R$ 250</label>
                            </div>
                        </div>
                        <div class="filter-option">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="preco[]" value="251-350"
                                    id="price3" {{ in_array('251-350', request('preco', [])) ? 'checked' : '' }}
                                    onchange="this.form.submit()">
                                <label class="form-check-label" for="price3">R$ 251 - R$ 350</label>
                            </div>
                        </div>
                        <div class="filter-option">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="preco[]" value="351+" id="price4"
                                    {{ in_array('351+', request('preco', [])) ? 'checked' : '' }}
                                    onchange="this.form.submit()">
                                <label class="form-check-label" for="price4">Acima de R$ 350</label>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
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
                            <option value="price_asc">Menor preço</option>
                            <option value="price_desc">Maior preço</option>
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
                                        $imagem = "image/cards/{$produto->categoria->nome}/{$produto->categoria->nome}{$produto['id']}.jpg";
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

    <script src="{{ asset('js/product/product_filters.js') }}"></script>
@endsection
