$(function() {
  $('.masonry-grid').masonry({
    itemSelector: '.masonry-grid-item',
    columnWidth: 160,
    originLeft: !($('body').attr('dir') === 'rtl' || $('html').attr('dir') === 'rtl')
  });
});
