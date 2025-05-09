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
                            // Se o produto tem URL definida no banco de dados, usa ela
                            if (!empty($produto->url)) {
                                $imagemPrincipal = 'storage/' . $produto->url;
                            } else {
                                // Se não tem URL no banco, tenta um caminho alternativo antigo
                                $imagemPrincipal = "/css/image/card/camisa{$produto->id}.jpg";
                                
                                // Se o arquivo alternativo não existir, usa uma imagem padrão aleatória
                                if (!file_exists(public_path($imagemPrincipal))) {
                                    $imagemPrincipal = '/css/image/card/image' . rand(1, 5) . '.png';
                                }
                            }

                            // Imagens secundárias - poderia ser implementado com múltiplas imagens no banco
                            $imagensSecundarias = [];

                            // Tenta encontrar até 4 imagens secundárias pelos métodos antigos
                            for ($i = 1; $i <= 4; $i++) {
                                $path = "/css/image/card/camisa{$produto->id}-{$i}.jpg";
                                if (file_exists(public_path($path))) {
                                    $imagensSecundarias[] = $path;
                                }
                            }
                        @endphp

                        <!-- Miniatura da imagem principal -->
                        <div class="product-thumbnail mb-2">
                            <img src="{{ asset($imagemPrincipal) }}" alt="{{ $produto->nome }} principal"
                                class="img-fluid border border-secondary thumbnail-image"
                                data-image="{{ asset($imagemPrincipal) }}" onclick="alterarImagemPrincipal(this)">
                        </div>

                        <!-- Miniaturas das imagens secundárias -->
                        @foreach ($imagensSecundarias as $index => $imagem)
                            <div class="product-thumbnail mb-2">
                                <img src="{{ asset($imagem) }}" alt="{{ $produto->nome }} {{ $index + 1 }}"
                                    class="img-fluid border border-secondary thumbnail-image"
                                    data-image="{{ asset($imagem) }}" onclick="alterarImagemPrincipal(this)">
                            </div>
                        @endforeach
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
                                <div class="card-product position-relative">
                                    <a href="{{ route('product.show', $prod['id']) }}"
                                        class="text-decoration-none text-dark">
                                        <div class="image-container">
                                            @php
                                                if (!empty($prod->url)) {
                                                    $imagemProduto = 'storage/' . $prod->url;
                                                } else {
                                                    $imagemProduto = "/css/image/card/camisa{$prod->id}.jpg";
                                                    $imagemPadrao = '/css/image/card/image' . rand(1, 5) . '.png';
                                                    $imagem = file_exists(public_path($imagemProduto))
                                                        ? $imagemProduto
                                                        : $imagemPadrao;
                                                }
                                            @endphp
                                            <img src="{{ asset($imagemProduto) }}" class="card-img-top"
                                                alt="{{ $prod->nome }}">
                                        </div>
                                        <div class="card d-flex flex-column p-2 border-0">
                                            <div class="star">
                                                <i class="fa-solid fa-star fa-2xs"></i>
                                                <i class="fa-solid fa-star fa-2xs"></i>
                                                <i class="fa-solid fa-star fa-2xs"></i>
                                                <i class="fa-solid fa-star fa-2xs"></i>
                                                <i class="fa-regular fa-star fa-2xs"></i>
                                            </div>
                                            <h5 class="font-weight-bold">{{ $prod['nome'] }}</h5>
                                            <p class="card-price">
                                                <s>R${{ number_format($prod['preco'] + 99.99, 2, ',', '.') }}</s>
                                                <strong>R${{ number_format($prod['preco'], 2, ',', '.') }}</strong>
                                            </p>
                                        </div>
                                    </a>

                                    <div class="cart-icon">
                                        <a href="{{ route('product.show', $prod['id']) }}" class="text-decoration-none">
                                            <i class="fa-solid fa-bag-shopping fa-xl"
                                                style="color: rgb(93, 92, 92); cursor: pointer;"></i>
                                        </a>
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
