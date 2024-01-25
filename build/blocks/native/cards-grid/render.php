<?php
/**
 * Cards Grid
 * 
 */

// Define inline styles.
$inline_styles = '
  --border-radius: ' . $attributes['borderRadius'] . ';
  --card-background-color: ' . $attributes['cardBackgroundColor'] . ';
  --card-text-color: ' . $attributes['cardTextColor'] . ';
  --card-columns: ' . $attributes['cardColumns'] . ';
  --card-content-padding: ' . $attributes['cardContentPadding'] . ';
  --card-padding: ' . $attributes['cardPadding'] . ';
  --column-gap: ' . $attributes['columnGap'] . ';
  --row-gap: ' . $attributes['rowGap'] . ';
';

$wrapper_attributes = get_block_wrapper_attributes( array(
  'class' => 'cards-grid',
  'style' => $inline_styles
) );
?>

<div <?php echo $wrapper_attributes; ?>>
  <?php echo $content; ?>
</div>
