@extends('master')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Meus Pedidos</h2>
    
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
                <a href="{{ route('user.orders') }}" class="list-group-item list-group-item-action active">
                    <i class="fa-solid fa-box me-2"></i> Meus Pedidos
                </a>
            </div>
        </div>
        
        <div class="col-md-9">
            <div class="card">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Histórico de Pedidos</h5>
                </div>
                <div class="card-body p-0">
                    @if($pedidos->isEmpty())
                        <div class="text-center py-5">
                            <i class="fa-solid fa-box-open fa-4x text-muted mb-3"></i>
                            <h5>Você ainda não tem pedidos</h5>
                            <p class="text-muted">Seus pedidos aparecerão aqui quando você fizer compras em nossa loja.</p>
                            <a href="{{ route('home.home') }}" class="btn btn-dark mt-3 btn-hover-scale">Começar a Comprar</a>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Pedido</th>
                                        <th>Data</th>
                                        <th>Status</th>
                                        <th>Total</th>
                                        <th>Detalhes</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pedidos as $pedido)
                                    <tr>
                                        <td>#{{ $pedido->id }}</td>
                                        <td>{{ $pedido->created_at->format('d/m/Y') }}</td>
                                        <td>
                                            @if($pedido->status)
                                                <span class="badge bg-{{ $pedido->status->id == 1 ? 'warning' : ($pedido->status->id == 2 ? 'info' : ($pedido->status->id == 3 ? 'success' : 'secondary')) }} text-white">
                                                    {{ $pedido->status->nome ?? 'Processando' }}
                                                </span>
                                            @else
                                                <span class="badge bg-secondary text-white">Processando</span>
                                            @endif
                                        </td>
                                        <td>R$ {{ number_format($pedido->total, 2, ',', '.') }}</td>
                                        <td>
                                            <a href="{{ route('user.order-details', $pedido->id) }}" class="btn btn-sm btn-outline-dark">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
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