const slider = document.querySelectorAll('.slider');
const btnPrev = document.getElementById('prev-button');
const btnNext = document.getElementById('next-button');

let currentSlide = 0;
let intervalId; // Variável para armazenar o ID do intervalo

function hideSlider() {
  slider.forEach(item => item.classList.remove('on'));
}

function showSlider() {
  slider[currentSlide].classList.add('on');
}

function nextSlider() {
  hideSlider();
  if (currentSlide === slider.length - 1) {
    currentSlide = 0;
  } else {
    currentSlide++;
  }
  showSlider();
}

function prevSlider() {
  hideSlider();
  if (currentSlide === 0) {
    currentSlide = slider.length - 1;
  } else {
    currentSlide--;
  }
  showSlider();
}

function startAutoSlide() {
  intervalId = setInterval(nextSlider, 2000); 
}

function stopAutoSlide() {
  clearInterval(intervalId);
}

btnNext.addEventListener('click', () => {
  stopAutoSlide(); // Para o auto-slide quando o usuário clica
  nextSlider();
  startAutoSlide(); // Reinicia o auto-slide após a interação
});

btnPrev.addEventListener('click', () => {
  stopAutoSlide(); // Para o auto-slide quando o usuário clica
  prevSlider();
  startAutoSlide(); // Reinicia o auto-slide após a interação
});

document.addEventListener('DOMContentLoaded', startAutoSlide);


const carouselContainer = document.querySelector('.carousel-container'); // Troque para o seu contêiner principal do carrossel
if (carouselContainer) {
  carouselContainer.addEventListener('mouseenter', stopAutoSlide);
  carouselContainer.addEventListener('mouseleave', startAutoSlide);
}