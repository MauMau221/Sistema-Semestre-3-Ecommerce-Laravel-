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
                        @if (empty($cart))
                            <h4 class="text-center">Sua sacola esta vazia!</h4>
                        @endif
                        @foreach ($cart as $produto)
                            <form action="/cart/remove" method="POST" class="cart-item-form">
                                @csrf
                                <input type="hidden" name="produto_id" value="{{ $produto['id'] }}">
                                <div class="cart-item">
                                    <div class="row align-items-center">
                                        <div class="col-3 col-md-2">
                                            @php
                                                $imagemProduto = "/css/image/card/camisa{$produto['id']}.jpg";
                                                $imagemPadrao = '/css/image/card/image' . rand(1, 5) . '.png';
                                                $imagem = file_exists(public_path($imagemProduto))
                                                    ? $imagemProduto
                                                    : $imagemPadrao;
                                            @endphp
                                            <img src="{{ asset($imagem) }}" alt="{{ $produto['nome'] }}"
                                                class="product-thumbnail img-fluid">
                                        </div>
                                        <div class="col-9 col-md-4">
                                            <h5 class="mb-1">{{ $produto['nome'] }}</h5>
                                            <p class="text-muted mb-1">
                                                Tamanho: {{ $produto['tamanho'] ?? 'Não informado' }} |
                                                Cor: {{ $produto['cor'] ?? 'Não informada' }}
                                            </p>
                                            <p class="text-muted mb-0">Código: #{{ $produto['id'] }}</p>
                                        </div>
                                        <div class="col-6 col-md-3 mt-3 mt-md-0">
                                            <form action="{{ route('cart.update') }}" method="POST"
                                                class="update-cart-form">
                                                @csrf
                                                <input type="hidden" name="produto_id" value="{{ $produto['id'] }}">
                                                <div class="quantity-selector">
                                                    <button type="button" class="quantity-btn"
                                                        onclick="btnDiminuirQtd(event)">-</button>
                                                    <input type="text" name="quantidade" class="quantity-input"
                                                        value="{{ $produto['quantidade'] }}"
                                                        data-price="{{ $produto['preco'] }}"
                                                        data-produto-id="{{ $produto['id'] }}">
                                                    <button type="button" class="quantity-btn"
                                                        onclick="btnAumentarQtd(event)">+</button>
                                                </div>
                                                <button type="submit"
                                                    class="btn btn-sm btn-link text-dark mt-2">Atualizar</button>
                                            </form>
                                        </div>
                                        <div class="col-6 col-md-3 mt-3 mt-md-0 text-end">
                                            <div class="fw-bold mb-1 product-price" data-price="{{ $produto['preco'] }}">
                                                R$ {{ number_format($produto['preco'], 2, ',', '.') }}
                                            </div>
                                            <div class="fw-bold mb-1 subtotal-price"
                                                data-produto-id="{{ $produto['id'] }}">
                                                R$
                                                {{ number_format($produto['preco'] * $produto['quantidade'], 2, ',', '.') }}
                                            </div>
                                            <button type="submit"
                                                class="text-danger small btn-link-hover border-0 bg-transparent">Remover</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        @endforeach
                    </div>

                    <!-- Seção de frete -->
                    <div class="mb-5">
                        <h2 class="section-title">CALCULAR FRETE</h2>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <input type="text" id="cep" class="form-control form-cep"
                                        placeholder="Digite seu CEP">
                                    <button class="btn btn-dark" type="button" onclick="buscarCep(event)">CALCULAR</button>
                                </div>
                                <div class="small mb-3">
                                    <a href="https://buscacepinter.correios.com.br/app/endereco/index.php" target="_blank"
                                        class="text-decoration-none text-dark">Não sei meu CEP</a>
                                </div>
                            </div>
                        </div>

                        <!-- Opções de frete após cálculo -->
                        <div id="shipping-options" class="mt-3 d-none">
                            <div id="shipping-options-content">
                                <!-- Shipping options will be dynamically inserted here -->
                            </div>
                        </div>
                        <input type="hidden" id="frete-calculado" value="0">
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

                </div>

                <!-- Coluna da direita - Resumo do pedido -->
                <div class="col-lg-4">
                    <div class="order-summary">
                        <h3 class="mb-4">RESUMO DO PEDIDO</h3>

                        <div class="summary-item">
                            <span>Subtotal (<span id="total-items">{{ count($cart) }}</span> itens)</span>
                            <span id="subtotal-price">R$ {{ number_format($total, 2, ',', '.') }}</span>
                        </div>
                        <div class="summary-item">
                            <span>Frete</span>
                            <span id="shipping-price">R$ 25,90</span>
                        </div>
                        <div class="summary-item">
                            <span>Desconto</span>
                            <span id="discount-price">R$ 0,00</span>
                        </div>
                        <div class="summary-item summary-total">
                            <span>Total</span>
                            <span id="total-price">R$ {{ number_format($total + 25.9, 2, ',', '.') }}</span>
                        </div>

                        <div class="mt-4">
                            <div class="text-muted mb-2 small">ou 6x de <span id="installment-price">R$
                                    {{ number_format(($total + 25.9) / 6, 2, ',', '.') }}</span> sem juros</div>
                            @if (empty($cart))
                                <div class="alert alert-danger">
                                    Adicione produtos para continuar.
                                </div>
                            @else
                                <a href="{{ route('cart.checkout') }}" class="btn btn-dark checkout-btn mb-3" id="btn-finalizar" onclick="return validarFrete(event)">FINALIZAR
                                    COMPRA</a>
                            @endif
                            <a href="{{ session('url_anterior', url('/')) }}"
                                class="btn btn-light checkout-btn bg-light text-dark">
                                CONTINUAR COMPRANDO
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
        .product-thumbnail {
            max-width: 100%;
            height: auto;
            object-fit: cover;
            border-radius: 4px;
        }

        .cart-item {
            padding: 15px;
            margin-bottom: 15px;
            border: 1px solid #e9e9e9;
            border-radius: 4px;
        }

        .update-cart-form {
            display: inline-block;
        }

        .form-cep.invalid {
            border: 2px solid #dc3545 !important;
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25) !important;
        }

        .form-cep.invalid:focus {
            border-color: #dc3545 !important;
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25) !important;
        }
    </style>

    <script>
        function btnDiminuirQtd(event) {
            const input = event.target.parentElement.querySelector('.quantity-input');
            const currentValue = parseInt(input.value);
            if (currentValue > 1) {
                input.value = currentValue - 1;
                updateCartTotals();
            }
        }

        function btnAumentarQtd(event) {
            const input = event.target.parentElement.querySelector('.quantity-input');
            input.value = parseInt(input.value) + 1;
            updateCartTotals();
        }

        function validarFrete(event) {
            const freteCalculado = document.getElementById('frete-calculado').value;
            const cepInput = document.getElementById('cep');
            
            if (freteCalculado === '0') {
                event.preventDefault();
                cepInput.classList.add('invalid');
                cepInput.focus();
                
                // Scroll suave até o input do CEP
                cepInput.scrollIntoView({ behavior: 'smooth', block: 'center' });
                return false;
            }
            return true;
        }

        // Remove a classe invalid quando o usuário começar a digitar
        document.getElementById('cep').addEventListener('input', function() {
            this.classList.remove('invalid');
        });

        function updateCartTotals() {
            // Recalcular os subtotais de cada item
            const quantityInputs = document.querySelectorAll('.quantity-input');
            let subtotal = 0;

            quantityInputs.forEach(input => {
                const price = parseFloat(input.getAttribute('data-price'));
                const quantity = parseInt(input.value);
                const produtoId = input.getAttribute('data-produto-id');

                const itemSubtotal = price * quantity;
                subtotal += itemSubtotal;

                // Atualizar o subtotal do item
                const subtotalElement = document.querySelector(`.subtotal-price[data-produto-id="${produtoId}"]`);
                if (subtotalElement) {
                    subtotalElement.textContent = `R$ ${itemSubtotal.toFixed(2).replace('.', ',')}`;
                }
            });

            // Atualizar o subtotal geral
            const subtotalElement = document.getElementById('subtotal-price');
            if (subtotalElement) {
                subtotalElement.textContent = `R$ ${subtotal.toFixed(2).replace('.', ',')}`;
            }

            // Obter o valor do frete
            const shippingPriceElement = document.getElementById('shipping-price');
            const shippingPrice = parseFloat(shippingPriceElement.textContent.replace('R$ ', '').replace(',', '.'));

            // Obter o valor do desconto
            const discountPriceElement = document.getElementById('discount-price');
            const discountPrice = parseFloat(discountPriceElement.textContent.replace('R$ ', '').replace(',', '.'));

            // Calcular o total
            const total = subtotal + shippingPrice - discountPrice;

            // Atualizar o total
            const totalElement = document.getElementById('total-price');
            if (totalElement) {
                totalElement.textContent = `R$ ${total.toFixed(2).replace('.', ',')}`;
            }

            // Atualizar o valor da parcela
            const installmentPriceElement = document.getElementById('installment-price');
            if (installmentPriceElement) {
                const installmentPrice = total / 6;
                installmentPriceElement.textContent = `R$ ${installmentPrice.toFixed(2).replace('.', ',')}`;
            }
        }
    </script>
@endsection
