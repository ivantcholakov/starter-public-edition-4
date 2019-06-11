$(function() {

  var isRtl = $('body').attr('dir') === 'rtl' || $('html').attr('dir') === 'rtl';

  var roles = {
    1: 'User',
    2: 'Author',
    3: 'Staff',
    4: 'Admin'
  };

  var statuses = {
    1: ['Active', 'success'],
    2: ['Banned', 'danger'],
    3: ['Deleted', 'default']
  };

  $('#user-list').dataTable({
    ajax: 'assets/json/pages_users_list.json',
    columnDefs: [ {
      targets: [8],
      orderable: false,
      searchable: false
    }],
    createdRow: function (row, data, index) {

      // *********************************************************************
      // Account link

      $('td', row).eq(1).html('').append(
        '<a href="javascript:void(0)">' + data[1] + '</a>'
      );

      // *********************************************************************
      // Verified

      $('td', row).eq(5).html('').append(
        '<span class="ion ion-md-' + (data[5] ? 'checkmark text-primary' : 'close text-light') + '">'
      );

      // *********************************************************************
      // Role

      $('td', row).eq(6).html('').append(
        roles[data[6]]
      );

      // *********************************************************************
      // Status

      $('td', row).eq(7).html('').append(
        '<span class="badge badge-outline-' + statuses[data[7]][1] + '">' + statuses[data[7]][0] + '</span>'
      );

      // *********************************************************************
      // Actions

      $('td', row).eq(8).addClass('text-center text-nowrap').html('').append(
        '<button type="button" class="btn btn-default btn-xs icon-btn md-btn-flat user-tooltip" title="Edit"><i class="ion ion-md-create"></i></button>&nbsp;&nbsp;' +
        '<div class="btn-group">' +
          '<button type="button" class="btn btn-default btn-xs icon-btn md-btn-flat dropdown-toggle hide-arrow user-tooltip" title="Actions" data-toggle="dropdown"><i class="ion ion-ios-settings"></i></button>' +
          '<div class="dropdown-menu' + (isRtl ? '' : ' dropdown-menu-right') + '">' +
            '<a class="dropdown-item" href="javascript:void(0)">View profile</a>' +
            '<a class="dropdown-item" href="javascript:void(0)">Ban user</a>' +
            '<a class="dropdown-item" href="javascript:void(0)">Remove</a>' +
          '</div>' +
        '</div>'
      );

    }
  });

  // Tooltips

  $('body').tooltip({
    selector: '.user-tooltip'
  });

  // Filters

  $('#user-list-latest-activity').daterangepicker({
      opens: isRtl ? 'right' : 'left',
      autoUpdateInput: false,
      locale: {
        cancelLabel: 'Clear'
      }
  });

  $('#user-list-latest-activity').on('apply.daterangepicker', function(ev, picker) {
    $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
  });

  $('#user-list-latest-activity').on('cancel.daterangepicker', function(ev, picker) {
    $(this).val('');
  });

});
