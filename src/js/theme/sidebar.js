document.addEventListener( 'DOMContentLoaded', function () {
  const navDropdownElement = document.querySelector( '.nav-sidebar__dropdown' );
  if ( navDropdownElement ) {
    // Function to handle the Nav Sidebar dropdowns.
    const handleWindowResize = () => {
      const detailsElement = document.querySelector( '.nav-sidebar__dropdown' );
      const mobileBreakpoint = 900;

      // On mobile, collapse the sidebar nav dropdowns.
      if ( window.innerWidth <= mobileBreakpoint ) {
        detailsElement.removeAttribute( 'open' );
      } else {
        detailsElement.setAttribute( 'open', '' );
      }
    };

    // Initial handling of window size
    window.addEventListener( 'load', handleWindowResize );

    // Listen for window resize events
    window.addEventListener( 'resize', handleWindowResize );
  }
} );
