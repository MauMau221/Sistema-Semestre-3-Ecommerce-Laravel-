@extends('master')

@section('content')
    @if (empty($produtos))
        <div class="alert alert-danger mt-0">
            <p>Itens não encontrados</p>
        </div>
    @endif

    @include('carrossel.carrossel')

    <main>
        <div class="container">
            {{-- Categorias --}}
            <div class="row justify-content-center">
                <div class="col-6 col-lg-4 col-md-4 col-sm-6
                my-2">
                    <div class="card text-center">
                        <a href="{{ route('category.categorias', ['nome' => 'camisas']) }}" class="">
                            <img src="image/categorias/catCamisas.png" class="card-img-top">
                        </a>
                    </div>
                </div>
                <div class="col-6 col-lg-4 col-md-4 col-sm-6
                my-2">
                    <div class="card text-center">
                        <a href="{{ route('category.categorias', ['nome' => 'camisetas']) }}" class="">
                            <img src="image/categorias/catCamisas1.png" class="card-img-top">
                        </a>
                    </div>
                </div>
                <div class="col-6 col-lg-4 col-md-4 col-sm-6
                my-2">
                    <div class="card text-center">
                        <a href="{{ route('category.categorias', ['nome' => 'calcas']) }}" class="">
                            <img src="image/categorias/catCamisas2.png" class="card-img-top">
                        </a>
                    </div>
                </div>
                <div class="col-6 col-lg-4 col-md-4 col-sm-6
                my-2">
                    <div class="card text-center">
                        <a href="{{ route('category.categorias', ['nome' => 'calcados']) }}" class="">
                            <img src="image/categorias/catCamisas3.png" class="card-img-top">
                        </a>
                    </div>
                </div>
                <div class="col-6 col-lg-4 col-md-4 col-sm-6
                my-2">
                    <div class="card text-center">
                        <a href="{{ route('category.categorias', ['nome' => 'polos']) }}" class="">
                            <img src="image/categorias/catCamisas4.png" class="card-img-top">
                        </a>
                    </div>
                </div>
                <div class="col-6 col-lg-4 col-md-4 col-sm-6
                my-2">
                    <div class="card text-center">
                        <a href="{{ route('category.categorias', ['nome' => 'jaquetas']) }}" class="">
                            <img src="image/categorias/catCamisas5.png" class="card-img-top">
                        </a>
                    </div>
                </div>
            </div>

            <section class="recommendations-section container my-5">
                <h2 class="text-center mb-4">Recomendações da Semana</h2>
                <ul class="nav nav-tabs justify-content-center mb-4" id="recommendationsTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="novidades-tab" data-bs-toggle="tab" data-bs-target="#novidades"
                            type="button" role="tab" aria-controls="novidades" aria-selected="true">NOVIDADES</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="mais-vendidos-tab" data-bs-toggle="tab" data-bs-target="#mais-vendidos"
                            type="button" role="tab" aria-controls="mais-vendidos" aria-selected="false">MAIS
                            VENDIDOS</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="ofertas-tab" data-bs-toggle="tab" data-bs-target="#ofertas"
                            type="button" role="tab" aria-controls="ofertas" aria-selected="false">OFERTAS</button>
                    </li>
                </ul>

                <div class="tab-content" id="recommendationsTabContent">
                    <div class="tab-pane fade show active" id="novidades" role="tabpanel" aria-labelledby="novidades-tab">
                        <div class="row">
                            <!-- Product Card 1 -->
                            <div class="col-md-3 col-sm-6 mb-4">
                                <div class="card product-card">
                                    <img src="/image/cards/camisas/camisa4.jpg" class="card-img-top"
                                        alt="Produto Novidade 1">
                                    <div class="card-body">
                                        <p class="text-muted small">ARAMIS</p>
                                        <h5 class="card-title">JAQUETA NYLON DUPLA FACE PUFFER PRETO COM VERDE</h5>
                                        <p class="card-text"><strong>R$ 1.499,90</strong></p>
                                        <p class="card-text small">Tamanhos Disponíveis: P, M, G, GG, XGG</p>
                                        <a href="#"
                                            class="btn btn-outline-dark w-100 stretched-link visually-hidden">Ver
                                            Produto</a>
                                        <div class="cart-icon-hover position-absolute bottom-0 end-0 p-2 bg-white rounded-circle"
                                            style="opacity:0; transition: opacity 0.3s ease;">
                                            <i class="fa-solid fa-bag-shopping fa-lg"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Product Card 2 -->
                            <div class="col-md-3 col-sm-6 mb-4">
                                <div class="card product-card">
                                    <img src="image/cards/camisas/camisa5.jpg" class="card-img-top"
                                        alt="Produto Novidade 2">
                                    <div class="card-body">
                                        <p class="text-muted small">ARAMIS</p>
                                        <h5 class="card-title">JAQUETA PV MESCLA GRAFITE MESCLA</h5>
                                        <p class="card-text"><strong>R$ 1.699,90</strong></p>
                                        <p class="card-text small">Tamanhos Disponíveis: P, M, G, GG, XGG</p>
                                        <a href="#"
                                            class="btn btn-outline-dark w-100 stretched-link visually-hidden">Ver
                                            Produto</a>
                                        <div class="cart-icon-hover position-absolute bottom-0 end-0 p-2 bg-white rounded-circle"
                                            style="opacity:0; transition: opacity 0.3s ease;">
                                            <i class="fa-solid fa-bag-shopping fa-lg"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Product Card 3 -->
                            <div class="col-md-3 col-sm-6 mb-4">
                                <div class="card product-card">
                                    <img src="image/cards/camisas/camisa6.jpg" class="card-img-top"
                                        alt="Produto Novidade 3">
                                    <div class="card-body">
                                        <p class="text-muted small">ARAMIS</p>
                                        <h5 class="card-title">JAQUETA BOMBER COURO SPECIAL EDITION PRETO</h5>
                                        <p class="card-text"><strong>R$ 4.999,90</strong></p>
                                        <p class="card-text small">Tamanhos Disponíveis: P, M, G, GG</p>
                                        <a href="#"
                                            class="btn btn-outline-dark w-100 stretched-link visually-hidden">Ver
                                            Produto</a>
                                        <div class="cart-icon-hover position-absolute bottom-0 end-0 p-2 bg-white rounded-circle"
                                            style="opacity:0; transition: opacity 0.3s ease;">
                                            <i class="fa-solid fa-bag-shopping fa-lg"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Product Card 4 -->
                            <div class="col-md-3 col-sm-6 mb-4">
                                <div class="card product-card">
                                    <img src="image/cards/camisas/camisa7.jpg" class="card-img-top"
                                        alt="Produto Novidade 4">
                                    <div class="card-body">
                                        <p class="text-muted small">ARAMIS</p>
                                        <h5 class="card-title">JAQUETA CHAMOUIS COM BOTÕES CAFÉ</h5>
                                        <p class="card-text"><strong>R$ 4.999,90</strong></p>
                                        <p class="card-text small">Tamanhos Disponíveis: M, G, GG</p>
                                        <a href="#"
                                            class="btn btn-outline-dark w-100 stretched-link visually-hidden">Ver
                                            Produto</a>
                                        <div class="cart-icon-hover position-absolute bottom-0 end-0 p-2 bg-white rounded-circle"
                                            style="opacity:0; transition: opacity 0.3s ease;">
                                            <i class="fa-solid fa-bag-shopping fa-lg"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="mais-vendidos" role="tabpanel" aria-labelledby="mais-vendidos-tab">
                        <!-- Placeholder for Mais Vendidos products -->
                        <p class="text-center">Conteúdo para Mais Vendidos em breve.</p>
                    </div>
                    <div class="tab-pane fade" id="ofertas" role="tabpanel" aria-labelledby="ofertas-tab">
                        <!-- Placeholder for Ofertas products -->
                        <p class="text-center">Conteúdo para Ofertas em breve.</p>
                    </div>
                </div>
            </section>

            <hr class="mt-3">

            <section class="promo-section container my-5">
                <div class="row align-items-center">
                    <div class="col-md-4 d-flex flex-column justify-content-center">
                        <h2 class="fw-bold">Presentes até R$199</h2>
                        <div class="promo-lines my-3">
                            <span class="promo-line active"></span>
                            <span class="promo-line"></span>
                            <span class="promo-line"></span>
                            <span class="promo-line"></span>
                        </div>
                        <p>Tomara que você ganhe Aramis de presente!</p>
                        <p class="mb-4">Neste Dia dos Namorados, surpreenda com a nossa seleção especial e ganhe 10% OFF
                            extra
                            no pix!</p>
                        <a href="#" class="btn btn-dark align-self-start">DESCUBRA MAIS</a>
                    </div>
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card product-card-promo">
                                    <img src="image/cards/camisas/camisa3.jpg" class="card-img-top" alt="Produto 1">
                                    <div class="card-body text-center">
                                        <h5 class="card-title">CAMISETA MANGA CURTA LISBOA BRANCO</h5>
                                        <p class="card-text">
                                            <span class="text-decoration-line-through">R$ 319,90</span>
                                            <strong>R$ 199,90</strong>
                                        </p>
                                        <a href="#" class="btn btn-outline-dark">COMPRAR</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card product-card-promo">
                                    <img src="image/cards/camisas/camisa2.jpg" class="card-img-top" alt="Produto 2">
                                    <div class="card-body text-center">
                                        <h5 class="card-title">CAMISETA MANGA CURTA CANNES PRETO</h5>
                                        <p class="card-text">
                                            <span class="text-decoration-line-through">R$ 319,90</span>
                                            <strong>R$ 199,90</strong>
                                        </p>
                                        <a href="#" class="btn btn-outline-dark">COMPRAR</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            {{-- Modified product carousel section --}}
            @foreach ($produtosPorCategoria as $categoria => $dados)
                <h3 class="p-4">{{ $dados['nome'] }}</h3>

                <div class="container"> {{-- Container for this category's swiper --}}
                    <div class="d-flex justify-content-end m-2">
                        <div class="button-prev p-2"><i
                                class="fa-solid fa-circle-chevron-right fa-flip-horizontal fa-2xl"></i>
                        </div>
                        <div class="button-next p-2"><i class="fa-solid fa-circle-chevron-right fa-2xl"></i></div>
                    </div>
                    <div class="swiper mySwiper">
                        <div class="swiper-wrapper">
                            @if (!empty($dados['produtos']) && count($dados['produtos']) > 0)
                                @foreach ($dados['produtos'] as $produto)
                                    {{-- INNER LOOP FOR PRODUCTS --}}
                                    <div class="swiper-slide">
                                        <div class="card-product position-relative">
                                            @php
                                                // Assuming $produto is an array here based on usage below
                                                $imagemProduto = "image/cards/camisas/camisa{$produto['id']}.jpg";
                                                $imagemPadrao = 'image/cards/image' . rand(1, 5) . '.png';
                                                $imagem = file_exists(public_path($imagemProduto))
                                                    ? $imagemProduto
                                                    : $imagemPadrao;
                                            @endphp
                                            <img src="{{ asset($imagem) }}" class="card-img-top"
                                                alt="{{ $produto['nome'] }}">

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
                                                    <s>R${{ number_format(floatval($produto['preco']) + 99.99, 2, ',', '.') }}</s>
                                                    <strong>R${{ number_format(floatval($produto['preco']), 2, ',', '.') }}</strong>
                                                </p>
                                            </div>

                                            <div class="cart-icon"> {{-- Single cart icon --}}
                                                <a href="{{ route('product.show', $produto['id']) }}"
                                                    class="text-decoration-none">
                                                    <i class="fa-solid fa-bag-shopping fa-xl"
                                                        style="color: rgb(93, 92, 92); cursor: pointer;"></i>
                                                </a>
                                            </div>
                                        </div> {{-- Closes card-product --}}
                                    </div> {{-- Closes swiper-slide --}}
                                @endforeach {{-- CLOSES INNER PRODUCT LOOP --}}
                            @else
                                <div class="swiper-slide">
                                    <p class="text-center p-3">Nenhum produto encontrado para esta categoria.</p>
                                </div>
                            @endif
                        </div> {{-- Closes swiper-wrapper --}}
                    </div> {{-- Closes swiper --}}
                </div> {{-- Closes inner container for this category --}}
                <hr class="mt-3"> {{-- HR for this category section --}}
            @endforeach {{-- CLOSES OUTER CATEGORY LOOP ($produtosPorCategoria) --}}

        </div>
    </main>
@endsection
