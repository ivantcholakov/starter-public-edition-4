$(function() {
  if ($('html').attr('dir') === 'rtl') {
    $('.button-dropdown-input-group-demo .dropdown-menu-right').removeClass('dropdown-menu-right').addClass('rtled');
    $('.button-dropdown-input-group-demo .dropdown-menu:not(.rtled)').addClass('dropdown-menu-right');
  }
});
