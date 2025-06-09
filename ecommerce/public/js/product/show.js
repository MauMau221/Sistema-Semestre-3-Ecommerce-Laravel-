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
    const produtoId = document.querySelector('input[name="produto_id"]').value;
    
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

                    if (estoqueAtual <= 0) {
                        quantidadeInput.value = 0;
                        quantidadeInput.disabled = true;
                        estoqueDisponivel.textContent = '0';
                        addToCartBtn.disabled = true;
                        addToCartBtn.style.backgroundColor = '#ccc';
                        addToCartBtn.style.cursor = 'not-allowed';
                    } else {
                        addToCartBtn.disabled = false;
                        addToCartBtn.style.backgroundColor = '#000';
                        addToCartBtn.style.cursor = 'pointer';
                        quantidadeInput.value = 1;
                        quantidadeInput.disabled = false;
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