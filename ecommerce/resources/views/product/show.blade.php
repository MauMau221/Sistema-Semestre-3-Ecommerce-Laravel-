@extends('master')

@section('content')
    <section>
        <section class="container py-4">
            <div class="row">
                <!-- Imagens do produto -->
                <div class="col-md-6 d-flex flex-md-row flex-column">
                    <!-- Miniaturas -->
                    <div class="d-none d-md-block me-2">
                        @php
                            $categoriaNome = $nomeCat;

                            $imagemPrincipal = "/image/cards/{$categoriaNome}/{$categoriaNome}{$produto->id}.jpg";

                        @endphp

                        <!-- Miniatura da imagem principal -->
                        <div class="product-thumbnail mb-2">
                            <img src="{{ asset($imagemPrincipal) }}" alt="{{ $produto->nome }} principal"
                                class="img-fluid border border-secondary thumbnail-image"
                                data-image="{{ asset($imagemPrincipal) }}" onclick="alterarImagemPrincipal(this)">
                        </div>

                        <!-- Miniaturas das imagens secundárias -->
                            <div class="product-thumbnail mb-2">
                                <img src="{{ asset($imagemPrincipal) }}" alt="{{ $produto->nome }}"
                                    class="img-fluid border border-secondary thumbnail-image"
                                    data-image="{{ asset($imagemPrincipal) }}" onclick="alterarImagemPrincipal(this)">
                            </div>
                    </div>

                    <!-- Imagem principal -->
                    <div class="flex-grow-1 ml-2">
                        <img id="imagem-principal" src="{{ asset($imagemPrincipal) }}" alt="{{ $produto->nome }}"
                            class="img-fluid border border-secondary w-100">
                    </div>
                </div>

                <!-- Detalhes do produto -->
                <div class="col-md-6 product-details">
                    <h1 class="product-title">{{ $produto['nome'] }}</h1>
                    <div class="mb-3">
                        <span class="product-price">R$ {{ number_format($produto['preco'], 2, ',', '.') }}</span>
                        <div class="product-installments">em até 6x de R$
                            {{ number_format($produto['preco'] / 6, 2, ',', '.') }} sem juros</div>
                    </div>

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('cart.add') }}" method="POST" id="addToCartForm">
                        @csrf
                        <input type="hidden" name="produto_id" value="{{ $produto->id }}">
zz
                        <div class="mb-4">
                            <div class="fw-bold mb-2">Cor:</div>
                            <div class="d-flex mb-3">
                                @foreach ($produto->estoque->pluck('cor')->unique() as $cor)
                                    <div class="me-2">
                                        <input type="radio" name="cor" value="{{ $cor }}"
                                            id="cor_{{ $cor }}" class="cor-input">
                                        <label for="cor_{{ $cor }}" class="cor-label"
                                            style="width: 30px; height: 30px; border-radius: 50%; cursor: pointer; display: inline-block; border: 2px solid #ddd;"
                                            title="{{ $cor }}">
                                            <span class="d-none">{{ $cor }}</span>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            <div id="cor-selecionada" class="mt-1 small text-muted">Selecione uma cor</div>
                            @error('cor')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <div class="fw-bold mb-2">Tamanho:</div>
                            <div class="d-flex flex-wrap tamanho-container">
                                @foreach ($produto->estoque->pluck('tamanho')->unique() as $tamanho)
                                    <div class="me-2 mb-2">
                                        <input type="radio" name="tamanho" value="{{ $tamanho }}"
                                            id="tamanho_{{ $tamanho }}" class="tamanho-input">
                                        <label for="tamanho_{{ $tamanho }}"
                                            class="tamanho-label btn btn-outline-dark rounded-0">{{ $tamanho }}</label>
                                    </div>
                                @endforeach
                            </div>
                            @error('tamanho')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <div class="mt-2">
                                <a href="#" class="text-decoration-none text-dark">Guia de tamanhos</a>
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="fw-bold mb-2">Quantidade:</div>
                            <div class="d-flex align-items-center">
                                <button type="button" class="btn btn-outline-dark rounded-0 quantity-btn"
                                    id="diminuir-quantidade">-</button>
                                <input type="number" id="quantidade" name="quantidade"
                                    class="form-control rounded-0 text-center mx-2 quantity-input" value="1"
                                    min="1" max="10" style="width: 70px;" required>
                                <button type="button" class="btn btn-outline-dark rounded-0 quantity-btn"
                                    id="aumentar-quantidade">+</button>
                            </div>
                            @error('quantidade')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <div class="mt-2 text-muted">
                                <span id="estoque-disponivel">Selecione cor e tamanho</span> unidades disponíveis
                            </div>
                        </div>

                        <div class="d-flex mb-3 align-items-center">
                            <button type="submit" class="btn btn-dark flex-grow-1 rounded-0 me-2"
                                id="addToCartBtn">Adicionar ao Carrinho</button>

                            @if (Auth::check())
                                <button type="button" class="btn btn-outline-danger rounded-0 favorite-btn"
                                    style="width: 46px;" id="favoriteBtn">
                                    <i
                                        class="fa-{{ $produto->isFavoritedBy(Auth::id()) ? 'solid' : 'regular' }} fa-heart"></i>
                                </button>
                            @else
                                <a href="{{ route('home.login') }}" class="btn btn-outline-danger rounded-0"
                                    style="width: 46px;">
                                    <i class="fa-regular fa-heart"></i>
                                </a>
                            @endif
                        </div>
                    </form>

                    @if (Auth::check())
                        <!-- Formulário de favoritos separado, fora do formulário de adicionar ao carrinho -->
                        <form action="{{ route('favorites.toggle') }}" method="POST" id="favoriteForm" class="d-none">
                            @csrf
                            <input type="hidden" name="produto_id" value="{{ $produto->id }}">
                        </form>

                        <!-- Script para manipular o favorito via JavaScript -->
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                document.getElementById('favoriteBtn').addEventListener('click', function() {
                                    document.getElementById('favoriteForm').submit();
                                });
                            });
                        </script>
                    @endif

                    <div class="mb-4">
                        <div class="fw-bold mb-2">Descrição:</div>
                        <p>{{ $produto['desc'] }}.</p>
                    </div>

                    <div class="mb-4">
                        <div class="fw-bold mb-2">Composição:</div>
                        <p>100% Algodão</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Produtos similares -->
        <section class="container py-5">
            <h2 class="text-center mb-4">VOCÊ TAMBÉM PODE GOSTAR</h2>
            <div class="container">
                <div class="d-flex justify-content-end m-2">
                    <div class="button-prev p-2"><i
                            class="fa-solid fa-circle-chevron-right fa-flip-horizontal fa-2xl"></i>
                    </div>
                    <div class="button-next p-2"><i class="fa-solid fa-circle-chevron-right fa-2xl"></i></div>
                </div>
                <div class="swiper mySwiper">
                    <div class="swiper-wrapper">
                        @foreach ($relacionados as $prod)
                            <div class="swiper-slide">
                                <div class="card product-card h-100">
                                    @php
                                        if (!empty($prod->url)) {
                                            $imagemProduto = $prod->url;
                                        } else {
                                            // Tentar encontrar a categoria
                                            $categoriaNome = '';
                                            if ($prod->categoria_id) {
                                                $categoria = \App\Models\Categoria::find($prod->categoria_id);
                                                if ($categoria) {
                                                    $categoriaNome = strtolower($categoria->nome);
                                                }
                                            }

                                            // Se não tiver categoria, tentar usar camisas como fallback
                                            $categoriaNome = $categoriaNome ?: 'camisas';

                                            // Tentar com o caminho específico da categoria
                                            $imagemProduto = "/image/cards/{$categoriaNome}/camisa{$prod->id}.jpg";

                                            // Se não existir, tentar com caminho genérico de camisas
                                            if (!file_exists(public_path($imagemProduto))) {
                                                $imagemProduto = "/image/cards/camisas/camisa{$prod->id}.jpg";
                                            }

                                            // Se ainda não existir, usar imagem padrão
                                            if (!file_exists(public_path($imagemProduto))) {
                                                $imagemProduto = '/css/image/card/image' . rand(1, 5) . '.png';
                                            }
                                        }
                                    @endphp
                                    <img src="{{ asset($imagemProduto) }}" class="card-img-top" alt="{{ $prod->nome }}">
                                    <div class="card-body d-flex flex-column">
                                        <h5 class="card-title">{{ $prod['nome'] }}</h5>
                                        <p class="card-text">
                                            <s>R${{ number_format($prod['preco'] + 99.99, 2, ',', '.') }}</s>
                                            <strong>R${{ number_format($prod['preco'], 2, ',', '.') }}</strong>
                                        </p>
                                        <a href="{{ route('product.show', $prod['id']) }}" class="btn btn-outline-dark w-100 mt-auto">Ver Produto</a>
                                        <div class="cart-icon-hover position-absolute bottom-0 end-0 p-2 bg-white rounded-circle" style="opacity:0; transition: opacity 0.3s ease;">
                                            <i class="fa-solid fa-bag-shopping fa-lg"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    </section>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/product/show.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('js/product/show.js') }}"></script>
@endpush
