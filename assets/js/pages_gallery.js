$(function() {

  $('#gallery-thumbnails').on('click', '.gallery-thumbnail > .img-thumbnail', function(e) {
    e.preventDefault();

    // Select only visible thumbnails
    var links = $('#gallery-thumbnails').find('.gallery-thumbnail:not(.d-none) > .img-thumbnail');

    window.blueimpGallery(links, {
      container: '#gallery-lightbox',
      carousel: true,
      hidePageScrollbars: true,
      disableScroll: true,
      index: this
    });
  });

  var msnry = new Masonry('#gallery-thumbnails', {
    itemSelector: '.gallery-thumbnail:not(.d-none)',
    columnWidth: '.gallery-sizer',
    originLeft: !($('body').attr('dir') === 'rtl' || $('html').attr('dir') === 'rtl')
  });

  $('#gallery-filter').on('click', '.nav-link', function(e) {
    e.preventDefault();

    // Set active filter
    $('#gallery-filter .nav-link').removeClass('active');
    $(this).addClass('active');

    // Show all
    if (this.getAttribute('href') === '#all') {
      $('#gallery-thumbnails .gallery-thumbnail').removeClass('d-none');

    // Show thumbnails only with selected tag
    } else {
      $('#gallery-thumbnails .gallery-thumbnail:not([data-tag="' + this.getAttribute('href').replace('#', '') + '"])').addClass('d-none');
      $('#gallery-thumbnails .gallery-thumbnail[data-tag="' + this.getAttribute('href').replace('#', '') + '"]').removeClass('d-none');
    }

    // Relayout
    msnry.layout();
  });

});
