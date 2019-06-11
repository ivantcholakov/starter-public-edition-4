$(function() {
  // Tooltips

  if ($('html').attr('dir') === 'rtl') {
    $('.tooltip-demo [data-placement=right]').attr('data-placement', 'left').addClass('rtled');
    $('.tooltip-demo [data-placement=left]:not(.rtled)').attr('data-placement', 'right').addClass('rtled');
  }
  $('[data-toggle="tooltip"]').tooltip();

  // Popovers

  if ($('html').attr('dir') === 'rtl') {
    $('.popover-demo [data-placement=right]').attr('data-placement', 'left').addClass('rtled');
    $('.popover-demo [data-placement=left]:not(.rtled)').attr('data-placement', 'right').addClass('rtled');
  }
  $('[data-toggle="popover"]').popover();

});
