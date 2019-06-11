$(function() {

  // Checkboxes

  $('.file-manager-container').on('change', '.file-item-checkbox input', function() {
    $(this).parents('.file-item')[this.checked ? 'addClass': 'removeClass']('selected border-primary');
  });

  // Focus

  $('.file-manager-container').on('focusin', '.file-item', function() {
    $(this).addClass('focused');
  });

  $('.file-manager-container').on('focusout', '.file-item', function() {
    if ($('.file-item-actions.show').length) return;
    $(this).removeClass('focused');
  });

  $('.file-manager-container').on('hide.bs.dropdown', '.file-item-actions', function() {
    if ($(this).parents('.file-item').find(':focus').length) return;
    $(this).parents('.file-item').removeClass('focused');
  });

  // Change view

  $('[name="file-manager-view"]').on('change', function() {
    $('.file-manager-container')
      .removeClass('file-manager-col-view file-manager-row-view')
      .addClass(this.value);
  });

  // RTL

  if ($('html').attr('dir') === 'rtl') {
    $('.file-manager-actions .dropdown-menu').addClass('dropdown-menu-right');
    $('.file-item-actions .dropdown-menu').removeClass('dropdown-menu-right');
  }

});
