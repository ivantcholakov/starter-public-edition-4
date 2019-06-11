$(function() {

  // Collapse sidenav by default
  window.layoutHelpers.setCollapsed(true, false);

  // Enable tooltips
  $('.messages-tooltip').tooltip();

  $('.messages-scroll').each(function() {
    new PerfectScrollbar(this, {
      suppressScrollX: true,
      wheelPropagation: true
    });
  });

  $('.messages-sidebox-toggler').click(function(e) {
    e.preventDefault();
    $('.messages-wrapper, .messages-card').toggleClass('messages-sidebox-open');
  });

  // New message
  // {

    if (!window.Quill) {
      $('#message-editor,#message-editor-toolbar').remove();
      $('#message-editor-fallback').removeClass('d-none');
    } else {
      $('#message-editor-fallback').remove();
      new Quill('#message-editor', {
        modules: {
          toolbar: '#message-editor-toolbar'
        },
        placeholder: 'Type your message...',
        theme: 'snow'
      });
    }

  // }

});
