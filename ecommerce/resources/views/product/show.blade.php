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
                    <img src="{{ $produto['url'] ?? asset('/css/image/card/image.png') }}" alt="Camiseta Manga Curta" class="img-fluid">
                </div>

                <!-- Detalhes do produto -->
                <div class="col-md-6 product-details">
                    <h1 class="product-title">{{ $produto['nome'] }}</h1>
                    <div class="mb-3">
                        <span class="product-price">R$ {{ number_format($produto['preco'], 2, ',', '.') }}</span>
                        <div class="product-installments">em até 6x de R$ {{ number_format($produto['preco'] / 6, 2, ',', '.') }} sem juros</div>
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
            <div class="row">
                <div class="col-6 col-md-3 similar-product">
                    <img src="/api/placeholder/250/300" alt="Produto similar 1" class="img-fluid">
                    <h5>Camiseta Básica</h5>
                    <div class="fw-bold">R$ 199,90</div>
                </div>
                <div class="col-6 col-md-3 similar-product">
                    <img src="/api/placeholder/250/300" alt="Produto similar 2" class="img-fluid">
                    <h5>Polo Manga Curta</h5>
                    <div class="fw-bold">R$ 259,90</div>
                </div>
                <div class="col-6 col-md-3 similar-product">
                    <img src="/api/placeholder/250/300" alt="Produto similar 3" class="img-fluid">
                    <h5>Camiseta Estampada</h5>
                    <div class="fw-bold">R$ 219,90</div>
                </div>
                <div class="col-6 col-md-3 similar-product">
                    <img src="/api/placeholder/250/300" alt="Produto similar 4" class="img-fluid">
                    <h5>Camiseta Listrada</h5>
                    <div class="fw-bold">R$ 229,90</div>
                </div>
            </div>
        </section>
    </section>
@endsection
