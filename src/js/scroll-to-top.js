/**
 *  Scroll to top button
 *  ========================================
*/
// Get the button
let scrollToTopButton = document.getElementById("scroll-to-top");
let mobileFooterNav = document.getElementById("mobileFooterNav");

// When the user scrolls down 1800px from the top of the document, show the button
window.onscroll = function () {
  scrollFunction();
};

function scrollFunction() {
  if (document.body.scrollTop > 1800 || document.documentElement.scrollTop > 1800) {
    mobileFooterNav.classList.add("active");
  } else {
    mobileFooterNav.classList.remove("active");
  }
}

// When the user clicks on the button, scroll to the top of the document
scrollToTopButton.addEventListener("click", function () {
  window.scrollTo({
    top: 0,
    behavior: "smooth"
  });
});
