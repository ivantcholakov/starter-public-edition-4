$(function() {
  // Initialize Select2 select box
  $('select[name="validation-select2"]').select2({
    allowClear:  true,
    placeholder: 'Select a framework...',
  }).change(function() {
    $(this).valid();
  });

  // Initialize Select2 multiselect box
  $('select[name="validation-select2-multi"]').select2({
    placeholder: 'Select gear...',
  }).change(function() {
    $(this).valid();
  });

  // Trigger validation on tagsinput change
  $('input[name="validation-bs-tagsinput"]').on('itemAdded itemRemoved', function() {
    $(this).valid();
  });

  // Add phone validator
  $.validator.addMethod(
    'phone_format',
    function(value, element) {
      return this.optional(element) || /^\(\d{3}\)[ ]\d{3}\-\d{4}$/.test(value);
    },
    'Invalid phone number.'
  );

  // Initialize validation
  $('#validation-form').validate({
    ignore: '.ignore, .select2-input',
    focusInvalid: false,
    rules: {
      'validation-email': {
        required: true,
        email: true
      },
      'validation-password': {
        required: true,
        minlength: 6,
        maxlength: 20
      },
      'validation-password-confirmation': {
        required: true,
        minlength: 6,
        equalTo: 'input[name="validation-password"]'
      },
      'validation-required': {
        required: true
      },
      'validation-url': {
        required: true,
        url: true
      },
      'validation-phone': {
        required: true,
        phone_format: true
      },
      'validation-select': {
        required: true
      },
      'validation-multiselect': {
        required: true,
        minlength: 2
      },
      'validation-select2': {
        required: true
      },
      'validation-select2-multi': {
        required: true,
        minlength: 2
      },
      'validation-bs-tagsinput': {
        required: true
      },
      'validation-text': {
        required: true
      },
      'validation-file': {
        required: true
      },
      'validation-switcher': {
        required: true
      },
      'validation-radios': {
        required: true
      },
      'validation-radios-custom': {
        required: true
      },
      'validation-checkbox': {
        required: true
      },
      'validation-checkbox-custom': {
        required: true
      },

      // Checkbox groups
      //

      'validation-checkbox-group-1': {
        require_from_group: [1, 'input[name="validation-checkbox-group-1"], input[name="validation-checkbox-group-2"]']
      },
      'validation-checkbox-group-2': {
        require_from_group: [1, 'input[name="validation-checkbox-group-1"], input[name="validation-checkbox-group-2"]']
      },

      'validation-checkbox-custom-group-1': {
        require_from_group: [1, 'input[name="validation-checkbox-custom-group-1"], input[name="validation-checkbox-custom-group-2"]']
      },
      'validation-checkbox-custom-group-2': {
        require_from_group: [1, 'input[name="validation-checkbox-custom-group-1"], input[name="validation-checkbox-custom-group-2"]']
      }
    },

    // Errors
    //

    errorPlacement: function errorPlacement(error, element) {
      var $parent = $(element).parents('.form-group');

      // Do not duplicate errors
      if ($parent.find('.jquery-validation-error').length) { return; }

      $parent.append(
        error.addClass('jquery-validation-error small form-text invalid-feedback')
      );
    },
    highlight: function(element) {
      var $el = $(element);
      var $parent = $el.parents('.form-group');

      $el.addClass('is-invalid');

      // Select2 and Tagsinput
      if ($el.hasClass('select2-hidden-accessible') || $el.attr('data-role') === 'tagsinput') {
        $el.parent().addClass('is-invalid');
      }
    },
    unhighlight: function(element) {
      $(element).parents('.form-group').find('.is-invalid').removeClass('is-invalid');
    }
  });

});
