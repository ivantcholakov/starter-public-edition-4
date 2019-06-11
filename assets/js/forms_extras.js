// Autosize
$(function() {
  autosize($('#autosize-demo'));
});

// Vanilla Text Mask
$(function() {
  // Phone
  //

  vanillaTextMask.maskInput({
    inputElement: $('#text-mask-phone')[0],
    mask: ['(', /[1-9]/, /\d/, /\d/, ')', ' ', /\d/, /\d/, /\d/, '-', /\d/, /\d/, /\d/, /\d/]
  });

  // Number
  //

  vanillaTextMask.maskInput({
    inputElement: $('#text-mask-number')[0],
    mask: textMaskAddons.createNumberMask({
      prefix: '$'
    })
  });

  // Email
  //

  vanillaTextMask.maskInput({
    inputElement: $('#text-mask-email')[0],
    mask: textMaskAddons.emailMask
  });

  // Date
  //

  vanillaTextMask.maskInput({
    inputElement: $('#text-mask-date')[0],
    mask: [/\d/, /\d/, '/', /\d/, /\d/, '/', /\d/, /\d/, /\d/, /\d/],
    pipe: textMaskAddons.createAutoCorrectedDatePipe('mm/dd/yyyy')
  });
});

// Knob
$(function() {
  $('.knob-example input').knob();
});

// Bootstrap Maxlength
$(function() {
  $('.bootstrap-maxlength-example').each(function() {
    $(this).maxlength({
      warningClass: 'label label-success',
      limitReachedClass: 'label label-danger',
      separator: ' out of ',
      preText: 'You typed ',
      postText: ' chars available.',
      validate: true,
      threshold: +this.getAttribute('maxlength')
    });
  });
});

// Pwstrength-bootstrap
$(function() {
  $('#pwstrength-example').pwstrength({
    ui: {
      progressExtraCssClasses: 'pwstrength-progress',
      useVerdictCssClass: true,
      showErrors: true
    }
  });
});
