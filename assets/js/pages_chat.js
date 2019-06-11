$(function() {

  $('.chat-scroll').each(function() {
    new PerfectScrollbar(this, {
      suppressScrollX: true,
      wheelPropagation: true
    });
  });

  $('.chat-sidebox-toggler').click(function(e) {
    e.preventDefault();
    $('.chat-wrapper').toggleClass('chat-sidebox-open');
  });

});
