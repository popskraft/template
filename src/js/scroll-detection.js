/**
 *  Check if the page has been scrolled
 *  ========================================
*/
window.addEventListener('scroll', function () {
  if (window.scrollY > 0) {
    document.body.classList.add('scrolled');
  } else {
    document.body.classList.remove('scrolled');
  }
});
