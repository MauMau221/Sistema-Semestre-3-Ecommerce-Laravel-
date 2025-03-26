@extends('master')

@section('content')
    <section>
        <section class="container py-4">
            <div class="row">
                <!-- Imagens do produto -->
                <div class="col-md-1 d-none d-md-block">
                    <div class="product-thumbnail active">
                        <img src="/api/placeholder/80/100" alt="Miniatura 1" class="img-fluid">
                    </div>
                    <div class="product-thumbnail">
                        <img src="/api/placeholder/80/100" alt="Miniatura 2" class="img-fluid">
                    </div>
                    <div class="product-thumbnail">
                        <img src="/api/placeholder/80/100" alt="Miniatura 3" class="img-fluid">
                    </div>
                    <div class="product-thumbnail">
                        <img src="/api/placeholder/80/100" alt="Miniatura 4" class="img-fluid">
                    </div>
                </div>

                <!-- Imagem principal -->
                <div class="col-md-5">
                    <img src="{{ $produto['url'] ?? asset('/css/image/card/image.png') }}" alt="Camiseta Manga Curta"
                        class="img-fluid">
                </div>

                <!-- Detalhes do produto -->
                <div class="col-md-6 product-details">
                    <h1 class="product-title">{{ $produto['nome'] }}</h1>
                    <div class="mb-3">
                        <span class="product-price">R$ {{ number_format($produto['preco'], 2, ',', '.') }}</span>
                        <div class="product-installments">em até 6x de R$
                            {{ number_format($produto['preco'] / 6, 2, ',', '.') }} sem juros</div>
                    </div>

                    <div class="mb-4">
                        <div class="fw-bold mb-2">Cor: Azul</div>
                        <div class="d-flex mb-3">
                            <div class="me-2"
                                style="width: 30px; height: 30px; background-color: navy; border-radius: 50%;"></div>
                            <div class="me-2"
                                style="width: 30px; height: 30px; background-color: black; border-radius: 50%;"></div>
                            <div class="me-2"
                                style="width: 30px; height: 30px; background-color: white; border: 1px solid #dee2e6; border-radius: 50%;">
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <div class="fw-bold mb-2">Tamanho:</div>
                        <div class="d-flex flex-wrap">
                            <button class="size-btn">P</button>
                            <button class="size-btn">M</button>
                            <button class="size-btn">G</button>
                            <button class="size-btn">GG</button>
                        </div>
                        <div class="mt-2">
                            <a href="#" class="text-decoration-none text-dark">Guia de tamanhos</a>
                        </div>
                    </div>

                    <div class="mb-4">
                        <button class="add-to-cart w-100 mb-3">ADICIONAR À SACOLA</button>
                        <div class="d-flex justify-content-between">
                            <a href="#" class="text-decoration-none text-dark"><i
                                    class="bi bi-heart me-2"></i>Adicionar aos favoritos</a>
                            <a href="#" class="text-decoration-none text-dark"><i
                                    class="bi bi-share me-2"></i>Compartilhar</a>
                        </div>
                    </div>

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
            <div class="swiper mySwiper">
                <div class="d-flex justify-content-end m-2">
                    <div class="button-prev p-2"><i class="fa-solid fa-circle-chevron-right fa-flip-horizontal fa-2xl"></i>
                    </div>
                    <div class="button-next p-2"><i class="fa-solid fa-circle-chevron-right fa-2xl"></i></div>
                </div>
                <div class="swiper-wrapper">
                    @foreach ($relacionados as $produto)
                        <a href="{{ route('product.show', $produto['id']) }}">
                            <div class="swiper-slide">
                                <div class="card-product">
                                    <div class="image-container position-relative">
                                        <img src="{{ $produto['url'] ?? asset('/css/image/card/image.png') }}"
                                            class="card-img-top">
                                        <a href="#" class="p-3 text-dark cart-icon position-absolute bottom-0 end-0">
                                            <i class="fa-solid fa-cart-plus fa-xl"></i>
                                        </a>
                                    </div>
                                    <div class="card d-flex flex-column p-2 border-0">
                                        <div class="star">
                                            <i class="fa-solid fa-star fa-2xs"></i>
                                            <i class="fa-solid fa-star fa-2xs"></i>
                                            <i class="fa-solid fa-star fa-2xs"></i>
                                            <i class="fa-solid fa-star fa-2xs"></i>
                                            <i class="fa-regular fa-star fa-2xs"></i>
                                        </div>
                                        <h5 class="font-weight-bold">{{ $produto['nome'] }}</h5>
                                        <p class="card-price">
                                            <strong>R${{ $produto['preco'] }}</strong>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endsection
