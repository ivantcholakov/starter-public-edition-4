$(function() {

  var isRtl = $('body').attr('dir') === 'rtl' || $('html').attr('dir') === 'rtl';

  var statuses = {
    1: ['Published', 'success'],
    2: ['Out of stock', 'danger'],
    3: ['Pending', 'info']
  };

  $('#product-list').dataTable({
    ajax: 'assets/json/pages_e-commerce_product-list.json',
    "columns": [
      { "data": "1" },
      { "data": "2" },
      { "data": "3" },
      { "data": "4" },
      { "data": "5" },
      { "data": "6" },
      { "data": "7" },
      { "data": "8" }
    ],
    order: [[ 1, 'desc' ]],
    columnDefs: [ {
      targets: [7],
      orderable: false,
      searchable: false
    }],
    createdRow: function (row, data, index) {
      // Add extra padding and set minimum width
      $('td', row).addClass('py-2 align-middle').eq(0).css('min-width', '300px');

      // *********************************************************************
      // Product name

      $('td', row).eq(0).html('').append(
        '<div class="media align-items-center">' +
          '<img class="ui-w-40 d-block" src="assets/img/uikit/' + data[0] + '" alt="">' +
          '<a href="javascript:void(0)" class="media-body d-block text-dark ml-3">' + data[1] + '</a>' +
        '</div>'
      );

      // *********************************************************************
      // Price

      $('td', row).eq(3).html('').append(
        numeral(data[4]).format('$0,0.00')
      );

      // *********************************************************************
      // Views

      $('td', row).eq(5).html('').append(
        numeral(data[6]).format('0,0')
      );

      // *********************************************************************
      // Status

      $('td', row).eq(6).html('').append(
        '<span class="badge badge-outline-' + statuses[data[7]][1] + '">' + statuses[data[7]][0] + '</span>'
      );

      // *********************************************************************
      // Actions

      $('td', row).eq(7).addClass('text-nowrap').html('').append(
        '<a href="javascript:void(0)" class="btn btn-default btn-xs icon-btn md-btn-flat product-tooltip" title="Show"><i class="ion ion-md-eye"></i></a>&nbsp;' +
        '<a href="javascript:void(0)" class="btn btn-default btn-xs icon-btn md-btn-flat product-tooltip" title="Edit"><i class="ion ion-md-create"></i></a>'
      );

    }
  });

  // Filters

  noUiSlider
    .create(document.getElementById('product-sales-slider'), {
      start: [ 10, 834 ],
      step: 10,
      connect: true,
      tooltips: true,
      direction: isRtl ? 'rtl' : 'ltr',
      range: {
        'min': [  10 ],
        'max': [ 834 ]
      },
      format: {
    	  to: function (value) {
    		  return Math.round(value);
    	  },
    	  from: function (value) {
    		  return value;
    	  }
    	}
    })
    .on('update', function(values) {
      document.getElementById('product-sales-slider-value').innerHTML = values.join(' - ')
    });

  noUiSlider
    .create(document.getElementById('product-price-slider'), {
      start: [ 10, 2000 ],
      step: 50,
      connect: true,
      tooltips: true,
      direction: isRtl ? 'rtl' : 'ltr',
      range: {
        'min': [ 10 ],
        'max': [ 2000 ]
      },
      format: {
    	  to: function (value) {
          return numeral(value).format('$0,0');
    	  },
    	  from: function (value) {
          return value.replace(/[\$\,]/g, '');
    	  }
    	}
    })
    .on('update', function(values) {
      document.getElementById('product-price-slider-value').innerHTML = values.join(' - ')
    });

  // Tooltips

  $('body').tooltip({
    selector: '.product-tooltip'
  });

});
