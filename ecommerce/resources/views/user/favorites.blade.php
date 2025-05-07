@extends('master')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Meus Favoritos</h2>
    
    <div class="row">
        <div class="col-md-3">
            <!-- Menu lateral -->
            <div class="list-group mb-4">
                <a href="{{ route('user.profile') }}" class="list-group-item list-group-item-action">
                    <i class="fa-solid fa-user me-2"></i> Meus Dados
                </a>
                <a href="{{ route('user.addresses.index') }}" class="list-group-item list-group-item-action">
                    <i class="fa-solid fa-location-dot me-2"></i> Meus Endereços
                </a>
                <a href="{{ route('user.orders') }}" class="list-group-item list-group-item-action">
                    <i class="fa-solid fa-box me-2"></i> Meus Pedidos
                </a>
                <a href="{{ route('user.favorites') }}" class="list-group-item list-group-item-action active">
                    <i class="fa-solid fa-heart me-2"></i> Meus Favoritos
                </a>
            </div>
        </div>
        
        <div class="col-md-9">
            <div class="card">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Produtos Favoritos</h5>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($favorites->count() > 0)
                        <div class="row g-2">
                            @foreach($favorites as $produto)
                                <div class="col-6 col-md-4 col-lg-3 mb-3">
                                    <div class="card h-100 border rounded overflow-hidden">
                                        <div class="position-relative">
                                            @php
                                                $imagemProduto = "/css/image/card/camisa{$produto->id}.jpg";
                                                $imagemPadrao = "/css/image/card/image" . rand(1, 5) . ".png";
                                                $imagem = file_exists(public_path($imagemProduto)) ? $imagemProduto : $imagemPadrao;
                                                $desconto = rand(10, 30);
                                            @endphp
                                            <!-- Container da imagem e da tarja -->
                                            <div style="height: 140px; background-color: #f8f9fa; position: relative;">
                                                <div style="height: 100%; display: flex; align-items: center; justify-content: center;">
                                                    <img src="{{ asset($imagem) }}" alt="{{ $produto->nome }}" style="max-height: 140px; max-width: 100%; object-fit: contain;">
                                                </div>
                                                <!-- Tarja de desconto dentro da imagem -->
                                                <div class="position-absolute top-0 start-0 bg-danger text-white px-2 py-1"
                                                     style="font-size: 0.75rem; border-top-left-radius: 4px; border-bottom-right-radius: 8px; z-index:2; min-width: 48px; text-align: center;">
                                                    -{{ $desconto }}%
                                                </div>
                                                <!-- Ícone para remover dos favoritos no canto inferior direito -->
                                                <form action="{{ route('favorites.remove') }}" method="POST" class="position-absolute" style="right: 0; bottom: 0; margin: 0.25rem; z-index:2;">
                                                    @csrf
                                                    <input type="hidden" name="produto_id" value="{{ $produto->id }}">
                                                    <button type="submit" class="btn btn-sm btn-light rounded-circle" style="width: 30px; height: 30px; padding: 0; line-height: 30px;">
                                                        <i class="fa-solid fa-heart text-danger"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                        
                                        <div class="card-body p-2 d-flex flex-column">
                                            <h6 class="card-title mb-1" style="font-size: 0.9rem; font-weight: 500; line-height: 1.2; height: 2.4em; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
                                                <a href="{{ route('product.show', $produto->id) }}" class="text-decoration-none text-dark">{{ $produto->nome }}</a>
                                            </h6>
                                            <p class="text-muted mb-1" style="font-size: 0.75rem; height: 1.5em; overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">
                                                {{ Str::limit($produto->desc, 50) }}
                                            </p>
                                            <div class="d-flex align-items-center mb-1">
                                                <span class="fw-bold text-dark">R$ {{ number_format($produto->preco, 2, ',', '.') }}</span>
                                                <small class="text-muted text-decoration-line-through ms-2">R$ {{ number_format($produto->preco * (1 + $desconto/100), 2, ',', '.') }}</small>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <small class="bg-light text-muted px-1 rounded" style="font-size: 0.7rem;">
                                                    {{ rand(100, 999) }} vendidos
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="d-flex justify-content-center mt-4">
                            {{ $favorites->links() }}
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fa-solid fa-heart-crack fa-4x text-muted mb-3"></i>
                            <h5 class="text-muted">Você ainda não tem produtos favoritos.</h5>
                            <p class="text-muted">Explore nossos produtos e adicione itens aos favoritos clicando no ícone de coração.</p>
                            <a href="{{ route('home.home') }}" class="btn btn-primary mt-3">
                                <i class="fa-solid fa-shopping-bag"></i> Ir às compras
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/user/profile.css') }}">
@endpush 