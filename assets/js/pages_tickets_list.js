$(function() {

  $('#tickets-list').dataTable({
    ajax: 'assets/json/pages_tickets_list.json',
    columnDefs: [ {
      targets: [6],
      orderable: false,
      searchable: false
    }],
    createdRow: function (row, data, index) {
      // Add extra padding and set minimum width
      $('td', row).addClass('py-3').eq(1).css('min-width', '300px');

      // *********************************************************************
      // Setup priorities

      var priorityColors = { 1: 'btn-danger', 2: 'btn-success', 3: 'btn-warning' };

      // Priority dropdown
      var priorityDropdown = $(
        '<div class="ticket-priority btn-group">' +
          '<button type="button" class="btn btn-xs md-btn-flat dropdown-toggle" data-toggle="dropdown"></button>' +
          '<div class="dropdown-menu">' +
            '<a class="dropdown-item" href="javascript:void(0)" data-priority="1">High</a>' +
            '<a class="dropdown-item" href="javascript:void(0)" data-priority="2">Medium</a>' +
            '<a class="dropdown-item" href="javascript:void(0)" data-priority="3">Low</a>' +
          '</div>' +
        '</div>'
      );

      // Set up active priority
      priorityDropdown
        .find('.dropdown-toggle')
        .addClass(priorityColors[data[4]])
        .text(
          priorityDropdown.find('[data-priority="' + data[4] + '"]')
            .addClass('active')
            .text()
        );

      // Append dropdown
      $('td', row).eq(4).html('').append(priorityDropdown);


      // *********************************************************************
      // Setup statuses

      // Status dropdown
      var statusDropdown = $(
        '<div class="ticket-status btn-group">' +
          '<button type="button" class="btn btn-outline-secondary btn-xs md-btn-flat dropdown-toggle" data-toggle="dropdown"></button>' +
          '<div class="dropdown-menu">' +
            '<a class="dropdown-item" href="javascript:void(0)" data-status="1">Open</a>' +
            '<a class="dropdown-item" href="javascript:void(0)" data-status="2">Reopened</a>' +
            '<a class="dropdown-item" href="javascript:void(0)" data-status="3">In progress</a>' +
            '<a class="dropdown-item" href="javascript:void(0)" data-status="4">Closed</a>' +
          '</div>' +
        '</div>'
      );

      // Set up active priority
      statusDropdown
        .find('.dropdown-toggle')
        .text(
          statusDropdown.find('[data-status="' + data[5] + '"]')
            .addClass('active')
            .text()
        );

      // Append dropdown
      $('td', row).eq(5).html('').append(statusDropdown);


      // *********************************************************************
      // Setup actions

      $('td', row).eq(6).html('').append(
        '<a href="javascript:void(0)" class="btn btn-default btn-xs icon-btn md-btn-flat product-tooltip" title="Edit"><i class="ion ion-md-create"></i></a>&nbsp;' +
        '<a href="javascript:void(0)" class="btn btn-default btn-xs icon-btn md-btn-flat product-tooltip" title="Remove"><i class="ion ion-md-close"></i></a>'
      );

    }
  });


  // Datepicker

  $('#tickets-list-created').daterangepicker({
    ranges: {
      'Today': [moment(), moment()],
      'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
      'Last 7 Days': [moment().subtract(6, 'days'), moment()],
      'Last 30 Days': [moment().subtract(29, 'days'), moment()],
      'This Month': [moment().startOf('month'), moment().endOf('month')],
      'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    },
    opens: ($('body').attr('dir') === 'rtl' || $('html').attr('dir') === 'rtl') ? 'right' : 'left'
  });

  // Tooltips

  $('body').tooltip({
    selector: '.product-tooltip'
  });

});
