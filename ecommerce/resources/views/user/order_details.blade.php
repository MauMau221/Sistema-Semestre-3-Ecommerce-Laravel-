@extends('master')

@section('content')
<div class="container py-4">
    <div class="mb-4">
        <a href="{{ route('user.orders') }}" class="text-decoration-none text-dark">
            <i class="fa-solid fa-arrow-left me-2"></i> Voltar para meus pedidos
        </a>
    </div>
    
    <h2 class="mb-4">Detalhes do Pedido #{{ $pedido->id }}</h2>
    
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
            
            <div class="card mb-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Resumo</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-2">
                        <span>Data:</span>
                        <strong>{{ $pedido->created_at->format('d/m/Y') }}</strong>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Status:</span>
                        <span>
                            @if($pedido->status)
                                <span class="badge bg-{{ $pedido->status->id == 1 ? 'warning' : ($pedido->status->id == 2 ? 'info' : ($pedido->status->id == 3 ? 'success' : 'secondary')) }} text-white">
                                    {{ $pedido->status->nome ?? 'Processando' }}
                                </span>
                            @else
                                <span class="badge bg-secondary text-white">Processando</span>
                            @endif
                        </span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Total:</span>
                        <strong>R$ {{ number_format($pedido->total, 2, ',', '.') }}</strong>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-9">
            <div class="card">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Itens do Pedido</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Produto</th>
                                    <th>Preço</th>
                                    <th>Qtd</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pedido->itens as $item)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @php
                                                $produto = $item->produto;
                                                $imagemProduto = "/css/image/card/camisa{$produto->id}.jpg";
                                                $imagemPadrao = "/css/image/card/image" . rand(1, 5) . ".png";
                                                $imagem = file_exists(public_path($imagemProduto)) ? $imagemProduto : $imagemPadrao;
                                            @endphp
                                            <img src="{{ asset($imagem) }}" class="me-3" alt="{{ $item->produto->nome ?? 'Produto' }}" style="width: 50px; height: 50px; object-fit: cover;">
                                            <div>
                                                <h6 class="mb-0">{{ $item->produto->nome ?? 'Produto não disponível' }}</h6>
                                                @if(isset($item->cor) || isset($item->tamanho))
                                                <small class="text-muted">
                                                    @if(isset($item->cor)) Cor: {{ $item->cor }} @endif
                                                    @if(isset($item->cor) && isset($item->tamanho)) | @endif
                                                    @if(isset($item->tamanho)) Tam: {{ $item->tamanho }} @endif
                                                </small>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td>R$ {{ number_format($item->preco_unitario, 2, ',', '.') }}</td>
                                    <td>{{ $item->quantidade }}</td>
                                    <td>R$ {{ number_format($item->subtotal, 2, ',', '.') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="table-light">
                                <tr>
                                    <td colspan="3" class="text-end"><strong>Total:</strong></td>
                                    <td><strong>R$ {{ number_format($pedido->total, 2, ',', '.') }}</strong></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            
            <!-- Histórico de status (opcional, pode ser implementado futuramente) -->
            <!--
            <div class="card mt-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Histórico de Status</h5>
                </div>
                <div class="card-body">
                    <ul class="timeline">
                        <li class="timeline-item">
                            <div class="timeline-marker"></div>
                            <div class="timeline-content">
                                <h3 class="timeline-title">Pedido Realizado</h3>
                                <p>{{ $pedido->created_at->format('d/m/Y H:i') }}</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            -->
        </div>
    </div>
</div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/user/profile.css') }}">
@endpush 