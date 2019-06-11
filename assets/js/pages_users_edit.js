$(function() {

  $('.user-edit-multiselect').each(function() {
    $(this)
      .wrap('<div class="position-relative"></div>')
      .select2({
        dropdownParent: $(this).parent()
      });
  });

  $('.user-edit-tagsinput').tagsinput({ tagClass: 'badge badge-default' });

});
