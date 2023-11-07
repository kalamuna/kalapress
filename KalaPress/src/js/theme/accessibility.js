
// Add an external callout icon for links that open in a new tab.

// The external icon.

// const svgContent = "<svg xmlns='http://www.w3.org/2000/svg' version='1.1' viewBox='0 0 16 16' width='16' height='16' aria-hidden='true'><path fill='currentColor' d='M11.536 3.464a5 5 0 010 7.072L8 14.07l-3.536-3.535a5 5 0 117.072-7.072v.001zm1.06 8.132a6.5 6.5 0 10-9.192 0l3.535 3.536a1.5 1.5 0 002.122 0l3.535-3.536zM8 9a2 2 0 100-4 2 2 0 000 4z'></path></svg>";

const svgContent = '<svg class="ext" viewBox="0 0 50 40" width="50" height="34" aria-label="External links opens in new window" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M18.286 2.497c0-1.326 1-2.497 2.285-2.497h9.072c.357 0 .643.078.928.234.215.078.5.312.715.546.428.469.643 1.093.714 1.717v9.99c0 1.404-1.071 2.497-2.286 2.497-1.285 0-2.285-1.093-2.285-2.497V8.585L15.286 21.773a2.078 2.078 0 0 1-3.215 0c-.928-.936-.928-2.575 0-3.511L24.143 4.995H20.57c-1.285 0-2.285-1.093-2.285-2.498ZM0 7.492C0 4.76 2 2.497 4.571 2.497h6.858c1.214 0 2.285 1.17 2.285 2.498 0 1.404-1.071 2.497-2.285 2.497H4.57v22.476h20.572v-7.492c0-1.327 1-2.497 2.286-2.497 1.214 0 2.285 1.17 2.285 2.497v7.492c0 2.81-2.071 4.994-4.571 4.994H4.57C2 34.962 0 32.777 0 29.968V7.492Z" fill="currentColor"/></svg>';

// parse the svg.
const parseSvgString = svgString =>
  new DOMParser().parseFromString(svgString, 'image/svg+xml')
    .querySelector('svg');

// Append the icon to links with target=_"blank".
document.querySelectorAll('p a[target="_blank"], h1 a[target="_blank"], h2 a[target="_blank"], h3 a[target="_blank"], h4 a[target="_blank"], h5 a[target="_blank"], h6 a[target="_blank"], li a[target="_blank"], .wp-block-button:not(.is-pdf, .is-arrow) a[target="_blank"]')
  .forEach(function (elem) {
    elem.appendChild(parseSvgString(svgContent));
  }) 