$(function() {

  $('#product-item-images').on('click', 'a', function(e) {
    e.preventDefault();

    // Select only visible thumbnails
    var links = $('#product-item-images').find('a');

    window.blueimpGallery(links, {
      container: '#product-item-lightbox',
      carousel: true,
      hidePageScrollbars: true,
      disableScroll: true,
      index: this
    });
  });

});
