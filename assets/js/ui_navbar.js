$(function() {
  if ($('html').attr('dir') === 'rtl') {
    $('#navbar-example-1 .dropdown-menu').addClass('dropdown-menu-right');
  }
});

// Mega dropdown
$(function() {
  if ($('html').attr('dir') === 'rtl') {
    $('#navbar-example-14 .dropdown-menu').addClass('dropdown-menu-right');
    $('#navbar-example-15 .dropdown-menu').addClass('dropdown-menu-right');
  }

  $('.navbar-example-14-mega-dropdown, .navbar-example-15-mega-dropdown').each(function() {
    new MegaDropdown(this);
  });
});

// Search
$(function() {
  $('#navbar-example-16 .navbar-search-input > input').on('focus', function() {
    $('#navbar-example-16 .navbar-search-box').addClass('active');
  });
  $('#navbar-example-16 .navbar-search-cancel').on('click', function(e) {
    e.preventDefault();
    $('#navbar-example-16 .navbar-search-box').removeClass('active');
  });
});
