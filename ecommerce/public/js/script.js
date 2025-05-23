// Inicializar swipers quando o documento estiver pronto
document.addEventListener('DOMContentLoaded', function() {
  // Swiper principal (compatibilidade com o código antigo)
  const swiper = new Swiper('.swiper', {
    navigation: {
      nextEl: ".button-next",
      prevEl: ".button-prev",
    },
    // Default parameters
    slidesPerView: 1,
    spaceBetween: 10,
    // Responsive breakpoints
    breakpoints: {
      // when window width is >= 320px
      576: {
        slidesPerView: 2,
        spaceBetween: 20
      },
      // when window width is >= 480px
      768: {
        slidesPerView: 3,
        spaceBetween: 30
      },
      // when window width is >= 640px
      992: {
        slidesPerView: 4,
        spaceBetween: 40
      }
    }
  });

  // Inicializar swipers para cada categoria, se existirem categorias
  if (window.categorias && window.categorias.length) {
    window.categorias.forEach(categoria => {
      new Swiper(`.mySwiper-${categoria}`, {
        navigation: {
          nextEl: `.button-next-${categoria}`,
          prevEl: `.button-prev-${categoria}`,
        },
        slidesPerView: 1,
        spaceBetween: 10,
        breakpoints: {
          576: {
            slidesPerView: 2,
            spaceBetween: 20
          },
          768: {
            slidesPerView: 3,
            spaceBetween: 30
          },
          992: {
            slidesPerView: 4,
            spaceBetween: 40
          }
        }
      });
    });
  }
});

//Logica de preços do carrinho
function updateCartTotals() {
  let totalItems = 0;
  let subtotal = 0;

  // Calcula subtotal e total de itens
  document.querySelectorAll('.quantity-input').forEach(input => {
    const quantity = parseInt(input.value);
    const price = parseFloat(input.dataset.price);
    const produtoId = input.dataset.produtoId;

    totalItems += quantity;
    const itemSubtotal = quantity * price;
    subtotal += itemSubtotal;

    // Atualiza o subtotal do item
    const subtotalElement = document.querySelector(`.subtotal-price[data-produto-id="${produtoId}"]`);
    if (subtotalElement) {
      subtotalElement.textContent = `R$ ${itemSubtotal.toFixed(2).replace('.', ',')}`;
    }
  });

  // Atualiza os totais no resumo
  const shippingPriceElement = document.getElementById('shipping-price');
  const discountPriceElement = document.getElementById('discount-price');
  const totalItemsElement = document.getElementById('total-items');
  const subtotalPriceElement = document.getElementById('subtotal-price');
  const totalPriceElement = document.getElementById('total-price');
  const installmentPriceElement = document.getElementById('installment-price');

  if (shippingPriceElement && discountPriceElement && totalItemsElement && 
      subtotalPriceElement && totalPriceElement && installmentPriceElement) {
    const shippingPrice = parseFloat(shippingPriceElement.textContent.replace('R$ ', '').replace(',', '.'));
    const discountPrice = parseFloat(discountPriceElement.textContent.replace('R$ ', '').replace(',', '.'));
    const total = subtotal + shippingPrice - discountPrice;

    totalItemsElement.textContent = totalItems;
    subtotalPriceElement.textContent = `R$ ${subtotal.toFixed(2).replace('.', ',')}`;
    totalPriceElement.textContent = `R$ ${total.toFixed(2).replace('.', ',')}`;
    installmentPriceElement.textContent = `R$ ${(total / 6).toFixed(2).replace('.', ',')}`;
  }
}

function btnAumentarQtd(event) {
  event.preventDefault();
  const input = event.target.parentElement.querySelector('.quantity-input');
  input.value = parseInt(input.value) + 1;
  updateCartTotals();
}

function btnDiminuirQtd(event) {
  event.preventDefault();
  const input = event.target.parentElement.querySelector('.quantity-input');
  if (parseInt(input.value) > 1) {
    input.value = parseInt(input.value) - 1;
    updateCartTotals();
  }
}

//Logica da API com o buscador de CEP
function buscarCep(event) {
  const input = event.target.parentElement.querySelector('.form-cep');
  const cep = input.value.replace(/\D/g, ''); // Remove tudo que não é numero

  if (cep.length !== 8) {
    alert('CEP inválido!');
    return;
  }

  fetch(`https://viacep.com.br/ws/${cep}/json/`)
    .then(res => res.json())
    .then(data => {
      if (data.erro) {
        alert('CEP não encontrado!');
        const freteCalculado = document.getElementById('frete-calculado');
        if (freteCalculado) {
          freteCalculado.value = '0';
        }
      } else {
        const shippingOptions = document.getElementById('shipping-options');
        const shippingOptionsContent = document.getElementById('shipping-options-content');
        const shippingPriceElement = document.getElementById('shipping-price');
        const freteCalculado = document.getElementById('frete-calculado');
        
        if (data.uf === 'SP') {
          // Atualiza o preço do frete para SP
          if (shippingPriceElement) {
            shippingPriceElement.textContent = 'R$ 25,90';
          }
          
          // Atualiza as opções de frete
          if (shippingOptionsContent) {
            shippingOptionsContent.innerHTML = `
              <div class="form-check mb-2">
                <input class="form-check-input" type="radio" name="shippingOption" id="standardShipping" checked>
                <label class="form-check-label d-flex justify-content-between w-100" for="standardShipping">
                  <span>Entrega para São Paulo</span>
                  <span>R$ 25,90</span>
                </label>
              </div>
            `;
          }
        } else {
          // Atualiza o preço do frete para outros estados
          if (shippingPriceElement) {
            shippingPriceElement.textContent = 'R$ 48,90';
          }
          
          // Atualiza as opções de frete
          if (shippingOptionsContent) {
            shippingOptionsContent.innerHTML = `
              <div class="form-check mb-2">
                <input class="form-check-input" type="radio" name="shippingOption" id="standardShipping" checked>
                <label class="form-check-label d-flex justify-content-between w-100" for="standardShipping">
                  <span>Entrega para outras regiões fora de São Paulo</span>
                  <span>R$ 48,90</span>
                </label>
              </div>
            `;
          }
        }
        
        // Preenche os campos do endereço se existirem
        const campos = ['logradouro', 'bairro', 'localidade', 'uf'];
        campos.forEach(campo => {
          const elemento = document.getElementById(campo);
          if (elemento) {
            elemento.value = data[campo] || '';
          }
        });
        
        // Remove mensagem de erro se existir
        const mensagemExistente = document.querySelector('.mensagem-erro-cep');
        if (mensagemExistente) {
          mensagemExistente.remove();
        }
        
        // Torna o input válido
        input.setCustomValidity('');
        
        // Marca o frete como calculado
        if (freteCalculado) {
          freteCalculado.value = '1';
        }
        
        // Mostra as opções de frete
        if (shippingOptions) {
          shippingOptions.classList.remove('d-none');
        }
        
        // Atualiza o total
        updateCartTotals();
      }
    })
    .catch(error => {
      console.error('Erro ao buscar CEP:', error);
      alert('Erro ao calcular o frete. Tente novamente.');
      const freteCalculado = document.getElementById('frete-calculado');
      if (freteCalculado) {
        freteCalculado.value = '0';
      }
    });
}

//Ignorando quando o usuario coloca - no meio do cep, verificando se tem mensagem de não atendimento de um determinado local e chamando o fetch via cep
const inputCep = document.getElementById('cep');

if (inputCep) {
  inputCep.addEventListener('input', function () {
    const valorSemTracos = inputCep.value.replace(/-/g, '');
    const mensagemExistente = document.querySelector('.mensagem-erro-cep');

    if (mensagemExistente) {
      mensagemExistente.remove();
    }

    if (valorSemTracos.length === 8) {
      buscarCep({ target: { parentElement: { querySelector: () => inputCep } } });
    }
    inputCep.setCustomValidity('');
  });
}

// Atualiza os totais quando a página carrega
document.addEventListener('DOMContentLoaded', updateCartTotals);