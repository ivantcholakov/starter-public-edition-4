// Bootstrap modals
$(function() {
  $('[name=modals-default-size]').on('change', function() {
    $('#modals-default .modal-dialog').removeClass('modal-sm').removeClass('modal-lg');

    if (this.value !== 'md') {
      $('#modals-default .modal-dialog').addClass('modal-' + this.value);
    }
  });

  $('[name=modals-top-size]').on('change', function() {
    $('#modals-top .modal-dialog').removeClass('modal-sm').removeClass('modal-lg');

    if (this.value !== 'md') {
      $('#modals-top .modal-dialog').addClass('modal-' + this.value);
    }
  });

  $('[name=modals-fill-in-size]').on('change', function() {
    $('#modals-fill-in .modal-dialog').removeClass('modal-sm').removeClass('modal-lg');

    if (this.value !== 'md') {
      $('#modals-fill-in .modal-dialog').addClass('modal-' + this.value);
    }
  });
});

// Bootbox
$(function() {
  $('#bootbox-alert').on('click', function() {
    bootbox.alert({
      message:   'Hello world!',
      className: 'bootbox-sm',

      callback: function() {
        alert('Hello world callback');
      },
    });
  });

  $('#bootbox-confirm').on('click', function() {
    bootbox.confirm({
      message:   'Are you sure?',
      className: 'bootbox-sm',

      callback: function(result) {
        alert('Confirm result: ' + result);
      },
    });
  });

  $('#bootbox-prompt').on('click', function() {
    bootbox.prompt({
      title: 'What is your name?',

      callback: function(result) {
        if (result === null) {
          alert('Prompt dismissed');
        } else {
          alert('Hi ' + result + '!');
        }
      },
    });
  });

  $('#bootbox-custom').on('click', function() {
    bootbox.dialog({
      title:     'Custom title',
      message:   'I am a custom dialog',
      className: 'bootbox-lg',

      buttons: {
        success: {
          label:     'Success!',
          className: 'btn-success',

          callback: function() {
            alert('great success');
          },
        },
        danger: {
          label:     'Danger!',
          className: 'btn-danger',

          callback: function() {
            alert('uh oh, look out!');
          },
        },
        main: {
          label:     'Click ME!',
          className: 'btn-primary',

          callback: function() {
            alert('Primary button');
          },
        }
      },
    });
  });
});

// Bootstrap SweetAlert
$(function() {
  $('#sweetalert-example-1').click(function(){
    swal("Here's a message!", "It's pretty, isn't it?")
  });

  $('#sweetalert-example-2').click(function(){
    swal({
      title: "Are you sure?",
      text: "You will not be able to recover this imaginary file!",
      type: "warning",
      showCancelButton: true,
      confirmButtonClass: "btn-danger",
      confirmButtonText: "Yes, delete it!",
      cancelButtonText: "No, cancel plx!",
      closeOnConfirm: false,
      closeOnCancel: false
    },
    function(isConfirm) {
      if (isConfirm) {
        swal("Deleted!", "Your imaginary file has been deleted.", "success");
      } else {
        swal("Cancelled", "Your imaginary file is safe :)", "error");
      }
    });
  });

  $('#sweetalert-example-3').click(function(){
    swal({
      title: "Ajax request example",
      text: "Submit to run ajax request",
      type: "info",
      showCancelButton: true,
      closeOnConfirm: false,
      showLoaderOnConfirm: true
    }, function () {
      setTimeout(function () {
        swal("Ajax request finished!");
      }, 2000);
    });
  });

  $('#sweetalert-example-4').click(function(){
    swal({
      title: "Are you sure?",
      text: "You will not be able to recover this imaginary file!",
      type: "info",
      showCancelButton: true,
      confirmButtonClass: 'btn-info',
      confirmButtonText: 'Info!'
    });
  });

  $('#sweetalert-example-5').click(function(){
    swal({
      title: "Are you sure?",
      text: "You will not be able to recover this imaginary file!",
      type: "success",
      showCancelButton: true,
      confirmButtonClass: 'btn-success',
      confirmButtonText: 'Success!'
    });
  });

  $('#sweetalert-example-6').click(function(){
    swal({
      title: "Are you sure?",
      text: "You will not be able to recover this imaginary file!",
      type: "warning",
      showCancelButton: true,
      confirmButtonClass: 'btn-warning',
      confirmButtonText: 'Warning!'
    });
  });

  $('#sweetalert-example-7').click(function(){
    swal({
      title: "Are you sure?",
      text: "You will not be able to recover this imaginary file!",
      type: "error",
      showCancelButton: true,
      confirmButtonClass: 'btn-danger',
      confirmButtonText: 'Danger!'
    });
  });
});
