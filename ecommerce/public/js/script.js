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
})


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
    document.querySelector(`.subtotal-price[data-produto-id="${produtoId}"]`).textContent =
      `R$ ${itemSubtotal.toFixed(2).replace('.', ',')}`;
  });

  // Atualiza os totais no resumo
  const shippingPrice = parseFloat(document.getElementById('shipping-price').textContent.replace('R$ ', '').replace(',', '.'));
  const discountPrice = parseFloat(document.getElementById('discount-price').textContent.replace('R$ ', '').replace(',', '.'));
  const total = subtotal + shippingPrice - discountPrice;

  document.getElementById('total-items').textContent = totalItems;
  document.getElementById('subtotal-price').textContent = `R$ ${subtotal.toFixed(2).replace('.', ',')}`;
  document.getElementById('total-price').textContent = `R$ ${total.toFixed(2).replace('.', ',')}`;
  document.getElementById('installment-price').textContent =
    `R$ ${(total / 6).toFixed(2).replace('.', ',')}`;
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
      } else {
        if (data.uf != 'SP') {
          const mensagem = document.createElement('p');
          mensagem.textContent = 'Não atendemos fora de SP';
          mensagem.classList.add('text-danger', 'mt-2');
          mensagem.classList.add('text-danger', 'mt-2', 'mensagem-erro-cep');

          const linkCep = document.querySelector('a[href*="buscacepinter"]');

          if (linkCep) {
            linkCep.parentNode.appendChild(mensagem);
          }
          // Deixa o input inválido
          const inputCep = document.getElementById('cep');
          inputCep.setCustomValidity('Só aceitamos CEPs de SP');

        } else {
          
          console.log(data);
          document.getElementById('logradouro').value = data.logradouro || '';
          document.getElementById('bairro').value = data.bairro || '';
          document.getElementById('localidade').value = data.localidade || '';
          document.getElementById('uf').value = data.uf || '';

        }
      }
    });
}

//Ignorando quando o usuario coloca - no meio do cep, verificando se tem mensagem de não atendimento de um determinado local e chamando o fetch via cep
const input = document.getElementById('cep');

input.addEventListener('input', function () {
  const valorSemTracos = input.value.replace(/-/g, '');
  const mensagemExistente = document.querySelector('.mensagem-erro-cep');

  if (mensagemExistente) {
    mensagemExistente.remove();
  }
  //Torna o input valido novamente

  if (valorSemTracos.length === 8) {
    buscarCep(event);
  }
  inputCep.setCustomValidity('');
});

// Atualiza os totais quando a página carrega
document.addEventListener('DOMContentLoaded', updateCartTotals);