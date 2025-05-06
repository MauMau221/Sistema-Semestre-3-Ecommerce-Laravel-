@extends('master')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Meus Endereços</h2>
    
    <div class="row">
        <div class="col-md-3">
            <!-- Menu lateral -->
            <div class="list-group mb-4">
                <a href="{{ route('user.profile') }}" class="list-group-item list-group-item-action">
                    <i class="fa-solid fa-user me-2"></i> Meus Dados
                </a>
                <a href="{{ route('user.addresses.index') }}" class="list-group-item list-group-item-action active">
                    <i class="fa-solid fa-location-dot me-2"></i> Meus Endereços
                </a>
                <a href="{{ route('user.orders') }}" class="list-group-item list-group-item-action">
                    <i class="fa-solid fa-box me-2"></i> Meus Pedidos
                </a>
                <a href="{{ route('user.favorites') }}" class="list-group-item list-group-item-action">
                    <i class="fa-solid fa-heart me-2"></i> Meus Favoritos
                </a>
            </div>
        </div>
        
        <div class="col-md-9">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            
            <div class="card">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Endereços Cadastrados</h5>
                    <a href="{{ route('user.addresses.create') }}" class="btn btn-dark btn-sm">
                        <i class="fa-solid fa-plus me-1"></i> Novo Endereço
                    </a>
                </div>
                <div class="card-body">
                    @if($addresses->isEmpty())
                        <div class="text-center py-4">
                            <div class="mb-3">
                                <i class="fa-solid fa-location-dot fa-3x text-muted"></i>
                            </div>
                            <p class="text-muted mb-3">Você ainda não possui endereços cadastrados.</p>
                            <a href="{{ route('user.addresses.create') }}" class="btn btn-dark">
                                <i class="fa-solid fa-plus me-1"></i> Adicionar Endereço
                            </a>
                        </div>
                    @else
                        <div class="row row-cols-1 row-cols-md-2 g-3">
                            @foreach($addresses as $address)
                                <div class="col">
                                    <div class="card h-100 {{ $address->endereco_principal ? 'border-dark' : 'border' }}">
                                        <div class="card-body">
                                            <h6 class="card-title d-flex justify-content-between align-items-center">
                                                {{ $address->logradouro }}, {{ $address->numero }}
                                                @if($address->endereco_principal)
                                                    <span class="badge bg-dark">Principal</span>
                                                @endif
                                            </h6>
                                            <p class="card-text mb-1">
                                                @if($address->complemento)
                                                    Complemento: {{ $address->complemento }}<br>
                                                @endif
                                                {{ $address->bairro }}<br>
                                                {{ $address->cidade }} - {{ $address->estado }}<br>
                                                CEP: {{ $address->cep }}
                                            </p>
                                        </div>
                                        <div class="card-footer bg-white d-flex justify-content-between border-top">
                                            <div>
                                                <a href="{{ route('user.addresses.edit', $address->id) }}" class="btn btn-sm btn-outline-dark me-1">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </a>
                                                <form action="{{ route('user.addresses.destroy', $address->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Tem certeza que deseja excluir este endereço?')">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                            @if(!$address->endereco_principal)
                                                <form action="{{ route('user.addresses.set-main', $address->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-dark">Definir como Principal</button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 