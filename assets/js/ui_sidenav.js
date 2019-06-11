// Vertical
$(function() {
  new SideNav($('#sidenav-1')[0]);

  $('#sidenav-1-toggle-collapsed').click(function() {
    $('#sidenav-1').toggleClass('sidenav-collapsed');
  });
});

// Horizontal
$(function() {
  new SideNav($('#sidenav-2')[0], {
    orientation: 'horizontal'
  });
});

// Horizontal (Show dropdown on hover)
$(function() {
  new SideNav($('#sidenav-3')[0], {
    orientation: 'horizontal',
    showDropdownOnHover: true
  });
});

// Horizontal (within container)
$(function() {
  new SideNav($('#sidenav-4')[0], {
    orientation: 'horizontal'
  });
});

// No animation
$(function() {
  new SideNav($('#sidenav-5')[0], {
    animate: false
  });

  new SideNav($('#sidenav-6')[0], {
    orientation: 'horizontal',
    animate: false
  });

  $('#sidenav-5-toggle-collapsed').click(function() {
    $('#sidenav-5').toggleClass('sidenav-collapsed');
  });
});

// No accordion
$(function() {
  new SideNav($('#sidenav-7')[0], {
    accordion: false
  });

  new SideNav($('#sidenav-8')[0], {
    orientation: 'horizontal',
    accordion: false
  });

  $('#sidenav-7-toggle-collapsed').click(function() {
    $('#sidenav-7').toggleClass('sidenav-collapsed');
  });
});

// Elements
$(function() {
  $('.sidenavs-9').each(function() {
    new SideNav(this);
  });

  $('#sidenavs-9-toggle-collapsed').click(function() {
    $('.sidenavs-9').toggleClass('sidenav-collapsed');
  });
});

// Colors (vertical)
$(function() {
  $('.sidenavs-10').each(function() {
    new SideNav(this);
  });

  $('#sidenavs-10-toggle-collapsed').click(function() {
    $('.sidenavs-10').toggleClass('sidenav-collapsed');
  });
});

// Colors (horizontal)
$(function() {
  $('.sidenavs-11').each(function() {
    new SideNav(this, {
      orientation: 'horizontal'
    });
  });
});

// With background
$(function() {
  $('.sidenavs-12').each(function() {
    new SideNav(this);
  });

  $('#sidenavs-12-toggle-collapsed').click(function() {
    $('.sidenavs-12').toggleClass('sidenav-collapsed');
  });
});
