@extends('master')

@section('content')
    <section>
        <div class="container py-5">
            <div class="row">
                <!-- Cart Items Section -->
                <div class="col-lg-8 mb-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4">
                            <div class="cart-header d-flex justify-content-between align-items-center">
                                <h2 class="h4 mb-0">Meu Carrinho</h2>
                                <span class="text-muted">3 itens</span>
                            </div>

                            <!-- Cart Item 1 -->
                            <div class="row mb-4 pb-3 border-bottom">
                                <div class="col-md-2 col-4 mb-3 mb-md-0">
                                    <img src="/api/placeholder/100/120" alt="Produto" class="cart-item-img img-fluid">
                                </div>
                                <div class="col-md-10 col-8">
                                    <div class="d-flex justify-content-between mb-2">
                                        <div>
                                            <h3 class="product-title">Camisa Casual Listrada</h3>
                                            <p class="product-code mb-1">Código: AR2023001</p>
                                            <p class="product-size mb-2">Tamanho: M | Cor: Azul</p>
                                        </div>
                                        <div class="d-none d-md-block">
                                            <span class="remove-item"><i class="fas fa-times"></i></span>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center">
                                            <div class="input-group qty-selector me-3">
                                                <button class="btn btn-outline-secondary" type="button">-</button>
                                                <input type="text" class="form-control text-center" value="1">
                                                <button class="btn btn-outline-secondary" type="button">+</button>
                                            </div>
                                            <div class="d-md-none">
                                                <span class="remove-item"><i class="fas fa-times"></i></span>
                                            </div>
                                        </div>
                                        <div class="product-price">R$ 299,90</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Cart Item 2 -->
                            <div class="row mb-4 pb-3 border-bottom">
                                <div class="col-md-2 col-4 mb-3 mb-md-0">
                                    <img src="/api/placeholder/100/120" alt="Produto" class="cart-item-img img-fluid">
                                </div>
                                <div class="col-md-10 col-8">
                                    <div class="d-flex justify-content-between mb-2">
                                        <div>
                                            <h3 class="product-title">Calça Jeans Slim</h3>
                                            <p class="product-code mb-1">Código: AR2023002</p>
                                            <p class="product-size mb-2">Tamanho: 42 | Cor: Azul Escuro</p>
                                        </div>
                                        <div class="d-none d-md-block">
                                            <span class="remove-item"><i class="fas fa-times"></i></span>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center">
                                            <div class="input-group qty-selector me-3">
                                                <button class="btn btn-outline-secondary" type="button">-</button>
                                                <input type="text" class="form-control text-center" value="1">
                                                <button class="btn btn-outline-secondary" type="button">+</button>
                                            </div>
                                            <div class="d-md-none">
                                                <span class="remove-item"><i class="fas fa-times"></i></span>
                                            </div>
                                        </div>
                                        <div class="product-price">R$ 359,90</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Cart Item 3 -->
                            <div class="row">
                                <div class="col-md-2 col-4 mb-3 mb-md-0">
                                    <img src="/api/placeholder/100/120" alt="Produto" class="cart-item-img img-fluid">
                                </div>
                                <div class="col-md-10 col-8">
                                    <div class="d-flex justify-content-between mb-2">
                                        <div>
                                            <h3 class="product-title">Blazer Slim Fit</h3>
                                            <p class="product-code mb-1">Código: AR2023003</p>
                                            <p class="product-size mb-2">Tamanho: 50 | Cor: Preto</p>
                                        </div>
                                        <div class="d-none d-md-block">
                                            <span class="remove-item"><i class="fas fa-times"></i></span>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center">
                                            <div class="input-group qty-selector me-3">
                                                <button class="btn btn-outline-secondary" type="button">-</button>
                                                <input type="text" class="form-control text-center" value="1">
                                                <button class="btn btn-outline-secondary" type="button">+</button>
                                            </div>
                                            <div class="d-md-none">
                                                <span class="remove-item"><i class="fas fa-times"></i></span>
                                            </div>
                                        </div>
                                        <div class="product-price">R$ 599,90</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order Summary Section -->
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body p-4">
                            <h3 class="h5 mb-4">Resumo do Pedido</h3>

                            <!-- Shipping Calculator -->
                            <div class="mb-4">
                                <h4 class="h6 mb-3">Calcular Frete</h4>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Digite seu CEP" maxlength="9"
                                        id="cep-input">
                                    <button class="btn btn-dark" type="button" id="calc-shipping">Calcular</button>
                                </div>
                                <div class="mt-1">
                                    <small><a href="https://buscacepinter.correios.com.br/app/endereco/index.php"
                                            target="_blank" class="text-decoration-none">Não sei meu CEP</a></small>
                                </div>

                                <!-- Shipping options (initially hidden, will be shown via JS) -->
                                <div class="shipping-options mt-3" id="shipping-options" style="display: none;">
                                    <div class="shipping-option d-flex justify-content-between align-items-center">
                                        <div>
                                            <input type="radio" name="shipping" id="shipping1" class="shipping-radio"
                                                checked>
                                            <label for="shipping1">Entrega Padrão (7-10 dias úteis)</label>
                                        </div>
                                        <span class="text-success">Grátis</span>
                                    </div>
                                    <div class="shipping-option d-flex justify-content-between align-items-center">
                                        <div>
                                            <input type="radio" name="shipping" id="shipping2" class="shipping-radio">
                                            <label for="shipping2">Entrega Expressa (3-5 dias úteis)</label>
                                        </div>
                                        <span>R$ 19,90</span>
                                    </div>
                                    <div class="shipping-option d-flex justify-content-between align-items-center">
                                        <div>
                                            <input type="radio" name="shipping" id="shipping3" class="shipping-radio">
                                            <label for="shipping3">Entrega Rápida (1-2 dias úteis)</label>
                                        </div>
                                        <span>R$ 39,90</span>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between mb-2">
                                <span>Subtotal</span>
                                <span>R$ 1.259,70</span>
                            </div>

                            <div class="d-flex justify-content-between mb-2">
                                <span>Frete</span>
                                <span class="shipping-cost text-success">Grátis</span>
                            </div>

                            <hr>

                            <div class="d-flex justify-content-between mb-4">
                                <span class="fw-bold">Total</span>
                                <span class="fw-bold total-amount">R$ 1.259,70</span>
                            </div>

                            <div class="input-group mb-3">
                                <input type="text" class="form-control promo-input" placeholder="Cupom de desconto">
                                <button class="btn btn-outline-secondary promo-button" type="button">Aplicar</button>
                            </div>

                            <button class="btn btn-dark w-100 checkout-btn py-3">Finalizar Compra</button>
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4">
                            <h3 class="h5 mb-3">Formas de Pagamento</h3>
                            <div class="d-flex flex-wrap gap-2 mb-3">
                                <img src="/api/placeholder/40/25" alt="Visa" class="payment-icon">
                                <img src="/api/placeholder/40/25" alt="Mastercard" class="payment-icon">
                                <img src="/api/placeholder/40/25" alt="American Express" class="payment-icon">
                                <img src="/api/placeholder/40/25" alt="Elo" class="payment-icon">
                                <img src="/api/placeholder/40/25" alt="Boleto" class="payment-icon">
                                <img src="/api/placeholder/40/25" alt="Pix" class="payment-icon">
                            </div>
                            <p class="text-muted small mb-0">Compra segura. Criptografia SSL.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
