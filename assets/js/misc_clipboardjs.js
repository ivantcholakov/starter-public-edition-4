$(function() {
  if (Clipboard.isSupported()) {
    new Clipboard('.clipboard-example-btn');
  } else {
    $('.clipboard-example-btn').prop('disabled', true);
  }
});
