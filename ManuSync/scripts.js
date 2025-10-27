document.addEventListener('DOMContentLoaded', () => {
    const menuToggle = document.getElementById('mobile-menu');
    const navLinks = document.querySelector('.nav-links');

    menuToggle.addEventListener('click', () => {
        navLinks.classList.toggle('active');
    });
});

window.addEventListener('pageshow', (event) => {
  if (event.persisted) {
    const hero = document.querySelector('.hero');
    hero.style.animation = 'none';
    hero.offsetHeight; // force reflow
    hero.style.animation = null;
  }
});