@extends('master')

@section('content')
    @if (empty($produtosComDesconto) || empty($produtosPorCategoria))
        <div class="alert alert-danger mt-0">
            <p>Itens não encontrados</p>
        </div>
    @endif

    @include('carrossel.carrossel')

    <main>
        <div class="container">
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
                        <button class="nav-link active home-recommendations" id="novidades-tab" data-bs-toggle="tab" data-bs-target="#novidades"
                            type="button" role="tab" aria-controls="novidades" aria-selected="true">NOVIDADES</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="ofertas-tab" data-bs-toggle="tab" data-bs-target="#ofertas"
                            type="button" role="tab" aria-controls="ofertas" aria-selected="false">OFERTAS</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="mais-vendidos-tab" data-bs-toggle="tab" data-bs-target="#mais-vendidos"
                            type="button" role="tab" aria-controls="mais-vendidos" aria-selected="false">MAIS
                            VENDIDOS</button>
                    </li>
                </ul>

                <div class="tab-content" id="recommendationsTabContent">
                    <div class="tab-pane fade show active" id="novidades" role="tabpanel" aria-labelledby="novidades-tab">
                        <div class="row">
                            @if ($produtosJaquetas->isNotEmpty())
                                @foreach ($produtosJaquetas as $produto)
                                    <div class="col-md-3 col-sm-6 mb-4">
                                        <div class="card product-card">
                                            <a href="{{ route('product.show', $produto['id']) }}"
                                                class="text-decoration-none">
                                                @php
                                                    $imagem = "image/cards/jaquetas/jaquetas{$produto['id']}.jpg";
                                                @endphp
                                                <img src="{{ asset($imagem) }}" alt="{{ $produto['nome'] }}"
                                                    class="card-img-top">
                                            </a>
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $produto['nome'] }}</h5>
                                                <p class="card-text">
                                                    @if ($produto['desconto'] > 0)
                                                        <s>R${{ number_format(floatval($produto['preco']), 2, ',', '.') }}</s>
                                                        <strong>R${{ number_format(floatval($produto['preco']) - floatval($produto['desconto']), 2, ',', '.') }}</strong>
                                                        <span
                                                            class="badge ms-2">-{{ number_format(($produto['desconto'] / $produto['preco']) * 100, 0) }}%</span>
                                                    @else
                                                        <strong>R${{ number_format(floatval($produto['preco']), 2, ',', '.') }}</strong>
                                                    @endif
                                                </p>
                                                <a href="{{ route('product.show', $produto['id']) }}"
                                                    class="btn btn-outline-dark w-100">Ver Produto</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="col-12">
                                    <p class="text-center">Nenhum produto disponível no momento.</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="tab-pane fade" id="ofertas" role="tabpanel" aria-labelledby="ofertas-tab">
                        <div class="row">
                            @if ($produtosComDesconto->isNotEmpty())
                                @foreach ($produtosComDesconto as $produto)
                                    <div class="col-md-3 col-sm-6 mb-4">
                                        <div class="card product-card">
                                            <a href="{{ route('product.show', $produto['id']) }}"
                                                class="text-decoration-none">
                                                @php
                                                    $imagem = "image/cards/{$produto->categoria->nome}/{$produto->categoria->nome}{$produto['id']}.jpg";
                                                @endphp
                                                <img src="{{ asset($imagem) }}" alt="{{ $produto['nome'] }}"
                                                    class="card-img-top">
                                            </a>
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $produto['nome'] }}</h5>
                                                <p class="card-text">
                                                    @if ($produto['desconto'] > 0)
                                                        <s>R${{ number_format(floatval($produto['preco']), 2, ',', '.') }}</s>
                                                        <strong>R${{ number_format(floatval($produto['preco']) - floatval($produto['desconto']), 2, ',', '.') }}</strong>
                                                        <span
                                                            class="badge ms-2">-{{ number_format(($produto['desconto'] / $produto['preco']) * 100, 0) }}%</span>
                                                    @else
                                                        <strong>R${{ number_format(floatval($produto['preco']), 2, ',', '.') }}</strong>
                                                    @endif
                                                </p>
                                                <a href="{{ route('product.show', $produto['id']) }}"
                                                    class="btn btn-outline-dark w-100">Ver Produto</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="col-12">
                                    <p class="text-center">Nenhum produto em oferta no momento.</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="tab-pane fade" id="mais-vendidos" role="tabpanel" aria-labelledby="mais-vendidos-tab">
                        <p class="text-center">Conteúdo para Mais Vendidos em breve.</p>
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
                                    <img src="image/cards/duplaBranca/duplas3.jpg" class="card-img-top" alt="Produto 1">
                                    <div class="card-body text-center">
                                        <h5 class="card-title">CAMISETAS MANGA CURTA LISBOA BRANCO</h5>
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
                                    <img src="image/cards/duplaPreta/duplas6.jpg" class="card-img-top" alt="Produto 2">
                                    <div class="card-body text-center">
                                        <h5 class="card-title">CAMISETAS MANGA CURTA CANNES PRETO</h5>
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

            @foreach ($produtosPorCategoria as $categoria => $dados)
                <h3 class="p-4">{{ $dados['nome'] }}</h3>

                <div class="container">
                    <div class="swiper mySwiper">
                        <div class="swiper-wrapper">
                            @if (!empty($dados['produtos']) && count($dados['produtos']) > 0)
                                @foreach ($dados['produtos'] as $produto)
                                    <div class="swiper-slide">
                                        <div class="card product-card h-100">
                                            @php
                                                $imagemProduto = "image/cards/{$dados['nome']}/{$dados['nome']}{$produto['id']}.jpg";
                                                $imagemPadrao = 'image/cards/image' . rand(1, 5) . '.png';
                                                $imagem = file_exists(public_path($imagemProduto))
                                                    ? $imagemProduto
                                                    : $imagemPadrao;
                                            @endphp
                                            <img src="{{ asset($imagem) }}" class="card-img-top"
                                                alt="{{ $produto['nome'] }}">

                                            <div class="card-body d-flex flex-column">
                                                <h5 class="card-title">{{ $produto['nome'] }}</h5>
                                                <p class="card-text">
                                                    @if ($produto['desconto'] > 0)
                                                        <s>R${{ number_format(floatval($produto['preco']), 2, ',', '.') }}</s>
                                                        <strong>R${{ number_format(floatval($produto['preco']) - floatval($produto['desconto']), 2, ',', '.') }}</strong>
                                                        <span
                                                            class="badge ms-2">-{{ number_format(($produto['desconto'] / $produto['preco']) * 100, 0) }}%</span>
                                                    @else
                                                        <strong>R${{ number_format(floatval($produto['preco']), 2, ',', '.') }}</strong>
                                                    @endif
                                                </p>

                                                <a href="{{ route('product.show', $produto['id']) }}"
                                                    class="btn btn-outline-dark w-100 mt-auto">Ver Produto</a>

                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="swiper-slide">
                                    <p class="text-center p-3">Nenhum produto encontrado para esta categoria.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <hr class="mt-3">
            @endforeach

        </div>
    </main>
@endsection
