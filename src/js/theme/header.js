( function () {
  /**
   * Sticky & Flyout nav scripts.
   */

  // Header Bar variables.
  const flyoutNavContainer = document.querySelector( '.nav-header--flyout__container' );
  const flyoutNavContainerDetails = document.querySelector(
    '.nav-header--flyout__container details',
  );

  // Function to remove the open class & change the aria-expanded attr.
  const closeNav = () => {
    flyoutNavContainerDetails.removeAttribute( 'open' );
  };

  // Close the flyout nav when you hit the esc key.
  document.addEventListener( 'keyup', ( e ) => {
    if ( e.key === 'Escape' ) {
      closeNav();
    }
  } );

  // Close the flyout nav when you click out of it.
  document.addEventListener( 'click', ( e ) => {
    const isClickedInside = flyoutNavContainer.contains( e.target );
    const isClassAssigned = flyoutNavContainer.classList.contains( 'active' );

    if ( ! isClickedInside && isClassAssigned ) {
      closeNav();
    }
  } );

  /**
   * Search bar scripts.
   */

  // Searchbar variables.
  const searchToggle = document.querySelector( '.searchform--reveal__toggle' );
  const searchForm = document.querySelector( '#searchformTop' );

  // Toggle the Searchbar.
  const toggleSearchBar = () => {
    searchForm.classList.toggle( 'open' );
    searchToggle.classList.toggle( 'open' );

    if ( searchForm.classList.contains( 'open' ) ) {
      searchToggle.setAttribute( 'aria-expanded', 'true' );
    } else {
      searchToggle.setAttribute( 'aria-expanded', 'false' );
    }
  };

  // Toggle the Searchbar on click.
  searchToggle.addEventListener( 'click', () => {
    toggleSearchBar();
  } );

  window.addEventListener( 'load', () => {
    searchForm.classList.remove( 'open' );
  } );

  // Toggle the Searchbar when the tab key is pressed.
  searchToggle.onkeyup = ( e ) => {
    if ( e.key === 'Tab' ) {
      toggleSearchBar();
    }
  };

  /**
   * Primary nav scripts.
   */

  // Toggle the Navigation sub menus.
  const menuSubmenus = document.querySelectorAll(
    '.nav-header--primary ul summary, .nav-header--eyebrow ul summary',
  );

  menuSubmenus.forEach( ( menuSummary ) => {
    const details = menuSummary.closest(
      '.nav-header--primary ul li details, .nav-header--eyebrow ul li details',
    );
    const menuLinks = menuSummary.closest(
      '.nav-header--primary .menu__item--parent, .nav-header--eyebrow .menu__item--parent',
    );
    const detailsDropdowns = [
      ...document.querySelectorAll(
        '.nav-header--primary .menu details, .nav-header--eyebrow .menu details',
      ),
    ];

    const openSubmenu = () => {
      // console.log('open menu');
      if ( window.matchMedia( '(hover: hover) and (pointer: fine)' ).matches ) {
        details.setAttribute( 'open', 'open' );
      }
    };

    const closeSubmenu = () => {
      // console.log('close menu');
      if ( window.matchMedia( '(hover: hover) and (pointer: fine)' ).matches ) {
        details.removeAttribute( 'open', 'open' );
      }
    };

    // Only open one dropdown at a time.
    menuSummary.addEventListener( 'click', ( event ) => {
      if (
        ! detailsDropdowns.some( ( detailDropdown ) => detailDropdown.contains( event.target ) )
      ) {
        detailsDropdowns.forEach( ( detailDropdown ) => detailDropdown.removeAttribute( 'open' ) );
      } else {
        detailsDropdowns.forEach( ( detailDropdown ) =>
          ! detailDropdown.contains( event.target ) ? detailDropdown.removeAttribute( 'open' ) : '',
        );
      }
    } );

    // Open the menu on mouseover.
    details.addEventListener( 'mouseenter', () => {
      openSubmenu();
    } );

    menuLinks.addEventListener( 'mouseenter', () => {
      openSubmenu();
    } );

    // Close the menu on mouseleave.
    menuLinks.addEventListener( 'mouseleave', () => {
      closeSubmenu();
    } );
  } );

  // Offset the Eyebrow sub menu from the bar.
  const eyebrow = document.querySelector( '.nav-header--eyebrow' );
  const eyebrowSubMenu = document.querySelector( '.nav-header--eyebrow .menu__sub-menu' );

  // Adjust the offset if the window resizes.
  function handleResize() {
    eyebrowSubMenu.style.top = eyebrow.offsetHeight + 'px';
  }
  window.addEventListener( 'resize', handleResize );
} )();
