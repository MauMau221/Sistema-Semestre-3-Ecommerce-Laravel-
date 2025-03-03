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
            <div class="row justify-content-center">
                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6
                my-2">
                    <div class="card text-center bg-light">
                        <a href="#" class="position-absolute custom-position p-3 text-dark">
                        </a>
                        <img src="/css/image/categorias/catCamisas.png" class="card-img-top">
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6
                my-2">
                    <div class="card text-center bg-light">
                        <a href="#" class="position-absolute custom-position p-3 text-dark">
                        </a>
                        <img src="/css/image/categorias/catCamisas1.png" class="card-img-top">
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6
                my-2">
                    <div class="card text-center bg-light">
                        <a href="#" class="position-absolute custom-position p-3 text-dark">
                        </a>
                        <img src="/css/image/categorias/catCamisas2.png" class="card-img-top">
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6
                my-2">
                    <div class="card text-center bg-light">
                        <a href="#" class="position-absolute custom-position p-3 text-dark">
                        </a>
                        <img src="/css/image/categorias/catCamisas3.png" class="card-img-top">
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6
                my-2">
                    <div class="card text-center bg-light">
                        <a href="#" class="position-absolute custom-position p-3 text-dark">
                        </a>
                        <img src="/css/image/categorias/catCamisas4.png" class="card-img-top">
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6
                my-2">
                    <div class="card text-center bg-light">
                        <a href="#" class="position-absolute custom-position p-3 text-dark">
                        </a>
                        <img src="/css/image/categorias/catCamisas5.png" class="card-img-top">
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6
                my-2">
                    <div class="card text-center bg-light">
                        <a href="#" class="position-absolute custom-position p-3 text-dark">
                        </a>
                        <img src="/css/image/categorias/catCamisas6.png" class="card-img-top">
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6
                my-2">
                    <div class="card text-center bg-light">
                        <a href="#" class="position-absolute custom-position p-3 text-dark">
                        </a>
                        <img src="/css/image/categorias/catCamisas7.png" class="card-img-top">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-md-5">
                    <form action="" class="justify-content-center justify-content-md-start mb-3 mb-md-0">
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control" placeholder="Digite o que procura">
                            <button class="interactive-button btn btn-dark btn-sm btn-sm">
                                Buscar
                            </button>
                        </div>
                    </form>
                </div>
                <div class="col-12 col-md-7">
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
            <hr class="mt-3">
            <div class="row justify-content-center">
                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6
                my-2">
                    <div class="card text-center bg-light">
                        <a href="#" class="position-absolute custom-position p-3 text-dark">
                            <i class="fa-regular fa-heart fa-2xl"></i>
                        </a>
                        <img src="/css/image/card/image.png" class="card-img-top">
                        <div class="card-header">
                            R$4,50
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Um produto qualquer</h5>
                            <p class="card-text encurtar-3l">Descrição meramente para distração e sem contexto algum</p>
                        </div>
                        <div class="card-footer">
                            <div>
                                <button class="btn btn-light">
                                    <small>Adicionar ao carrinho</small>
                                </button>
                            </div>
                            <small class="text-success">32 Unidades</small>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6
                my-2">
                    <div class="card text-center bg-light">
                        <a href="#" class="position-absolute custom-position p-3 text-dark">
                            <i class="fa-regular fa-heart fa-2xl"></i>
                        </a>
                        <img src="/css/image/card/image.png" class="card-img-top">
                        <div class="card-header">
                            R$4,50
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Um produto qualquer</h5>
                            <p class="card-text encurtar-3l">Descrição meramente para distração e sem contexto algum</p>
                        </div>
                        <div class="card-footer">
                            <div>
                                <button class="btn btn-light">
                                    <small>Adicionar ao carrinho</small>
                                </button>
                            </div>
                            <small class="text-success">32 Unidades</small>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6
                my-2">
                    <div class="card text-center bg-light">
                        <a href="#" class="position-absolute custom-position p-3 text-dark">
                            <i class="fa-regular fa-heart fa-2xl"></i>
                        </a>
                        <img src="/css/image/card/image.png" class="card-img-top">
                        <div class="card-header">
                            R$4,50
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Um produto qualquer</h5>
                            <p class="card-text encurtar-3l">Descrição meramente para distração e sem contexto algum</p>
                        </div>
                        <div class="card-footer">
                            <div>
                                <button class="btn btn-light">
                                    <small>Adicionar ao carrinho</small>
                                </button>
                            </div>
                            <small class="text-success">32 Unidades</small>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6
                my-2">
                    <div class="card text-center bg-light">
                        <a href="#" class="position-absolute custom-position p-3 text-dark">
                            <i class="fa-regular fa-heart fa-2xl"></i>
                        </a>
                        <img src="/css/image/card/image.png" class="card-img-top">
                        <div class="card-header">
                            R$4,50
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Um produto qualquer</h5>
                            <p class="card-text encurtar-3l">Descrição meramente para distração e sem contexto algum</p>
                        </div>
                        <div class="card-footer">
                            <div>
                                <button class="btn btn-light">
                                    <small>Adicionar ao carrinho</small>
                                </button>
                            </div>
                            <small class="text-success">32 Unidades</small>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6
                my-2">
                    <div class="card text-center bg-light">
                        <a href="#" class="position-absolute custom-position p-3 text-dark">
                            <i class="fa-regular fa-heart fa-2xl"></i>
                        </a>
                        <img src="/css/image/card/image.png" class="card-img-top">
                        <div class="card-header">
                            R$4,50
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Um produto qualquer</h5>
                            <p class="card-text encurtar-3l">Descrição meramente para distração e sem contexto algum</p>
                        </div>
                        <div class="card-footer">
                            <div>
                                <button class="btn btn-light">
                                    <small>Adicionar ao carrinho</small>
                                </button>
                            </div>
                            <small class="text-success">32 Unidades</small>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6
                my-2">
                    <div class="card text-center bg-light">
                        <a href="#" class="position-absolute custom-position p-3 text-dark">
                            <i class="fa-regular fa-heart fa-2xl"></i>
                        </a>
                        <img src="/css/image/card/image.png" class="card-img-top">
                        <div class="card-header">
                            R$4,50
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Um produto qualquer</h5>
                            <p class="card-text encurtar-3l">Descrição meramente para distração e sem contexto algum
                            </p>
                        </div>
                        <div class="card-footer">
                            <div>
                                <button class="btn btn-light">
                                    <small>Adicionar ao carrinho</small>
                                </button>
                            </div>
                            <small class="text-success">32 Unidades</small>
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
