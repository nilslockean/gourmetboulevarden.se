const wrapAmpersands = element =>
  element.innerHTML =
    element.innerHTML.replace(/\&amp\;/g, '<span class="ampersand">&amp;</span>')

document.addEventListener('DOMContentLoaded', () => {
  // In all headings, wrap ampersands with span.ampersand for easy styling
  for ( const h of document.querySelectorAll('h1, h2, h3, h4, h5, h6') ) {
    wrapAmpersands(h)
  }
})
