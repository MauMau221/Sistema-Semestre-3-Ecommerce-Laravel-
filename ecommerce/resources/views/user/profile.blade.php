@extends('master')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Meus Dados</h2>
    
    <div class="row">
        <div class="col-md-3">
            <!-- Menu lateral -->
            <div class="list-group mb-4">
                <a href="{{ route('user.profile') }}" class="list-group-item list-group-item-action active">
                    <i class="fa-solid fa-user me-2"></i> Meus Dados
                </a>
                <a href="{{ route('user.addresses.index') }}" class="list-group-item list-group-item-action">
                    <i class="fa-solid fa-location-dot me-2"></i> Meus Endereços
                </a>
                <a href="{{ route('user.orders') }}" class="list-group-item list-group-item-action">
                    <i class="fa-solid fa-box me-2"></i> Meus Pedidos
                </a>
            </div>
        </div>
        
        <div class="col-md-9">
            <div class="card">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Informações Pessoais</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('user.update-profile') }}" method="POST">
                        @csrf
                        
                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <hr class="my-4">
                        
                        <h5 class="mb-3">Alterar Senha</h5>
                        <p class="text-muted small mb-3">Preencha os campos abaixo apenas se desejar alterar sua senha.</p>
                        
                        <div class="form-group mb-3">
                            <label for="current_password" class="form-label">Senha Atual</label>
                            <input type="password" class="form-control" id="current_password" name="current_password">
                            @error('current_password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="password" class="form-label">Nova Senha</label>
                            <input type="password" class="form-control" id="password" name="password">
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="form-group mb-4">
                            <label for="password_confirmation" class="form-label">Confirmar Nova Senha</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                        </div>
                        
                        <div class="d-grid">
                            <button type="submit" class="btn btn-dark btn-hover-scale">Salvar Alterações</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/user/profile.css') }}">
@endpush 