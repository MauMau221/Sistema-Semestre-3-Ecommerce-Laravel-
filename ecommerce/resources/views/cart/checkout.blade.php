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
                                <input type="text" class="form-control" id="name" value="{{ $user ? $user->name : '' }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="cpf" class="form-label">CPF*</label>
                                <input type="text" class="form-control" id="cpf" required>
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">E-mail*</label>
                                <input type="email" class="form-control" id="email" value="{{ $user ? $user->email : '' }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="phone" class="form-label">Telefone*</label>
                                <input type="tel" class="form-control" id="phone" required>
                            </div>
                        </div>
                    </div>

                    <!-- Seção de endereço de entrega -->
                    <div class="mb-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h2 class="section-title">ENDEREÇO DE ENTREGA</h2>
                            @if($user)
                                <a href="{{ route('user.addresses.index') }}" class="btn btn-outline-dark btn-sm">
                                    <i class="fa-solid fa-location-dot me-1"></i> Gerenciar Endereços
                                </a>
                            @endif
                        </div>
                        
                        @if($mainAddress)
                            <div class="card mb-3 border-success">
                                <div class="card-body">
                                    <h6 class="card-title">
                                        <i class="fa-solid fa-check-circle text-success me-2"></i> 
                                        Endereço Principal
                                    </h6>
                                    <p class="card-text">
                                        {{ $mainAddress->logradouro }}, {{ $mainAddress->numero }} 
                                        @if($mainAddress->complemento)
                                            - {{ $mainAddress->complemento }}
                                        @endif
                                        <br>
                                        {{ $mainAddress->bairro }}, {{ $mainAddress->cidade }} - {{ $mainAddress->estado }}<br>
                                        CEP: {{ $mainAddress->cep }}
                                    </p>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="use_main_address" name="use_main_address" checked>
                                        <label class="form-check-label" for="use_main_address">
                                            Usar este endereço
                                        </label>
                                    </div>
                                </div>
                            </div>
                            
                            <div id="manual_address_form" style="display: none;">
                        @endif
                        
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label for="cep" class="form-label">CEP*</label>
                                <input type="text" class="form-control form-cep" id="cep" name="cep" value="{{ $mainAddress ? $mainAddress->cep : '' }}" required>
                                <a href="https://buscacepinter.correios.com.br/app/endereco/index.php" target="_blank"
                                    class="text-decoration-none text-dark">Não sei meu CEP</a>
                            </div>
                            <div class="col-md-8">
                                <label for="logradouro" class="form-label">Endereço*</label>
                                <input type="text" class="form-control" id="logradouro" name="logradouro" value="{{ $mainAddress ? $mainAddress->logradouro : '' }}" required>
                            </div>
                            <div class="col-md-4">
                                <label for="number" class="form-label">Número*</label>
                                <input type="text" class="form-control" id="number" name="numero" value="{{ $mainAddress ? $mainAddress->numero : '' }}" required>
                            </div>
                            <div class="col-md-8">
                                <label for="complement" class="form-label">Complemento</label>
                                <input type="text" class="form-control" id="complement" name="complemento" value="{{ $mainAddress ? $mainAddress->complemento : '' }}">
                            </div>
                            <div class="col-md-5">
                                <label for="bairro" class="form-label">Bairro*</label>
                                <input type="text" class="form-control" id="bairro" name="bairro" value="{{ $mainAddress ? $mainAddress->bairro : '' }}" required>
                            </div>
                            <div class="col-md-5">
                                <label for="localidade" class="form-label">Cidade*</label>
                                <input type="text" class="form-control" id="localidade" name="cidade" value="{{ $mainAddress ? $mainAddress->cidade : '' }}" required>
                            </div>
                            <div class="col-md-2">
                                <label for="uf" class="form-label">Estado*</label>
                                <select class="form-select" id="uf" name="estado" required>
                                    <option selected disabled value="">UF</option>
                                    <option value="AC" {{ $mainAddress && $mainAddress->estado == 'AC' ? 'selected' : '' }}>AC</option>
                                    <option value="AL" {{ $mainAddress && $mainAddress->estado == 'AL' ? 'selected' : '' }}>AL</option>
                                    <option value="AM" {{ $mainAddress && $mainAddress->estado == 'AM' ? 'selected' : '' }}>AM</option>
                                    <option value="AP" {{ $mainAddress && $mainAddress->estado == 'AP' ? 'selected' : '' }}>AP</option>
                                    <option value="BA" {{ $mainAddress && $mainAddress->estado == 'BA' ? 'selected' : '' }}>BA</option>
                                    <option value="CE" {{ $mainAddress && $mainAddress->estado == 'CE' ? 'selected' : '' }}>CE</option>
                                    <option value="DF" {{ $mainAddress && $mainAddress->estado == 'DF' ? 'selected' : '' }}>DF</option>
                                    <option value="ES" {{ $mainAddress && $mainAddress->estado == 'ES' ? 'selected' : '' }}>ES</option>
                                    <option value="GO" {{ $mainAddress && $mainAddress->estado == 'GO' ? 'selected' : '' }}>GO</option>
                                    <option value="MA" {{ $mainAddress && $mainAddress->estado == 'MA' ? 'selected' : '' }}>MA</option>
                                    <option value="MG" {{ $mainAddress && $mainAddress->estado == 'MG' ? 'selected' : '' }}>MG</option>
                                    <option value="MS" {{ $mainAddress && $mainAddress->estado == 'MS' ? 'selected' : '' }}>MS</option>
                                    <option value="MT" {{ $mainAddress && $mainAddress->estado == 'MT' ? 'selected' : '' }}>MT</option>
                                    <option value="PA" {{ $mainAddress && $mainAddress->estado == 'PA' ? 'selected' : '' }}>PA</option>
                                    <option value="PB" {{ $mainAddress && $mainAddress->estado == 'PB' ? 'selected' : '' }}>PB</option>
                                    <option value="PE" {{ $mainAddress && $mainAddress->estado == 'PE' ? 'selected' : '' }}>PE</option>
                                    <option value="PI" {{ $mainAddress && $mainAddress->estado == 'PI' ? 'selected' : '' }}>PI</option>
                                    <option value="PR" {{ $mainAddress && $mainAddress->estado == 'PR' ? 'selected' : '' }}>PR</option>
                                    <option value="RJ" {{ $mainAddress && $mainAddress->estado == 'RJ' ? 'selected' : '' }}>RJ</option>
                                    <option value="RN" {{ $mainAddress && $mainAddress->estado == 'RN' ? 'selected' : '' }}>RN</option>
                                    <option value="RO" {{ $mainAddress && $mainAddress->estado == 'RO' ? 'selected' : '' }}>RO</option>
                                    <option value="RR" {{ $mainAddress && $mainAddress->estado == 'RR' ? 'selected' : '' }}>RR</option>
                                    <option value="RS" {{ $mainAddress && $mainAddress->estado == 'RS' ? 'selected' : '' }}>RS</option>
                                    <option value="SC" {{ $mainAddress && $mainAddress->estado == 'SC' ? 'selected' : '' }}>SC</option>
                                    <option value="SE" {{ $mainAddress && $mainAddress->estado == 'SE' ? 'selected' : '' }}>SE</option>
                                    <option value="SP" {{ $mainAddress && $mainAddress->estado == 'SP' ? 'selected' : '' }}>SP</option>
                                    <option value="TO" {{ $mainAddress && $mainAddress->estado == 'TO' ? 'selected' : '' }}>TO</option>
                                </select>
                            </div>
                        </div>
                        
                        @if($mainAddress)
                            </div>
                        @endif
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

            <form action="{{ route('cart.finalizar') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-dark w-100">Finalizar Compra</button>
            </form>

            <div class="mt-3 text-center">
                <small class="text-muted">Após a compra, você poderá acompanhar o status do seu pedido em <a href="{{ route('user.orders') }}" class="text-dark">Meus Pedidos</a>.</small>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    // Adicione scripts para consulta de CEP via API (como ViaCEP) aqui
    document.getElementById('cep').addEventListener('blur', function() {
        const cep = this.value.replace(/\D/g, '');
        
        if (cep.length !== 8) {
            return;
        }
        
        fetch(`https://viacep.com.br/ws/${cep}/json/`)
            .then(response => response.json())
            .then(data => {
                if (!data.erro) {
                    document.getElementById('logradouro').value = data.logradouro;
                    document.getElementById('bairro').value = data.bairro;
                    document.getElementById('localidade').value = data.localidade;
                    document.getElementById('uf').value = data.uf;
                    // Foca no campo número após preencher os dados
                    document.getElementById('number').focus();
                }
            })
            .catch(error => console.error('Erro ao buscar CEP:', error));
    });
    
    // Alternar entre endereço principal e manual
    const useMainAddressCheckbox = document.getElementById('use_main_address');
    if (useMainAddressCheckbox) {
        const manualAddressForm = document.getElementById('manual_address_form');
        
        useMainAddressCheckbox.addEventListener('change', function() {
            if (this.checked) {
                manualAddressForm.style.display = 'none';
            } else {
                manualAddressForm.style.display = 'block';
            }
        });
    }
</script>
@endpush
