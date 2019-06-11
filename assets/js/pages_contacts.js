$(function() {

  var $container = $('.contacts-row-view, .contacts-col-view');

  // Initial setup
  $container
    .removeClass('contacts-row-view contacts-col-view')
    .addClass($('[name="contacts-view"]').val());

  $('[name="contacts-view"]').on('change', function() {
    $container
      .removeClass('contacts-row-view contacts-col-view')
      .addClass(this.value);
  });

  if ($('html').attr('dir') === 'rtl') {
    $('.contacts-dropdown-menu').removeClass('dropdown-menu-right');
  }

});
