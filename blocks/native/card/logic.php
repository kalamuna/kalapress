<?php 

/**
 * Function to remove nested links and replace links with <div> elements
 */
function processContent($content) {
  // Find and replace nested links
  $pattern = '/<a\b[^>]*>(.*?)<\/a>/i';

  // Process content to remove nested links.
  $content = preg_replace_callback($pattern, function ($matches) {
  $linkContent = $matches[1];

    // Check if the card content contains nested links
    if (preg_match('/<a\b[^>]*>.*<\s*\/\s*a\s*>/i', $linkContent)) {
      // If it contains nested links, remove the <a> tag around the content.
      return $linkContent;

    } elseif (preg_match('/<a\b[^>]*class="[^"]*\bwp-block-button__link\b[^"]*\bwp-element-button[^"]*"[^>]*>/i', $matches[0])) {

      // If the link has the "wp-block-button__link wp-element-button" classes, replace <a> with <div>
      return '<div class="wp-block-button__link wp-element-button">' . $linkContent . '</div>';
      
    } else {
      // If it's a normal link or a link without the specified classes, return the content without a link
      return $linkContent;
    }
  }, $content);

  return $content;
}
?>