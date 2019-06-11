$(function () {
  new SideNav($('#sidenav-app-brand-1')[0]);
  new SideNav($('#sidenav-app-brand-2')[0]);
  new SideNav($('#sidenav-app-brand-3')[0]);

  $('#sidenav-app-brand-toggle-collapsed').click(function () {
    $('#sidenav-app-brand-1').toggleClass('sidenav-collapsed');
    $('#sidenav-app-brand-2').toggleClass('sidenav-collapsed');
    $('#sidenav-app-brand-3').toggleClass('sidenav-collapsed');
  });
});
