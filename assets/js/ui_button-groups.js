$(function() {
  if ($('html').attr('dir') === 'rtl') {
    $('#nesting-button-group-demo .dropdown-menu').addClass('dropdown-menu-right');
    $('#vertical-button-group-demo .dropdown-menu').addClass('dropdown-menu-right');
  }
});
