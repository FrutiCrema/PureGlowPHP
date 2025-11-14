// Hero Carousel
const slider1 = document.querySelector('#glide_1');
if (slider1) {
  new Glide(slider1, {
    type: 'carousel',
    startAt: 0,
    // autoplay: 3000,
    gap: 0,
    hoverpause: true,
    perView: 1,
    animationDuration: 800,
    animationTimingFunc: 'linear',
  }).mount();
}

const navList = document.querySelector('.nav-list');
const hamburger = document.querySelector('.hamburger');

hamburger.addEventListener('click', () => {
  navList.classList.toggle('open');
});


