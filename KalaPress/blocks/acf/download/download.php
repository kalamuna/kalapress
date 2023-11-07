<?php
/**
 * Download Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during backend preview render.
 * @param   int $post_id The post ID the block is rendering content against.
 *          This is either the post ID currently being displayed inside a query loop,
 *          or the post ID of the post hosting this block.
 * @param   array $context The context provided to the block by the post or its parent block.
 */

// Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'download-block';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $class_name .= ' align' . $block['align'];
}

// Load values and assign defaults.
$choose_download_file = get_field( 'choose_download_file' ); 
$title_text = get_field( 'title_text' ); 

// If no title text is provided then the filename Title from the Media Library will be displayed.
if ( !$title_text ) :
  $title_text = $choose_download_file['title'];
endif;

// If no button text is provided then the button will say "Download"
$button_text = get_field( 'button_text' ); 
if ( !$button_text ) :
    $button_text = "Download";
endif;

?>

<?php if ( $choose_download_file ) { ?>
  <div 
  class="<?php echo esc_attr( $class_name ); ?>" 
  <?php echo wp_kses_data( get_block_wrapper_attributes() ); ?>
  >
    <div class="wp-block-columns">
          <figure class="wp-block-image size-thumbnail">
            <a href="<?php echo esc_url( $choose_download_file['url'] ); ?>">
              <img src="<?php echo wp_get_attachment_image_url($choose_download_file['id'],'thumbnail'); ?>" alt="<?php echo esc_attr( $choose_download_file['alt'] ); ?>" />
            </a>
          </figure>
      </div>

      <div class="wp-block-column">
        <h3><?php echo $title_text; ?></h3>

        <div class="wp-block-buttons">
          <div class="wp-block-button">
            <a class="wp-block-button__link wp-block-button__link has-secondary-background-color has-background" href="<?php echo esc_url( $choose_download_file['url'] ); ?>">
              <?php echo $button_text; ?> - <?php echo strtoupper($choose_download_file['subtype']); ?>
            </a>
          </div>
        </div>

      </div>
  </div>

<!-- If no file is added to this block, display a warning message. -->      
<?php } else { ?>
  <p><span class="dashicons dashicons-warning"></span> Choose a file from the Block Settings.</p>
<?php } ?>
</div>
