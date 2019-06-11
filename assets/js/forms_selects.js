// Bootstrap Select
$(function () {
  $('.selectpicker').selectpicker();
});

// Bootstrap Multiselect
$(function() {
  $('#bs-multiselect-1,#bs-multiselect-2,#bs-multiselect-3').multiselect();
  $('#bs-multiselect-4').multiselect({
    enableClickableOptGroups: true,
    enableCollapsibleOptGroups: true,
    enableFiltering: true,
    includeSelectAllOption: true,
    buttonWidth: '100%',
    maxHeight: 400,
    dropUp: true,
    templates: {
      filter: '<li class="multiselect-item filter"><div class="input-group input-group-sm"><span class="input-group-prepend"><span class="input-group-text"><i class="ion ion-ios-search"></i></span></span><input class="form-control multiselect-search" type="text"></div></li>',
      filterClearBtn: '<span class="input-group-append"><button class="btn btn-default multiselect-clear-filter" type="button"><i class="ion ion-md-close"></i></button></span>',
    }
  });

  // RTL
  if ($('html').attr('dir') === 'rtl') {
    $('#bs-multiselect-1,#bs-multiselect-2,#bs-multiselect-3,#bs-multiselect-4')
      .next('.btn-group')
      .find('.dropdown-menu')
      .addClass('dropdown-menu-right');
  }
});

// Select2
$(function() {
  $('.select2-demo').each(function() {
    $(this)
      .wrap('<div class="position-relative"></div>')
      .select2({
        placeholder: 'Select value',
        dropdownParent: $(this).parent()
      });
  })
});

// Bootstrap Tagsinput
$(function() {
  var $el = $('#bs-tagsinput-1');

  $el.tagsinput({
    tagClass: function(item) {
      switch (item.continent) {
        case 'Europe'   : return 'badge badge-primary';
        case 'America'  : return 'badge badge-danger';
        case 'Australia': return 'badge badge-success';
        case 'Africa'   : return 'badge badge-default';
        case 'Asia'     : return 'badge badge-warning';
      }
    },

    itemValue: 'value',
    itemText:  'text',
  });

  $el.tagsinput('add', { value: 1,  text: 'Amsterdam',  continent: 'Europe' });
  $el.tagsinput('add', { value: 4,  text: 'Washington', continent: 'America' });
  $el.tagsinput('add', { value: 7,  text: 'Sydney',     continent: 'Australia' });
  $el.tagsinput('add', { value: 10, text: 'Beijing',    continent: 'Asia' });
  $el.tagsinput('add', { value: 13, text: 'Cairo',      continent: 'Africa' });

  $('#bs-tagsinput-2').tagsinput({ tagClass: 'badge badge-primary' });
  $('#bs-tagsinput-3').tagsinput({ tagClass: 'badge badge-secondary' });
  $('#bs-tagsinput-4').tagsinput({ tagClass: 'badge badge-success' });
  $('#bs-tagsinput-5').tagsinput({ tagClass: 'badge badge-info' });
  $('#bs-tagsinput-6').tagsinput({ tagClass: 'badge badge-warning' });
  $('#bs-tagsinput-7').tagsinput({ tagClass: 'badge badge-danger' });
  $('#bs-tagsinput-8').tagsinput({ tagClass: 'badge badge-dark' });
});
