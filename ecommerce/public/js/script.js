const swiper = new Swiper('.swiper', {
  navigation: {
    nextEl: ".button-next",
    prevEl: ".button-prev",
  },
  // Default parameters
  slidesPerView: 2,
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

// Atualiza os totais quando a página carrega
document.addEventListener('DOMContentLoaded', updateCartTotals);