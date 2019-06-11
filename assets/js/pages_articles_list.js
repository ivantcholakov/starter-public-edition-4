$(function() {

  var statuses = {
    1: ['Published', 'success'],
    2: ['Draft', 'info'],
    3: ['Deleted', 'default']
  };

  $('#article-list').dataTable({
    ajax: 'assets/json/pages_articles_list.json',
    columnDefs: [ {
      targets: [6],
      orderable: false,
      searchable: false
    }],
    createdRow: function (row, data, index) {

      // *********************************************************************
      // Article link

      $('td', row).eq(1).html('').append(
        '<a href="javascript:void(0)">' + data[1] + '</a>'
      );

      // *********************************************************************
      // Status

      $('td', row).eq(5).html('').append(
        '<span class="badge badge-outline-' + statuses[data[5]][1] + '">' + statuses[data[5]][0] + '</span>'
      );

      // *********************************************************************
      // Actions

      $('td', row).eq(6).addClass('text-center text-nowrap').html('').append(
        '<button type="button" class="btn btn-default btn-xs icon-btn md-btn-flat article-tooltip" title="Edit"><i class="ion ion-md-create"></i></button>&nbsp;&nbsp;' +
        '<button type="button" class="btn btn-default btn-xs icon-btn md-btn-flat article-tooltip" title="Remove"><i class="ion ion-md-close"></i></button>'
      );

    }
  });

  // Tooltips

  $('body').tooltip({
    selector: '.article-tooltip'
  });

});
