const scrollToTopBtn = document.querySelector( '.scroll-to-top-button' );

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function () {
  scrollFunction();
};

function scrollFunction() {
  if ( document.body.scrollTop > 20 || document.documentElement.scrollTop > 20 ) {
    scrollToTopBtn.classList.add( 'scroll-to-top-button--show' );
  } else {
    scrollToTopBtn.classList.remove( 'scroll-to-top-button--show' );
  }
}

// Scroll to top of page when button is clicked
function scrollToTop() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}

scrollToTopBtn.addEventListener( 'click', scrollToTop );
