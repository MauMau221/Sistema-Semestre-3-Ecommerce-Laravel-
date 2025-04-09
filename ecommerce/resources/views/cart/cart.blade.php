@extends('master')

@section('content')
    <section>
        <div class="container py-4">
            <h1 class="mb-4">FINALIZAR COMPRA</h1>

            <!-- Etapas do checkout -->
            <div class="checkout-steps mb-5">
                <div class="checkout-step active">
                    <div class="step-number">1</div>
                    <div class="step-text">CARRINHO</div>
                </div>
                <div class="checkout-step">
                    <div class="step-number">2</div>
                    <div class="step-text">IDENTIFICAÇÃO</div>
                </div>
                <div class="checkout-step">
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
                    <!-- Seção do carrinho -->
                    <div class="mb-5">
                        <h2 class="section-title">ITENS DO CARRINHO</h2>

                        <!-- Item do carrinho -->
                        @foreach ($cart as $produto)
                            <form action="/cart/remove" method="POST">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="produto_id" value="{{ $produto['id'] }}">
                                <div class="cart-item">
                                    <div class="row align-items-center">
                                        <div class="col-3 col-md-2">
                                            <img src="{{ $produto['url'] ?? asset('https://cdn-icons-png.flaticon.com/512/2071/2071149.png') }}"
                                                alt="Camiseta 1" class="product-thumbnail img-fluid">
                                        </div>
                                        <div class="col-9 col-md-4">
                                            <h5 class="mb-1">{{ $produto['nome'] }}</h5>
                                            <p class="text-muted mb-1">Tamanho: M | Cor: Azul</p>
                                            <p class="text-muted mb-0">Código: 8121423</p>
                                        </div>
                                        <div class="col-6 col-md-3 mt-3 mt-md-0">
                                            <div class="quantity-selector">
                                                <button class="quantity-btn" onclick="btnDiminuirQtd(event)">-</button>
                                                <input type="text" id="quantidade" name="quantidade"
                                                    class="quantity-input" value="{{ $produto['quantidade'] }}" readonly>
                                                <button class="quantity-btn" onclick="btnAumentarQtd(event)">+</button>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-3 mt-3 mt-md-0 text-end">
                                            <div class="fw-bold mb-1 product-price">R$
                                                {{ number_format($produto['preco'], 2, ',', '.') }}</div>
                                            <button type="submit"
                                                class="text-danger small btn-link-hover border-0 bg-transparent">Remover</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        @endforeach

                    </div>

                    <!-- Seção de cupom de desconto -->
                    <div class="mb-5">
                        <h2 class="section-title">CUPOM DE DESCONTO</h2>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Digite seu cupom">
                                    <button class="btn btn-dark" type="button">APLICAR</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Seção de frete -->
                    <div class="mb-5">
                        <h2 class="section-title">CALCULAR FRETE</h2>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Digite seu CEP">
                                    <button class="btn btn-dark" type="button">CALCULAR</button>
                                </div>
                                <div class="small mb-3">
                                    <a href="https://buscacepinter.correios.com.br/app/endereco/index.php" target="_blank"
                                        class="text-decoration-none text-dark">Não sei meu CEP</a>
                                </div>
                            </div>
                        </div>

                        <!-- Opções de frete após cálculo -->
                        <div class="mt-3">
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="shippingOption" id="sedex" checked>
                                <label class="form-check-label d-flex justify-content-between w-100" for="sedex">
                                    <span>SEDEX (2-3 dias úteis)</span>
                                    <span>R$ 25,90</span>
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="shippingOption" id="pac">
                                <label class="form-check-label d-flex justify-content-between w-100" for="pac">
                                    <span>PAC (5-8 dias úteis)</span>
                                    <span>R$ 18,50</span>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="shippingOption" id="freeShipping">
                                <label class="form-check-label d-flex justify-content-between w-100" for="freeShipping">
                                    <span>FRETE GRÁTIS (7-10 dias úteis)</span>
                                    <span>R$ 0,00</span>
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
