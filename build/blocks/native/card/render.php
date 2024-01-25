<?php
/**
 * Card
 */

// Processes the Card links.
include_once 'logic.php';

$card_link = $attributes['cardLink'];
$card_target = $attributes['cardLinkTarget'] ? '_blank' : '_self';
$image_url = $attributes['imageUrl'];
$image_id = $attributes['imageId'] ?? '';
$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
$image_position = $attributes['imageAlignment'] ?? '50% 50%';
$show_image = $attributes['showImage'];
$processedContent = processContent($content);

$wrapper_attributes = get_block_wrapper_attributes( array(
  'class' => 'card',
) );
?>

<?php if (!empty($card_link)) : ?>
  <a href="<?php echo esc_url($card_link); ?>" target="<?php echo esc_attr($card_target); ?>" class="card__link">
<?php endif; ?>

<div <?php echo $wrapper_attributes; ?>>
  <div class="card__contents">
    <div class="card__text-content">
      <div class="card__text-content-inner">
        <?php if (empty($card_link)) {
          // If there's no card link, display the content as usual.
          echo $content;
        } else {
          // Otherwise, process the content so that it removes child links.
          echo $processedContent;
        } ?>
      </div>
    </div>
    <?php if ($show_image === true) : ?>
      <div class="card__media">
        <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>" style="object-position: <?php echo esc_attr($image_position); ?>" />
      </div>
    <?php endif; ?>
  </div>
</div>

<?php if (!empty($card_link)) : ?>
  </a>
<?php endif;
?>
