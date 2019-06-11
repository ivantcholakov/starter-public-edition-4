$(function() {

  $('.account-settings-multiselect').each(function() {
    $(this)
      .wrap('<div class="position-relative"></div>')
      .select2({
        dropdownParent: $(this).parent()
      });
  });

  $('.account-settings-tagsinput').tagsinput({ tagClass: 'badge badge-default' });

});
