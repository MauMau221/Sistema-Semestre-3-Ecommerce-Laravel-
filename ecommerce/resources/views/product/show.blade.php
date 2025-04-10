@extends('master')

@section('content')
    <section>
        <section class="container py-4">
            <div class="row">
                <!-- Imagens do produto -->
                <div class="col-md-6 d-flex flex-md-row flex-column">
                    <!-- Miniaturas -->
                    <div class="d-none d-md-block me-2">
                        <div class="product-thumbnail mb-2">
                            <img src="/css/image/card/image.png" alt="Miniatura 1" class="img-fluid border border-secondary">
                        </div>
                        <div class="product-thumbnail mb-2">
                            <img src="/css/image/card/image.png" alt="Miniatura 2" class="img-fluid border border-secondary">
                        </div>
                        <div class="product-thumbnail mb-2">
                            <img src="/css/image/card/image.png" alt="Miniatura 3" class="img-fluid border border-secondary">
                        </div>
                        <div class="product-thumbnail mb-2">
                            <img src="/css/image/card/image.png" alt="Miniatura 4" class="img-fluid border border-secondary">
                        </div>
                    </div>
                
                    <!-- Imagem principal -->
                    <div class="flex-grow-1 ml-2">
                        <img src="{{ $produto['url'] ?? asset('/css/image/card/image.png') }}"
                             alt="Imagem principal"
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
                    <form action="/cart/add" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="produto_id" value="{{ $produto->id }}">

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
                                <button class="size-btn btn btn-outline-dark rounded-0">P</button>
                                <button class="size-btn btn btn-outline-dark rounded-0">M</button>
                                <button class="size-btn btn btn-outline-dark rounded-0">G</button>
                                <button class="size-btn btn btn-outline-dark rounded-0">GG</button>
                            </div>
                            <div class="mt-2">
                                <a href="#" class="text-decoration-none text-dark">Guia de tamanhos</a>
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="fw-bold mb-2">Quantidade:</div>
                            <div class="d-flex align-items-center">
                                <button class="btn btn-outline-dark rounded-0 quantity-btn"
                                    onclick="btnDiminuirQtd(event)">-</button>
                                <input type="number" id="quantidade" name="quantidade" class="form-control rounded-0 text-center mx-2 quantity-input"
                                    value="1" min="1" max="10" style="width: 70px;">
                                <button class="btn btn-outline-dark rounded-0 quantity-input"
                                    onclick="btnAumentarQtd(event)">+</button>
                            </div>
                        </div>

                        <div class="mb-4">
                            <button type="submit" class="add-to-cart w-100 mb-3 btn btn-outline-dark rounded-0">ADICIONAR À
                                SACOLA</button>
                            <div class="d-flex justify-content-between">
                                <a href="#" class="text-decoration-none text-dark"><i
                                        class="fa-regular fa-heart fa-lg p-1"></i></i>Adicionar aos favoritos</a>
                                <a href="#" class="text-decoration-none text-dark"><i
                                        class="fa-solid fa-share fa-lg p-1"></i></i>Compartilhar</a>
                            </div>
                        </div>
                    </form>
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
                                    <div class="cart-icon">
                                        <form action="/cart/add" method="POST">
                                            @csrf
                                            <input type="hidden" name="produto_id" value="{{ $produto->id }}">
                                            <button type="submit" class="border-0 bg-transparent">
                                                <i class="fa-solid fa-bag-shopping fa-xl"
                                                    style="color: rgb(93, 92, 92); cursor: pointer;"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endsection
