@extends('master')

@section('content')
    <section>
        <section class="container py-4">
            <div class="row">
                <!-- Imagens do produto -->
                <div class="col-md-6 d-flex flex-md-row flex-column">
                    <!-- Miniaturas -->
                    <div class="d-none d-md-block me-2">
                        @php
                            $imagemPrincipal = "/css/image/card/camisa{$produto->id}.jpg";
                            $imagensSecundarias = [];
                            
                            // Tenta encontrar até 4 imagens secundárias
                            for ($i = 1; $i <= 4; $i++) {
                                $path = "/css/image/card/camisa{$produto->id}-{$i}.jpg";
                                if (file_exists(public_path($path))) {
                                    $imagensSecundarias[] = $path;
                                }
                            }
                        @endphp
                        
                        <!-- Miniatura da imagem principal -->
                        <div class="product-thumbnail mb-2">
                            <img src="{{ asset($imagemPrincipal) }}" alt="{{ $produto->nome }} principal" 
                                class="img-fluid border border-secondary thumbnail-image" 
                                data-image="{{ asset($imagemPrincipal) }}"
                                onclick="alterarImagemPrincipal(this)">
                        </div>
                        
                        <!-- Miniaturas das imagens secundárias -->
                        @foreach($imagensSecundarias as $index => $imagem)
                            <div class="product-thumbnail mb-2">
                                <img src="{{ asset($imagem) }}" alt="{{ $produto->nome }} {{ $index + 1 }}" 
                                    class="img-fluid border border-secondary thumbnail-image" 
                                    data-image="{{ asset($imagem) }}"
                                    onclick="alterarImagemPrincipal(this)">
                            </div>
                        @endforeach
                    </div>
                
                    <!-- Imagem principal -->
                    <div class="flex-grow-1 ml-2">
                        <img id="imagem-principal" src="{{ asset($imagemPrincipal) }}"
                             alt="{{ $produto->nome }}"
                             class="img-fluid border border-secondary w-100">
                    </div>
                </div>
                
                <!-- Detalhes do produto -->
                <div class="col-md-6 product-details">
                    <h1 class="product-title">{{ $produto['nome'] }}</h1>
                    <div class="mb-3">
                        <span class="product-price">R$ {{ number_format($produto['preco'], 2, ',', '.') }}</span>
                        <div class="product-installments">em até 6x de R$
                            {{ number_format($produto['preco'] / 6, 2, ',', '.') }} sem juros</div>
                    </div>

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('cart.add') }}" method="POST" id="addToCartForm">
                        @csrf
                        <input type="hidden" name="produto_id" value="{{ $produto->id }}">

                        <div class="mb-4">
                            <div class="fw-bold mb-2">Cor:</div>
                            <div class="d-flex mb-3">
                                @foreach($produto->estoque->pluck('cor')->unique() as $cor)
                                    <div class="me-2">
                                        <input type="radio" name="cor" value="{{ $cor }}" id="cor_{{ $cor }}" class="cor-input">
                                        <label for="cor_{{ $cor }}" class="cor-label" style="width: 30px; height: 30px; border-radius: 50%; cursor: pointer; display: inline-block; border: 2px solid #ddd;" title="{{ $cor }}">
                                            <span class="d-none">{{ $cor }}</span>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            <div id="cor-selecionada" class="mt-1 small text-muted">Selecione uma cor</div>
                            @error('cor')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <div class="fw-bold mb-2">Tamanho:</div>
                            <div class="d-flex flex-wrap tamanho-container">
                                @foreach($produto->estoque->pluck('tamanho')->unique() as $tamanho)
                                    <div class="me-2 mb-2">
                                        <input type="radio" name="tamanho" value="{{ $tamanho }}" id="tamanho_{{ $tamanho }}" class="tamanho-input">
                                        <label for="tamanho_{{ $tamanho }}" class="tamanho-label btn btn-outline-dark rounded-0">{{ $tamanho }}</label>
                                    </div>
                                @endforeach
                            </div>
                            @error('tamanho')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <div class="mt-2">
                                <a href="#" class="text-decoration-none text-dark">Guia de tamanhos</a>
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="fw-bold mb-2">Quantidade:</div>
                            <div class="d-flex align-items-center">
                                <button type="button" class="btn btn-outline-dark rounded-0 quantity-btn" id="diminuir-quantidade">-</button>
                                <input type="number" id="quantidade" name="quantidade" class="form-control rounded-0 text-center mx-2 quantity-input"
                                    value="1" min="1" max="10" style="width: 70px;" required>
                                <button type="button" class="btn btn-outline-dark rounded-0 quantity-btn" id="aumentar-quantidade">+</button>
                            </div>
                            @error('quantidade')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <div class="mt-2 text-muted">
                                <span id="estoque-disponivel">Selecione cor e tamanho</span> unidades disponíveis
                            </div>
                        </div>

                        <button type="submit" class="btn btn-dark w-100 mb-3" id="addToCartBtn">Adicionar ao Carrinho</button>
                    </form>

                    <div class="mb-4">
                        <div class="fw-bold mb-2">Descrição:</div>
                        <p>{{ $produto['desc'] }}.</p>
                    </div>

                    <div class="mb-4">
                        <div class="fw-bold mb-2">Composição:</div>
                        <p>100% Algodão</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Produtos similares -->
        <section class="container py-5">
            <h2 class="text-center mb-4">VOCÊ TAMBÉM PODE GOSTAR</h2>
            <div class="swiper mySwiper">
                <div class="d-flex justify-content-end m-2">
                    <div class="button-prev p-2"><i class="fa-solid fa-circle-chevron-right fa-flip-horizontal fa-2xl"></i>
                    </div>
                    <div class="button-next p-2"><i class="fa-solid fa-circle-chevron-right fa-2xl"></i></div>
                </div>
                <div class="swiper-wrapper">
                    @foreach ($relacionados as $prod)
                        <a href="{{ route('product.show', $prod['id']) }}">
                            <div class="swiper-slide">
                                <div class="card-product">
                                    <div class="image-container position-relative">
                                        <img src="{{ asset('/css/image/card/camisa'.$prod->id.'.jpg') }}"
                                            class="card-img-top" alt="{{ $prod->nome }}">
                                    </div>
                                    <div class="card d-flex flex-column p-2 border-0">
                                        <div class="star">
                                            <i class="fa-solid fa-star fa-2xs"></i>
                                            <i class="fa-solid fa-star fa-2xs"></i>
                                            <i class="fa-solid fa-star fa-2xs"></i>
                                            <i class="fa-solid fa-star fa-2xs"></i>
                                            <i class="fa-regular fa-star fa-2xs"></i>
                                        </div>
                                        <h5 class="font-weight-bold">{{ $prod['nome'] }}</h5>
                                        <p class="card-price">
                                            <strong>R${{ $prod['preco'] }}</strong>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    </section>

    <style>
        /* Estilo para cor selecionada */
        input[type="radio"].cor-input {
            display: none;
        }
        
        input[type="radio"].cor-input:checked + label.cor-label {
            border: 2px solid black !important;
            box-shadow: 0 0 5px rgba(0,0,0,0.5);
        }
        
        /* Cores específicas */
        input[type="radio"].cor-input[value="Azul"] + label.cor-label {
            background-color: #0000ff;
        }
        
        input[type="radio"].cor-input[value="Preto"] + label.cor-label {
            background-color: #000000;
        }
        
        input[type="radio"].cor-input[value="Branco"] + label.cor-label {
            background-color: #ffffff;
        }
        
        input[type="radio"].cor-input[value="Vermelho"] + label.cor-label {
            background-color: #ff0000;
        }
        
        input[type="radio"].cor-input[value="Verde"] + label.cor-label {
            background-color: #008000;
        }
        
        /* Estilo para tamanho selecionado */
        input[type="radio"].tamanho-input {
            display: none;
        }
        
        input[type="radio"].tamanho-input:checked + label.tamanho-label {
            background-color: #212529;
            color: white;
        }
        
        /* Estilos para miniaturas */
        .product-thumbnail {
            cursor: pointer;
            transition: all 0.2s;
        }
        
        .product-thumbnail:hover {
            opacity: 0.8;
        }
        
        .thumbnail-image {
            width: 80px;
            height: 80px;
            object-fit: cover;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const corInputs = document.querySelectorAll('input[name="cor"]');
            const tamanhoInputs = document.querySelectorAll('input[name="tamanho"]');
            const quantidadeInput = document.getElementById('quantidade');
            const estoqueDisponivel = document.getElementById('estoque-disponivel');
            const corSelecionada = document.getElementById('cor-selecionada');
            const addToCartBtn = document.getElementById('addToCartBtn');
            const addToCartForm = document.getElementById('addToCartForm');
            const diminuirBtn = document.getElementById('diminuir-quantidade');
            const aumentarBtn = document.getElementById('aumentar-quantidade');
            const produtoId = {{ $produto->id }};
            
            let estoqueAtual = 0;

            function atualizarEstoqueDisponivel() {
                const cor = document.querySelector('input[name="cor"]:checked')?.value;
                const tamanho = document.querySelector('input[name="tamanho"]:checked')?.value;

                if (cor) {
                    corSelecionada.textContent = `Cor selecionada: ${cor}`;
                }

                if (cor && tamanho) {
                    fetch(`/produto/${produtoId}/estoque?cor=${cor}&tamanho=${tamanho}`)
                        .then(response => response.json())
                        .then(data => {
                            estoqueAtual = data.quantidade;
                            estoqueDisponivel.textContent = estoqueAtual;
                            quantidadeInput.max = estoqueAtual;
                            
                            // Ajusta a quantidade se necessário
                            if (parseInt(quantidadeInput.value) > estoqueAtual) {
                                quantidadeInput.value = estoqueAtual > 0 ? estoqueAtual : 1;
                            }
                        });
                } else {
                    estoqueDisponivel.textContent = 'Selecione cor e tamanho';
                }
            }

            // Adicionar listeners para os botões de quantidade
            diminuirBtn.addEventListener('click', function() {
                const currentValue = parseInt(quantidadeInput.value);
                if (currentValue > 1) {
                    quantidadeInput.value = currentValue - 1;
                }
            });

            aumentarBtn.addEventListener('click', function() {
                const currentValue = parseInt(quantidadeInput.value);
                if (currentValue < estoqueAtual) {
                    quantidadeInput.value = currentValue + 1;
                }
            });

            corInputs.forEach(input => {
                input.addEventListener('change', atualizarEstoqueDisponivel);
            });

            tamanhoInputs.forEach(input => {
                input.addEventListener('change', atualizarEstoqueDisponivel);
            });

            // Validação do formulário antes do envio
            addToCartForm.addEventListener('submit', function(event) {
                const cor = document.querySelector('input[name="cor"]:checked');
                const tamanho = document.querySelector('input[name="tamanho"]:checked');
                
                if (!cor || !tamanho) {
                    event.preventDefault();
                    alert('Por favor, selecione cor e tamanho');
                    return;
                }

                const quantidade = parseInt(quantidadeInput.value);
                
                if (quantidade > estoqueAtual) {
                    event.preventDefault();
                    alert('Quantidade indisponível em estoque');
                    return;
                }
            });
        });
        
        // Função para alterar a imagem principal
        function alterarImagemPrincipal(elemento) {
            const imagemPrincipal = document.getElementById('imagem-principal');
            imagemPrincipal.src = elemento.getAttribute('data-image');
        }
    </script>
@endsection
