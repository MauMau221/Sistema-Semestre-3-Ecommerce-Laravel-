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

                    <!-- Produtos no pedido -->
                    <div class="mb-5">
                        <h2 class="section-title">PRODUTOS NO PEDIDO</h2>
                        <div class="cart-products">
                            @foreach ($cart as $produto)
                                <div class="cart-product-item d-flex align-items-center mb-3 p-2 border">
                                    @php
                                        $imagem = "/image/cards/{$produto['categoria']}/{$produto['categoria']}{$produto['id']}.jpg";
                                    @endphp
                                    <img src="{{ asset($imagem) }}" alt="{{ $produto['nome'] }}"
                                        class="product-thumbnail me-3"
                                        style="width: 60px; height: 60px; object-fit: cover;">
                                    <div class="flex-grow-1 ml-3">
                                        <h6 class="mb-0">{{ $produto['nome'] }}</h6>
                                        <small class="text-muted">
                                            {{ $produto['quantidade'] }} x R$
                                            {{ number_format($produto['preco'], 2, ',', '.') }}
                                            | {{ $produto['tamanho'] ?? 'Tamanho não informado' }}
                                            | {{ $produto['cor'] ?? 'Cor não informada' }}
                                        </small>
                                    </div>
                                    <div class="text-end">
                                        <strong>R$
                                            {{ number_format($produto['preco'] * $produto['quantidade'], 2, ',', '.') }}</strong>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

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
                            <div class="mt-3 payment-form" id="creditCardForm">
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
                                            <option>1x de R$ {{ number_format($total, 2, ',', '.') }} sem juros</option>
                                            <option>2x de R$ {{ number_format($total / 2, 2, ',', '.') }} sem juros</option>
                                            <option>3x de R$ {{ number_format($total / 3, 2, ',', '.') }} sem juros
                                            </option>
                                            <option>4x de R$ {{ number_format($total / 4, 2, ',', '.') }} sem juros
                                            </option>
                                            <option>5x de R$ {{ number_format($total / 5, 2, ',', '.') }} sem juros
                                            </option>
                                            <option>6x de R$ {{ number_format($total / 6, 2, ',', '.') }} sem juros
                                            </option>
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
                            <!-- Formulário PIX -->
                            <div class="mt-3 payment-form d-none" id="pixForm">
                                <div class="text-center">
                                    <p class="mb-3">Escaneie o QR Code abaixo para pagar com PIX</p>
                                    <div class="pix-qrcode mb-3">
                                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=PIX-{{ rand(100000, 999999) }}"
                                            alt="QR Code PIX" class="img-fluid">
                                    </div>
                                    <p class="text-muted small">O QR Code expira em 30 minutos</p>
                                    <div class="alert alert-info">
                                        <i class="bi bi-info-circle-fill me-2"></i>
                                        Após o pagamento, seu pedido será processado automaticamente
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="payment-method mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="paymentMethod" id="boleto">
                                <label class="form-check-label fw-bold" for="boleto">
                                    Boleto Bancário (3% de desconto)
                                </label>
                            </div>
                            <!-- Formulário Boleto -->
                            <div class="mt-3 payment-form d-none" id="boletoForm">
                                <div class="text-center">
                                    <p class="mb-3">Clique no botão abaixo para gerar seu boleto</p>
                                    <button type="button" class="btn btn-primary mb-3" onclick="gerarBoleto()">
                                        <i class="bi bi-upc-scan me-2"></i>
                                        Gerar Boleto
                                    </button>
                                    <div id="boletoPreview" class="d-none">
                                        <div class="boleto-preview mb-3">
                                            <img src="https://via.placeholder.com/600x200?text=Boleto+Bancário"
                                                alt="Boleto Bancário" class="img-fluid">
                                        </div>
                                        <div class="alert alert-info">
                                            <i class="bi bi-info-circle-fill me-2"></i>
                                            O boleto expira em 3 dias úteis
                                        </div>
                                    </div>
                                </div>
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
                            <span>R$ 0,00</span>
                        </div>
                        <div class="summary-item">
                            <span>Desconto</span>
                            <span>R$ 0,00</span>
                        </div>
                        <div class="summary-item summary-total">
                            <span>Total</span>
                            <span>R$ {{ number_format($total + 25.9, 2, ',', '.') }}</span>
                        </div>

                        <div class="mt-4">
                            <div class="text-muted mb-2 small">ou 6x de R$
                                {{ number_format(($total + 25.9) / 6, 2, ',', '.') }} sem
                                juros</div>
                            <form action="{{ route('cart.finalizar') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-dark checkout-btn mb-3 w-100">FINALIZAR
                                    COMPRA</button>
                            </form>
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

    <style>
        .cart-product-item {
            border-radius: 4px;
        }

        .product-thumbnail {
            border-radius: 4px;
        }

        .payment-method {
            border: 1px solid #e9e9e9;
            border-radius: 4px;
            padding: 15px;
            transition: all 0.3s ease;
        }

        .payment-method:hover {
            border-color: #d3d3d3;
            background-color: #f8f9fa;
        }

        .payment-method.selected {
            border-color: #333;
            background-color: #f8f9fa;
        }

        .pix-qrcode {
            background: white;
            padding: 20px;
            border-radius: 8px;
            display: inline-block;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border: 1px solid #e9e9e9;
        }

        .boleto-preview {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border: 1px solid #e9e9e9;
        }

        .btn-primary {
            background-color: #333;
            border-color: #333;
        }

        .btn-primary:hover {
            background-color: #000;
            border-color: #000;
        }

        .alert-info {
            background-color: #f8f9fa;
            border-color: #e9e9e9;
            color: #333;
        }

        .form-check-input:checked {
            background-color: #333;
            border-color: #333;
        }

        .form-check-input:focus {
            border-color: #333;
            box-shadow: 0 0 0 0.25rem rgba(51, 51, 51, 0.25);
        }
    </style>

    <script>
        // Função para alternar entre os métodos de pagamento
        document.querySelectorAll('input[name="paymentMethod"]').forEach(radio => {
            radio.addEventListener('change', function() {
                // Remove a classe selected de todos os métodos
                document.querySelectorAll('.payment-method').forEach(method => {
                    method.classList.remove('selected');
                });

                // Esconde todos os formulários
                document.querySelectorAll('.payment-form').forEach(form => {
                    form.classList.add('d-none');
                });

                // Adiciona a classe selected ao método selecionado
                this.closest('.payment-method').classList.add('selected');

                // Mostra o formulário correspondente
                const formId = this.id + 'Form';
                document.getElementById(formId).classList.remove('d-none');

                // Atualiza o total com base no desconto
                atualizarTotal(this.id);
            });
        });

        // Função para atualizar o total com base no método de pagamento
        function atualizarTotal(metodoPagamento) {
            const subtotal = {{ $total }};
            const frete = 25.90;
            let desconto = 0;

            if (metodoPagamento === 'pix') {
                desconto = subtotal * 0.05; // 5% de desconto
            } else if (metodoPagamento === 'boleto') {
                desconto = subtotal * 0.03; // 3% de desconto
            }

            const total = subtotal + frete - desconto;

            // Atualiza os valores na tela
            document.querySelector('.summary-item:nth-child(3) span:last-child').textContent =
                `R$ ${desconto.toFixed(2).replace('.', ',')}`;
            document.querySelector('.summary-total span:last-child').textContent =
                `R$ ${total.toFixed(2).replace('.', ',')}`;
            document.querySelector('.text-muted.mb-2.small').innerHTML =
                `ou 6x de R$ ${(total / 6).toFixed(2).replace('.', ',')} sem juros`;
        }

        // Função para gerar boleto
        function gerarBoleto() {
            document.getElementById('boletoPreview').classList.remove('d-none');
        }
    </script>
@endsection
