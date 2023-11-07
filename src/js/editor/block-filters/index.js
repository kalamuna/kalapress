// https://www.billerickson.net/block-styles-in-gutenberg/#block-names
wp.domReady( () => {
  wp.blocks.unregisterBlockType( 'core/avatar' );
  // wp.blocks.unregisterBlockType( 'core/search' );
  wp.blocks.unregisterBlockType( 'core/archives' );
  // wp.blocks.unregisterBlockType('core/classic');
  wp.blocks.unregisterBlockType( 'core/file' );
  wp.blocks.unregisterBlockType( 'core/latest-comments' );
  // wp.blocks.unregisterBlockType('core/navigation-link');
  wp.blocks.unregisterBlockType( 'core/rss' );
  wp.blocks.unregisterBlockType( 'core/spacer' );
  wp.blocks.unregisterBlockType( 'core/tag-cloud' );
  wp.blocks.unregisterBlockType( 'core/audio' );
  wp.blocks.unregisterBlockType( 'core/calendar' );
  wp.blocks.unregisterBlockType( 'core/latest-posts' );
  // wp.blocks.unregisterBlockType('core/more');
  wp.blocks.unregisterBlockType( 'core/nextpage' );
  wp.blocks.unregisterBlockType( 'core/footnotes' );
  // wp.blocks.unregisterBlockType('core/preformatted');
  // wp.blocks.unregisterBlockType('core/social-link');
  //wp.blocks.unregisterBlockType( 'core/subhead' );
  // wp.blocks.unregisterBlockType('core/widget-area');
  wp.blocks.unregisterBlockType( 'core/categories' );
  // wp.blocks.unregisterBlockType('core/navigation');
  // wp.blocks.unregisterBlockType('core/legacy-widget');
  // wp.blocks.unregisterBlockType('core/separator');
  wp.blocks.unregisterBlockType( 'core/social-links' );
  wp.blocks.unregisterBlockType( 'core/verse' );
  // wp.blocks.unregisterBlockType('core/legacy-widget');
  wp.blocks.unregisterBlockType( 'core/code' );
  wp.blocks.unregisterBlockType( 'core/page-list' );
  // wp.blocks.unregisterBlockType('core/cover');
  // wp.blocks.unregisterBlockType('core/media-text');
  //wp.blocks.unregisterBlockType('core/video');
  // wp.blocks.unregisterBlockType('core/legacy-widget');
  wp.blocks.unregisterBlockVariation( 'core/embed', 'amazon-kindle' );
  wp.blocks.unregisterBlockVariation( 'core/embed', 'animoto' );
  wp.blocks.unregisterBlockVariation( 'core/embed', 'cloudup' );
  wp.blocks.unregisterBlockVariation( 'core/embed', 'collegehumor' );
  wp.blocks.unregisterBlockVariation( 'core/embed', 'crowdsignal' );
  wp.blocks.unregisterBlockVariation( 'core/embed', 'dailymotion' );
  wp.blocks.unregisterBlockVariation( 'core/embed', 'flickr' );
  wp.blocks.unregisterBlockVariation( 'core/embed', 'imgur' );
  wp.blocks.unregisterBlockVariation( 'core/embed', 'issuu' );
  wp.blocks.unregisterBlockVariation( 'core/embed', 'meetup-com' );
  wp.blocks.unregisterBlockVariation( 'core/embed', 'mixcloud' );
  wp.blocks.unregisterBlockVariation( 'core/embed', 'pinterest' );
  wp.blocks.unregisterBlockVariation( 'core/embed', 'pocket-casts' );
  wp.blocks.unregisterBlockVariation( 'core/embed', 'reddit' );
  wp.blocks.unregisterBlockVariation( 'core/embed', 'reverbnation' );
  wp.blocks.unregisterBlockVariation( 'core/embed', 'screencast' );
  wp.blocks.unregisterBlockVariation( 'core/embed', 'scribd' );
  wp.blocks.unregisterBlockVariation( 'core/embed', 'smugmug' );
  wp.blocks.unregisterBlockVariation( 'core/embed', 'soundcloud' );
  wp.blocks.unregisterBlockVariation( 'core/embed', 'spotify' );
  wp.blocks.unregisterBlockVariation( 'core/embed', 'speaker-deck' );
  wp.blocks.unregisterBlockVariation( 'core/embed', 'tumblr' );
  wp.blocks.unregisterBlockVariation( 'core/embed', 'videopress' );
  wp.blocks.unregisterBlockVariation( 'core/embed', 'wolfram-cloud' );
  wp.blocks.unregisterBlockVariation( 'core/embed', 'wordpress' );
  wp.blocks.unregisterBlockVariation( 'core/embed', 'wordpress-tv' );
  wp.blocks.unregisterBlockVariation( 'core/embed', 'screencast' );
  wp.blocks.unregisterBlockVariation( 'core/embed', 'kickstarter' );
  wp.blocks.unregisterBlockVariation( 'core/embed', 'slideshare' );
  wp.blocks.unregisterBlockVariation( 'core/embed', 'tiktok' );
  wp.blocks.unregisterBlockVariation( 'core/embed', 'ted' );
  wp.blocks.unregisterBlockVariation( 'core/embed', 'twitter' );

  // Register Block Variations
  wp.blocks.registerBlockVariation( 'core/button', [
    {
      name: 'Button - PDF',
      title: 'Button - PDF',
      attributes: {
        className: 'is-pdf',
      },
    },
    {
      name: 'Button - Arrow',
      title: 'Button - Arrow',
      attributes: {
        className: 'is-arrow',
      },
    },
  ] );

  // Register Block Style Variations
  wp.blocks.registerBlockStyle( 'core/post-featured-image', {
    name: 'border',
    label: 'Border',
  } );

  // Unregister Block Styles
  wp.blocks.unregisterBlockStyle( 'core/image', 'rounded' );
  wp.blocks.unregisterBlockStyle( 'core/quote', 'plain' );
  wp.blocks.unregisterBlockStyle( 'core/table', 'stripes' );
} );
