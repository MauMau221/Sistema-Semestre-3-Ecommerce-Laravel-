@extends('master')

@section('content')
    <section>
        <div class="container py-4">
            <h1 class="mb-4">CONFIRMAR ENDEREÇO</h1>

            <!-- Etapas do checkout -->
            <div class="checkout-steps mb-5">
                <div class="checkout-step">
                    <div class="step-number"><a href="/cart" class="text-dark">1</a></div>
                    <div class="step-text">CARRINHO</div>
                </div>
                <div class="checkout-step active">
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
                    <!-- Seção de identificação -->
                    <div class="mb-5">
                        <h2 class="section-title">IDENTIFICAÇÃO</h2>

                        <!-- Formulário de cadastro -->
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Nome Completo*</label>
                                <input type="text" class="form-control" id="name" required>
                            </div>
                            <div class="col-md-6">
                                <label for="cpf" class="form-label">CPF*</label>
                                <input type="text" class="form-control" id="cpf" required>
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">E-mail*</label>
                                <input type="email" class="form-control" id="email" required>
                            </div>
                            <div class="col-md-6">
                                <label for="phone" class="form-label">Telefone*</label>
                                <input type="tel" class="form-control" id="phone" required>
                            </div>
                        </div>
                    </div>

                    <!-- Seção de endereço de entrega -->
                    <div class="mb-5">
                        <h2 class="section-title">ENDEREÇO DE ENTREGA</h2>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label for="cep" class="form-label">CEP*</label>
                                <input type="text" class="form-control form-cep" id="cep" required>
                            </div>
                            <div class="col-md-8">
                                <label for="street" class="form-label">Endereço*</label>
                                <input type="text" class="form-control" id="street" required>
                            </div>
                            <div class="col-md-4">
                                <label for="number" class="form-label">Número*</label>
                                <input type="text" class="form-control" id="number" required>
                            </div>
                            <div class="col-md-8">
                                <label for="complement" class="form-label">Complemento</label>
                                <input type="text" class="form-control" id="complement">
                            </div>
                            <div class="col-md-5">
                                <label for="neighborhood" class="form-label">Bairro*</label>
                                <input type="text" class="form-control" id="neighborhood" required>
                            </div>
                            <div class="col-md-5">
                                <label for="city" class="form-label">Cidade*</label>
                                <input type="text" class="form-control" id="city" required>
                            </div>
                            <div class="col-md-2">
                                <label for="state" class="form-label">Estado*</label>
                                <select class="form-select" id="state" required>
                                    <option selected disabled value="">UF</option>
                                    <option>SP</option>
                                    <option>RJ</option>
                                    <option>MG</option>
                                    <option>RS</option>
                                    <!-- Outros estados aqui -->
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Coluna da direita - Continuar pedido -->
                <div class="col-lg-4">
                    <div class="order-summary">
                        <div class="mt-4">
                            <a href="{{ route('cart.buy') }}" class=" btn btn-dark checkout-btn mb-3">PRÓXIMO</a>
                            <a href="{{ route('cart.cart') }}" class="btn btn-light checkout-btn bg-light text-dark">VOLTAR
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
