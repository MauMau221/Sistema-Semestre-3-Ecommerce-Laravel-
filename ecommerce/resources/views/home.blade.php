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
                <div class="col-12 col-lg-4 col-md-4 col-sm-6
                my-2">
                    <div class="card text-center">
                        <a href="{{ route('category.categorias', ['nome' => 'camisas']) }}" class="">
                            <img src="/css/image/categorias/catCamisas.png" class="card-img-top">
                        </a>
                    </div>
                </div>
                <div class="col-12 col-lg-4 col-md-4 col-sm-6
                my-2">
                    <div class="card text-center">
                        <a href="{{ route('category.categorias', ['nome' => 'camisetas']) }}" class="">
                            <img src="/css/image/categorias/catCamisas1.png" class="card-img-top">
                        </a>
                    </div>
                </div>
                <div class="col-12 col-lg-4 col-md-4 col-sm-6
                my-2">
                    <div class="card text-center">
                        <a href="{{ route('category.categorias', ['nome' => 'calcas']) }}" class="">
                            <img src="/css/image/categorias/catCamisas2.png" class="card-img-top">
                        </a>
                    </div>
                </div>
                <div class="col-12 col-lg-4 col-md-4 col-sm-6
                my-2">
                    <div class="card text-center">
                        <a href="{{ route('category.categorias', ['nome' => 'calcados']) }}" class="">
                            <img src="/css/image/categorias/catCamisas3.png" class="card-img-top">
                        </a>
                    </div>
                </div>
                <div class="col-12 col-lg-4 col-md-4 col-sm-6
                my-2">
                    <div class="card text-center">
                        <a href="{{ route('category.categorias', ['nome' => 'polos']) }}" class="">
                            <img src="/css/image/categorias/catCamisas4.png" class="card-img-top">
                        </a>
                    </div>
                </div>
                <div class="col-12 col-lg-4 col-md-4 col-sm-6
                my-2">
                    <div class="card text-center">
                        <a href="{{ route('category.categorias', ['nome' => 'jaquetas']) }}" class="">
                            <img src="/css/image/categorias/catCamisas5.png" class="card-img-top">
                        </a>
                    </div>
                </div>
            </div>
            <hr class="mt-3">

            <h3 class="p-4">Camisas</h3>

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
                                <div class="card-product">
                                    <div class="image-container position-relative">
                                        <img src="{{ $produto['url'] ?? asset('/css/image/card/image.png') }}" class="card-img-top">
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
                                            <s>R$399,99</s>
                                            <strong>R${{ $produto['preco'] }}</strong>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
            <hr class="mt-3">
        </div>
    </main>
@endsection
