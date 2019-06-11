$(function() {

  function openSidenav() {
    $('.clients-wrapper').addClass('clients-sidebox-open');
  }

  function closeSidenav() {
    $('.clients-wrapper').removeClass('clients-sidebox-open');
    $('.clients-table tr.bg-light').removeClass('bg-light');
  }

  function selectClient(row) {
    openSidenav();
    $('.clients-table tr.bg-light').removeClass('bg-light');
    $(row).addClass('bg-light');
  }

  $('body').on('click', '.clients-table tr', function() {
    // Load client data here
    // ...

    // Select client
    selectClient(this);
  });

  $('body').on('click', '.clients-sidebox-close', function(e) {
    e.preventDefault();
    closeSidenav();
  });

  // Setup scrollbars

  $('.clients-scroll').each(function() {
    new PerfectScrollbar(this, {
      suppressScrollX: true,
      wheelPropagation: true
    });
  });

});
