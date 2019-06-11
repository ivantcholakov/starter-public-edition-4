$(function() {
  var $table = $('#bootstrap-table-example');
  var $remove = $('#bootstrap-table-remove');
  var selections = [];

  function getIdSelections() {
    return $.map($table.bootstrapTable('getSelections'), function (row) {
      return row.id;
    });
  }

  $table.bootstrapTable({
    height: 500,
    iconsPrefix: 'opacity-75 ion',
    icons: {
      paginationSwitchDown: 'ion-ios-arrow-down icon-chevron-down',
      paginationSwitchUp: 'ion-ios-arrow-up icon-chevron-up',
      refresh: 'ion-md-refresh icon-refresh',
      columns: 'ion-md-apps icon-th',
      detailOpen: 'ion-md-add icon-plus',
      detailClose: 'ion-md-remove icon-minus',
      export: 'ion-md-cloud-download icon-share'
    },
    detailFormatter: function detailFormatter(index, row) {
      var html = [];

      $.each(row, function (key, value) {
        html.push('<p><b>' + key + ':</b> ' + (typeof value === 'undefined' ? false : value) + '</p>');
      });

      return html.join('');
    },
    columns: [
      [
        {
          field: 'state',
          checkbox: true,
          rowspan: 2,
          align: 'center',
          valign: 'middle'
        }, {
          title: 'Item ID',
          field: 'id',
          rowspan: 2,
          align: 'center',
          valign: 'middle',
          sortable: true,
          footerFormatter: function totalTextFormatter(data) {
            return 'Total';
          }
        }, {
          title: 'Item Detail',
          colspan: 3,
          align: 'center'
        }
      ],
      [
        {
          field: 'name',
          title: 'Item Name',
          sortable: true,
          editable: true,
          footerFormatter: function totalNameFormatter(data) {
            return data.length;
          },
          align: 'center'
        }, {
          field: 'price',
          title: 'Item Price',
          sortable: true,
          align: 'center',
          editable: {
            type: 'text',
            title: 'Item Price',
            validate: function (value) {
              value = $.trim(value);

              if (!value) { return 'This field is required'; }
              if (!/^\$/.test(value)) { return 'This field needs to start width $.' }

              var data = $table.bootstrapTable('getData');
              var index = $(this).parents('tr').data('index');

              // console.log(data[index]);
              return '';
            }
          },
          footerFormatter: function totalPriceFormatter(data) {
            var total = 0;

            $.each(data, function (i, row) {
              total += +(row.price.substring(1));
            });

            return '$' + total;
          }
        }, {
          field: 'operate',
          title: 'Item Operate',
          align: 'center',
          events: {
            'click .like': function (e, value, row, index) {
              alert('You click like action, row: ' + JSON.stringify(row));
            },
            'click .remove': function (e, value, row, index) {
              $table.bootstrapTable('remove', {
                field: 'id',
                values: [row.id]
              });
            }
          },
          formatter: function operateFormatter(value, row, index) {
            return [
              '<a class="btn btn-xs icon-btn btn-outline-default borderless like" href="javascript:void(0)" title="Like">',
              '<i class="ion ion-md-heart"></i>',
              '</a>  ',
              '<a class="btn btn-xs icon-btn btn-outline-danger borderless remove" href="javascript:void(0)" title="Remove">',
              '<i class="ion ion-md-close"></i>',
              '</a>'
            ].join('');
          }
        }
      ]
    ]
  });


  // Make bootstrapTable compatible with Bootstrap 4
  if ($('body').attr('dir') !== 'rtl' && $('html').attr('dir') !== 'rtl') {
    $('.bootstrap-table .pull-right .dropdown-menu').addClass('dropdown-menu-right');
    $('.bootstrap-table .pull-left .dropdown-menu').removeClass('dropdown-menu-right');
  } else {
    $('.bootstrap-table .pull-left .dropdown-menu').addClass('dropdown-menu-right');
  }


  // sometimes footer render error.
  setTimeout(function () {
    $table.bootstrapTable('resetView');
  }, 200);

  $table.on('check.bs.table uncheck.bs.table ' + 'check-all.bs.table uncheck-all.bs.table', function () {
    $remove.prop('disabled', !$table.bootstrapTable('getSelections').length);
    // save your data, here just save the current page
    selections = getIdSelections();
    // push or splice the selections if you want to save all data selections
  });

  $table.on('all.bs.table', function(e, name, args) {
    // console.log(name, args);
  });

  $remove.click(function() {
    var ids = getIdSelections();

    $table.bootstrapTable('remove', {
      field: 'id',
      values: ids
    });
    $remove.prop('disabled', true);
  });

});
