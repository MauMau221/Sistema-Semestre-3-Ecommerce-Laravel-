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
                            <img src="{{ asset('storage/image/categorias/catCamisas.png') }}" class="card-img-top">
                        </a>
                    </div>
                </div>
                <div class="col-6 col-lg-4 col-md-4 col-sm-6
                my-2">
                    <div class="card text-center">
                        <a href="{{ route('category.categorias', ['nome' => 'camisetas']) }}" class="">
                            <img src="{{ asset('storage/image/categorias/catCamisas1.png') }}" class="card-img-top">
                        </a>
                    </div>
                </div>
                <div class="col-6 col-lg-4 col-md-4 col-sm-6
                my-2">
                    <div class="card text-center">
                        <a href="{{ route('category.categorias', ['nome' => 'calcas']) }}" class="">
                            <img src="{{ asset('storage/image/categorias/catCamisas2.png') }}" class="card-img-top">
                        </a>
                    </div>
                </div>
                <div class="col-6 col-lg-4 col-md-4 col-sm-6
                my-2">
                    <div class="card text-center">
                        <a href="{{ route('category.categorias', ['nome' => 'calcados']) }}" class="">
                            <img src="{{ asset('storage/image/categorias/catCamisas3.png') }}" class="card-img-top">
                        </a>
                    </div>
                </div>
                <div class="col-6 col-lg-4 col-md-4 col-sm-6
                my-2">
                    <div class="card text-center">
                        <a href="{{ route('category.categorias', ['nome' => 'polos']) }}" class="">
                            <img src="{{ asset('storage/image/categorias/catCamisas4.png') }}" class="card-img-top">
                        </a>
                    </div>
                </div>
                <div class="col-6 col-lg-4 col-md-4 col-sm-6
                my-2">
                    <div class="card text-center">
                        <a href="{{ route('category.categorias', ['nome' => 'jaquetas']) }}" class="">
                            <img src="{{ asset('storage/image/categorias/catCamisas5.png') }}" class="card-img-top">
                        </a>
                    </div>
                </div>
            </div>
            <hr class="mt-3">

            @foreach($produtosPorCategoria as $categoria => $dados)
                <h3 class="p-4">{{ $dados['nome'] }}</h3>

                <div class="container">
                    <div class="d-flex justify-content-end m-2">
                        <div class="button-prev-{{ $categoria }} p-2"><i class="fa-solid fa-circle-chevron-right fa-flip-horizontal fa-2xl"></i></div>
                        <div class="button-next-{{ $categoria }} p-2"><i class="fa-solid fa-circle-chevron-right fa-2xl"></i></div>
                    </div>
                    <div class="swiper mySwiper-{{ $categoria }}">
                        <div class="swiper-wrapper">
                            @foreach ($dados['produtos'] as $produto)
                                <div class="swiper-slide">
                                    <div class="card-product position-relative">
                                        <a href="{{ route('product.show', $produto['id']) }}"
                                            class="text-decoration-none text-dark">
                                            <div class="image-container">
                                                @php
                                                    if (!empty($produto->url)) {
                                                        $imagem = "storage/" . $produto->url;
                                                    } else {
                                                        $imagem = "storage/image/cards/" . $categoria . "/" . $produto['id'] . ".jpg";
                                                        if (!file_exists(public_path($imagem))) {
                                                            $imagem = "/css/image/card/image" . rand(1, 5) . ".png";
                                                        }
                                                    }
                                                @endphp
                                                <img src="{{ asset($imagem) }}" class="card-img-top">
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
                                                    <s>R${{ number_format($produto['preco'] + 99.99, 2, ',', '.') }}</s>
                                                    <strong>R${{ number_format($produto['preco'], 2, ',', '.') }}</strong>
                                                </p>
                                            </div>
                                        </a>

                                        <div class="cart-icon">
                                            <a href="{{ route('product.show', $produto['id']) }}" class="text-decoration-none">
                                                <i class="fa-solid fa-bag-shopping fa-xl" style="color: rgb(93, 92, 92); cursor: pointer;"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <hr class="mt-3">
            @endforeach

            <!-- Seção de fallback para manter compatibilidade -->
            @if(empty($produtosPorCategoria))
                <h3 class="p-4">Produtos em Destaque</h3>

                <div class="container">
                    <div class="d-flex justify-content-end m-2">
                        <div class="button-prev p-2"><i class="fa-solid fa-circle-chevron-right fa-flip-horizontal fa-2xl"></i>
                        </div>
                        <div class="button-next p-2"><i class="fa-solid fa-circle-chevron-right fa-2xl"></i></div>
                    </div>
                    <div class="swiper mySwiper">
                        <div class="swiper-wrapper">
                            @foreach ($produtos as $produto)
                                <div class="swiper-slide">
                                    <div class="card-product position-relative">
                                        <a href="{{ route('product.show', $produto['id']) }}"
                                            class="text-decoration-none text-dark">
                                            <div class="image-container">
                                                @php
                                                    if (!empty($produto->url)) {
                                                        $imagem = "storage/" . $produto->url;
                                                    } else {
                                                        $imagem = "storage/image/cards/camisas" . $produto['id'] . ".jpg";
                                                        if (!file_exists(public_path($imagem))) {
                                                            $imagem = "/css/image/card/image" . rand(1, 5) . ".png";
                                                        }
                                                    }
                                                @endphp
                                                <img src="{{ asset($imagem) }}" class="card-img-top">
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
                                                    <s>R${{ number_format($produto['preco'] + 99.99, 2, ',', '.') }}</s>
                                                    <strong>R${{ number_format($produto['preco'], 2, ',', '.') }}</strong>
                                                </p>
                                            </div>
                                        </a>

                                        <div class="cart-icon">
                                            <a href="{{ route('product.show', $produto['id']) }}" class="text-decoration-none">
                                                <i class="fa-solid fa-bag-shopping fa-xl" style="color: rgb(93, 92, 92); cursor: pointer;"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </main>
@endsection

@push('scripts')
<script>
    // Passando as categorias para o JavaScript global
    window.categorias = {!! json_encode(array_keys($produtosPorCategoria ?? [])) !!};
</script>
@endpush
