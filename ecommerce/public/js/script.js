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



function btnAumentarQtd() {
  event.preventDefault(); // Evita o submit nos botãoes de quantidade
  const quantidadeInput = document.getElementById('quantidade');
  const elementValue = parseInt(quantidadeInput.value);

  if(elementValue < 10 ){
    quantidadeInput.value = elementValue + 1;
  }
}

function btnDiminuirQtd() {
  event.preventDefault(); // Evita o submit nos botãoes de quantidade
  const quantidadeInput = document.getElementById('quantidade');
  const elementValue = parseInt(quantidadeInput.value);

  if(elementValue > 1 ){
    quantidadeInput.value = elementValue - 1;
  }
}

