@extends('master')

@section('content')
    @include('nav.nav')

    @if (empty($itens))
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
                        <a href="#" class="position-absolute custom-position">
                        </a>
                        <img src="/css/image/categorias/catCamisas.png" class="card-img-top">
                    </div>
                </div>
                <div class="col-12 col-lg-4 col-md-4 col-sm-6
                my-2">
                    <div class="card text-center">
                        <a href="#" class="position-absolute custom-position">
                        </a>
                        <img src="/css/image/categorias/catCamisas1.png" class="card-img-top">
                    </div>
                </div>
                <div class="col-12 col-lg-4 col-md-4 col-sm-6
                my-2">
                    <div class="card text-center">
                        <a href="#" class="position-absolute custom-position">
                        </a>
                        <img src="/css/image/categorias/catCamisas2.png" class="card-img-top">
                    </div>
                </div>
                <div class="col-12 col-lg-4 col-md-4 col-sm-6
                my-2">
                    <div class="card text-center">
                        <a href="#" class="position-absolute custom-position">
                        </a>
                        <img src="/css/image/categorias/catCamisas3.png" class="card-img-top">
                    </div>
                </div>
                <div class="col-12 col-lg-4 col-md-4 col-sm-6
                my-2">
                    <div class="card text-center">
                        <a href="#" class="position-absolute custom-position">
                        </a>
                        <img src="/css/image/categorias/catCamisas4.png" class="card-img-top">
                    </div>
                </div>
                <div class="col-12 col-lg-4 col-md-4 col-sm-6
                my-2">
                    <div class="card text-center">
                        <a href="#" class="position-absolute custom-position">
                        </a>
                        <img src="/css/image/categorias/catCamisas5.png" class="card-img-top">
                    </div>
                </div>
            </div>
            <hr class="mt-3">

            <h3 class="p-4">Camisas</h3>

            <div class="container">
                <div class="d-flex justify-content-end m-2"> 
                    <div class="button-prev p-1"><i class="fa-solid fa-circle-chevron-right fa-flip-horizontal fa-2xl"></i></div>
                    <div class="button-next p-1"><i class="fa-solid fa-circle-chevron-right fa-2xl"></i></div>
                </div>
                <div class="swiper mySwiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="card-product">
                                <div class="image-container position-relative">
                                    <img src="/css/image/card/image.png" class="card-img-top">
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
                                    <h5 class="font-weight-bold">CAMISA SLIM TRICONE MAQUINETADA BRANCA</h5>
                                    <p class="card-price">
                                        <s>R$399,99</s>
                                        <strong>199,99</strong>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="card-product">
                                <div class="image-container position-relative">
                                    <img src="/css/image/card/image.png" class="card-img-top">
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
                                    <h5 class="font-weight-bold">CAMISA SLIM TRICONE MAQUINETADA BRANCA</h5>
                                    <p class="card-price">
                                        <s>R$399,99</s>
                                        <strong>199,99</strong>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="card-product">
                                <div class="image-container position-relative">
                                    <img src="/css/image/card/image.png" class="card-img-top">
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
                                    <h5 class="font-weight-bold">CAMISA SLIM TRICONE MAQUINETADA BRANCA</h5>
                                    <p class="card-price">
                                        <s>R$399,99</s>
                                        <strong>199,99</strong>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="card-product">
                                <div class="image-container position-relative">
                                    <img src="/css/image/card/image.png" class="card-img-top">
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
                                    <h5 class="font-weight-bold">CAMISA SLIM TRICONE MAQUINETADA BRANCA</h5>
                                    <p class="card-price">
                                        <s>R$399,99</s>
                                        <strong>199,99</strong>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="card-product">
                                <div class="image-container position-relative">
                                    <img src="/css/image/card/image.png" class="card-img-top">
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
                                    <h5 class="font-weight-bold">CAMISA SLIM TRICONE MAQUINETADA BRANCA</h5>
                                    <p class="card-price">
                                        <s>R$399,99</s>
                                        <strong>199,99</strong>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="card-product">
                                <div class="image-container position-relative">
                                    <img src="/css/image/card/image.png" class="card-img-top">
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
                                    <h5 class="font-weight-bold">CAMISA SLIM TRICONE MAQUINETADA BRANCA</h5>
                                    <p class="card-price">
                                        <s>R$399,99</s>
                                        <strong>199,99</strong>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="card-product">
                                <div class="image-container position-relative">
                                    <img src="/css/image/card/image.png" class="card-img-top">
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
                                    <h5 class="font-weight-bold">CAMISA SLIM TRICONE MAQUINETADA BRANCA</h5>
                                    <p class="card-price">
                                        <s>R$399,99</s>
                                        <strong>199,99</strong>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                @foreach ($itens as $item)
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 my-1">
                        <div class="card text-center bg-light">
                            <a href="#" class="position-absolute custom-position p-3 text-dark">
                                <i class="fa-regular fa-heart fa-2xl"></i>
                            </a>
                            <img src="/css/image/card/image.png" class="card-img-top">
                            <div class="card-header">
                                R${{ number_format($item['preco'], 2, ',', ',') }}
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $item['nome'] }}</h5>
                                <p class="card-text encurtar-3l">{{ $item['desc'] }}</p>
                            </div>
                            <div class="card-footer">
                                <form action="" class="d-block">
                                    <button class="btn btn-danger btn-sm">
                                        Adicionar ao Carrinho
                                    </button>
                                </form>
                                <small class="text-success">320,5kg em estoque</small>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <hr class="mt-3">
            <div class="row pb-4">
                <div class="col-12">
                    <div class="d-flex flex-row-reverse justify-content-center justify-content-md-start">
                        <form class="ml-3 d-inline-block">
                            <select class="form-select form-select-sm">
                                <option>Ordernar pelo nome</option>
                                <option>Ordernar pelo menor preço</option>
                                <option>Ordernar pelo maior preço</option>
                            </select>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    @include('footer.footer')
@endsection
