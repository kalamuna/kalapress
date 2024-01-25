<?php
/**
 * Section Footer
 */

 $wrapper_attributes = get_block_wrapper_attributes( array(
  'class' => 'section-footer',
) );
?>

<div <?php echo $wrapper_attributes; ?>>
  <?php echo $content; ?>
</div>