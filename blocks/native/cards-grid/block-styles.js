import { registerBlockStyle } from '@wordpress/blocks';
import domReady from '@wordpress/dom-ready';

function registerSliderStyles() {
  registerBlockStyle('native/cards-grid', {
    name: 'cover',
    label: 'Cover',
  });
  registerBlockStyle('native/cards-grid', {
    name: 'horizontal',
    label: 'Horizontal',
  });
}

domReady(registerSliderStyles);
