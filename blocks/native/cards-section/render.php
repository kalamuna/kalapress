<?php
/**
 * Card Section
 * 
 */

$wrapper_attributes = get_block_wrapper_attributes( array(
  'class' => 'cards-section',
) );
?>

<section <?php echo $wrapper_attributes; ?>>
  <div class="cards-section__container">
    <?php echo $content; ?>
  </div>
</section>