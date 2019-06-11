$(function() {

  $('.product-edit-multiselect').each(function() {
    $(this)
      .wrap('<div class="position-relative"></div>')
      .select2({
        dropdownParent: $(this).parent()
      });
  });

  if (!window.Quill) {
    $('#product-editor,#product-editor-toolbar').remove();
    $('#product-editor-fallback').removeClass('d-none');
  } else {
    $('#product-editor-fallback').remove();
    new Quill('#product-editor', {
      modules: {
        toolbar: '#product-editor-toolbar'
      },
      theme: 'snow'
    });
  }

  $('.product-discount-period').daterangepicker({
      opens: ($('body').attr('dir') === 'rtl' || $('html').attr('dir') === 'rtl') ? 'right' : 'left',
      autoUpdateInput: false,
      locale: {
        cancelLabel: 'Clear'
      }
  });

  $('.product-discount-period').on('apply.daterangepicker', function(ev, picker) {
    $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
  });

  $('.product-discount-period').on('cancel.daterangepicker', function(ev, picker) {
    $(this).val('');
  });

  dragula([document.getElementById('product-images')], {
    moves: function (el, container, handle) {
      return handle.classList.contains('product-image-move');
    }
  });

});
