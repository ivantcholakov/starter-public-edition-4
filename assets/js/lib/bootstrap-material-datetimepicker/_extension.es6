const originalPicker = $.fn.bootstrapMaterialDatePicker;

$.fn.bootstrapMaterialDatePicker = function (...args) {
  this.each(function() {
    const newInstance = !$.data(this, 'plugin_bootstrapMaterialDatePicker');

    originalPicker.apply($(this), args);

    if (newInstance) {
      const $template = $('body').find(`> #${$.data(this, 'plugin_bootstrapMaterialDatePicker').name}`);

      // Add animation
      $template.addClass('animated fadeIn')

      // Styling buttons
      $template.find('.dtp-btn-now,.dtp-btn-clear,.dtp-btn-cancel').addClass('btn-default btn-sm');
      $template.find('.dtp-btn-ok').addClass('btn-primary btn-sm');
    }
  });

  return this;
};
