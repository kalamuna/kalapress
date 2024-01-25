<?php
/**
 * Section Header
 */
$section_heading = $attributes['sectionHeading'];
$hide_section_heading = $attributes['hideSectionHeading'];
$section_heading_class = $hide_section_heading ? 'section-header__heading screen-reader-text' : 'section-header__heading';

$wrapper_attributes = get_block_wrapper_attributes( array(
  'class' => 'section-header section-header--' . $attributes['alignment'],
) );

?>

<div <?php echo $wrapper_attributes; ?>>

  <!-- Use a default heading when the field is left empty to maintain the heading structure. -->
  <h2 class="<?php echo esc_attr($section_heading_class); ?>">
    <?php echo empty($section_heading) ? 'Section Heading' : esc_html($section_heading); ?>
  </h2>

  <?php echo $content; ?>
</div>