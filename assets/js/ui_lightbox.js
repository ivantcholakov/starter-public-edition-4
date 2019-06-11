// Photoswipe
$(function() {
  // Utility function (see src/libs/photoswipe/photoswipe.es6)
  // See the docs: http://photoswipe.com/documentation/getting-started.html
  //
  initPhotoSwipeFromDOM('#photoswipe-example');
});

// Blueimp Gallery
$(function() {
  // Lightbox
  $('#blueimp-gallery-example').on('click', '.img-thumbnail', function(e) {
    e.preventDefault();

    var links = $('#blueimp-gallery-example').find('.img-thumbnail');

    window.blueimpGallery(links, {
      container: '#blueimp-gallery-example-container',
      carousel: true,
      hidePageScrollbars: true,
      disableScroll: true,
      index: this
    });
  });

  // Carousel
  window.blueimpGallery([
    'assets/img/bg/9.jpg',
    'assets/img/bg/10.jpg',
    'assets/img/bg/11.jpg',
    'assets/img/bg/12.jpg',
    'assets/img/bg/13.jpg',
  ], {
    container: '#blueimp-carousel-example',
    carousel: true
  });
});
