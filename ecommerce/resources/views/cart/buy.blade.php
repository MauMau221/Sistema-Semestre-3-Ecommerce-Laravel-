@extends('master')

@section('content')
    <section>
        <div class="container py-4">
            <h1 class="mb-4">FINALIZAR COMPRA</h1>

            <!-- Etapas do checkout -->
            <div class="checkout-steps mb-5">
                <div class="checkout-step">
                    <div class="step-number"><a href="/cart" class="text-dark">1</a></div>
                    <div class="step-text">CARRINHO</div>
                </div>
                <div class="checkout-step">
                    <div class="step-number"><a href="/cart/checkout" class="text-dark">2</a></div>
                    <div class="step-text">IDENTIFICAÇÃO</div>
                </div>
                <div class="checkout-step active">
                    <div class="step-number">3</div>
                    <div class="step-text">PAGAMENTO</div>
                </div>
                <div class="checkout-step">
                    <div class="step-number">4</div>
                    <div class="step-text">CONFIRMAÇÃO</div>
                </div>
            </div>

            <div class="row">
                <!-- Coluna da esquerda - Itens do carrinho e formulários -->
                <div class="col-lg-8">

                    <!-- Seção de pagamento -->
                    <div class="mb-5">
                        <h2 class="section-title">FORMA DE PAGAMENTO</h2>

                        <!-- Opções de pagamento -->
                        <div class="payment-method selected mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="paymentMethod" id="creditCard" checked>
                                <label class="form-check-label fw-bold" for="creditCard">
                                    Cartão de Crédito
                                </label>
                            </div>

                            <!-- Formulário de cartão de crédito -->
                            <div class="mt-3">
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <label for="cardNumber" class="form-label">Número do Cartão*</label>
                                        <input type="text" class="form-control" id="cardNumber" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="cardName" class="form-label">Nome no Cartão*</label>
                                        <input type="text" class="form-control" id="cardName" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="expiryDate" class="form-label">Validade*</label>
                                        <input type="text" class="form-control" id="expiryDate" placeholder="MM/AA"
                                            required>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="cvv" class="form-label">CVV*</label>
                                        <input type="text" class="form-control" id="cvv" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="installments" class="form-label">Parcelamento*</label>
                                        <select class="form-select" id="installments" required>
                                            <option>1x de R$ 615,70 sem juros</option>
                                            <option>2x de R$ 307,85 sem juros</option>
                                            <option>3x de R$ 205,23 sem juros</option>
                                            <option>4x de R$ 153,92 sem juros</option>
                                            <option>5x de R$ 123,14 sem juros</option>
                                            <option>6x de R$ 102,62 sem juros</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="payment-method mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="paymentMethod" id="pix">
                                <label class="form-check-label fw-bold" for="pix">
                                    PIX (5% de desconto)
                                </label>
                            </div>
                        </div>

                        <div class="payment-method mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="paymentMethod" id="boleto">
                                <label class="form-check-label fw-bold" for="boleto">
                                    Boleto Bancário (3% de desconto)
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Coluna da direita - Resumo do pedido -->
                <div class="col-lg-4">
                    <div class="order-summary">
                        <h3 class="mb-4">RESUMO DO PEDIDO</h3>

                        <div class="summary-item">
                            <span>Subtotal ({{ count($cart) }} itens)</span>
                            <span>R$ {{ number_format($total, 2, ',', '.') }}</span>
                        </div>
                        <div class="summary-item">
                            <span>Frete</span>
                            <span>R$ 25,90</span>
                        </div>
                        <div class="summary-item">
                            <span>Desconto</span>
                            <span>R$ 0,00</span>
                        </div>
                        <div class="summary-item summary-total">
                            <span>Total</span>
                            <span>R$ 615,70</span>
                        </div>

                        <div class="mt-4">
                            <div class="text-muted mb-2 small">ou 6x de R$ {{ number_format($total / 6, 2, ',', '.') }} sem
                                juros</div>
                            <a href="{{ route('cart.checkout') }}" class=" btn btn-dark checkout-btn mb-3">FINALIZAR
                                COMPRA</a>
                            <a href="{{ route('cart.checkout') }}" class="btn btn-light checkout-btn bg-light text-dark">
                                VOLTAR
                            </a>
                            <div class="secure-checkout">
                                <i class="bi bi-lock-fill"></i>
                                <span>Pagamento 100% seguro</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
