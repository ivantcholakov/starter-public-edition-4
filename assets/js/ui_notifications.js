// Growl
$(function() {
  var isRtl = $('body').attr('dir') === 'rtl' || $('html').attr('dir') === 'rtl';

  $('#growl-default').click(function() {
    $.growl({
      title:    'Growl',
      message:  'The kitten is awake!',
      location: isRtl ? 'tl' : 'tr'
    });
  });

  $('#growl-notice').click(function() {
    $.growl.notice({
      message:  'The kitten is cute!',
      location: isRtl ? 'tl' : 'tr'
    });
  });

  $('#growl-warning').click(function() {
    $.growl.warning({
      message:  'The kitten is ugly!',
      location: isRtl ? 'tl' : 'tr'
    });
  });

  $('#growl-error').click(function() {
    $.growl.error({
      message:  'The kitten is attacking!',
      location: isRtl ? 'tl' : 'tr'
    });
  });

  $('#growl-static').click(function() {
    $.growl({
      title:    'Growl',
      message:  'The kitten is awake!',
      duration: 9999 * 9999,
      location: isRtl ? 'tl' : 'tr'
    });
  });

  $('#growl-small').click(function() {
    $.growl({
      title:   'Growl',
      message: 'The kitten is awake!',
      size:    'small',
      location: isRtl ? 'tl' : 'tr'
    });
  });

  $('#growl-large').click(function() {
    $.growl({
      title:   'Growl',
      message: 'The kitten is awake!',
      size:    'large',
      location: isRtl ? 'tl' : 'tr'
    });
  });
});

// Toastr
$(function() {
  var curMsgIndex = -1;

  function getMessage() {
    var msgs = [
      'My name is Inigo Montoya. You killed my father. Prepare to die!',
      'Are you the six fingered man?',
      'Inconceivable!',
      'I do not think that means what you think it means.',
      'Have fun storming the castle!',
    ];

    curMsgIndex++;

    if (curMsgIndex === msgs.length) { curMsgIndex = 0; }

    return msgs[curMsgIndex];
  };

  $('#toastr-show').click(function() {
    var msg   = $('#toastr-message').val() || getMessage();
    var title = $('#toastr-title').val() || '';
    var type  = $('#toastr-type').val();

    toastr[type](msg, title, {
      positionClass:     $('input[name="toastr-position"]:checked').val(),
      closeButton:       $('#toastr-close-button').prop('checked'),
      progressBar:       $('#toastr-progress-bar').prop('checked'),
      preventDuplicates: $('#toastr-prevent-duplicates').prop('checked'),
      newestOnTop:       $('#toastr-newest-on-top').prop('checked'),
      rtl:               $('body').attr('dir') === 'rtl' || $('html').attr('dir') === 'rtl'
    });
  });

  $('#toastr-clear').on('click', function() {
    toastr.clear();
  });
});
