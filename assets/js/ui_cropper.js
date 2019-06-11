$(function () {
  $('[data-toggle="cropper-example-tooltip"]').tooltip({ container: 'body' });

  var URL = window.URL || window.webkitURL;
  var $image = $('#cropper-example-image');
  var $download = $('#cropper-example-download');
  var options = {
    aspectRatio: 16 / 9,
    preview: '.cropper-example-preview',
    crop: function (e) {
      $('#cropper-example-dataX').val(Math.round(e.detail.x));
      $('#cropper-example-dataY').val(Math.round(e.detail.y));
      $('#cropper-example-dataHeight').val(Math.round(e.detail.height));
      $('#cropper-example-dataWidth').val(Math.round(e.detail.width));
      $('#cropper-example-dataRotate').val(e.detail.rotate);
      $('#cropper-example-dataScaleX').val(e.detail.scaleX);
      $('#cropper-example-dataScaleY').val(e.detail.scaleY);
    }
  };

  var originalImageURL = $image.attr('src');
  var uploadedImageURL;

  // Cropper
  $image.cropper(options);

  // IE10 fix
  if (typeof document.documentMode === 'number' && document.documentMode < 11) {
    options = $.extend({}, options, {zoomOnWheel: false});
    setTimeout(function() {
      $image.cropper('destroy').cropper(options);
    }, 1000);
  }

  // Buttons
  if (!$.isFunction(document.createElement('canvas').getContext)) {
    $('button[data-method="getCroppedCanvas"]').prop('disabled', true);
  }
  if (typeof document.createElement('cropper').style.transition === 'undefined') {
    $('button[data-method="rotate"]').prop('disabled', true);
    $('button[data-method="scale"]').prop('disabled', true);
  }


  // Download
  if (typeof $download[0].download === 'undefined') {
    $download.addClass('disabled');
  }

  // Methods
  $('.cropper-example-buttons').on('click', '[data-method]', function () {
    var $this = $(this);
    var data = $this.data();
    var result;

    if ($this.prop('disabled') || $this.hasClass('disabled')) {
      return;
    }

    if ($image.data('cropper') && data.method) {
      data = $.extend({}, data); // Clone a new one

      if (data.method === 'rotate') {
        $image.cropper('clear');
      }

      result = $image.cropper(data.method, data.option, data.secondOption);

      if (data.method === 'rotate') {
        $image.cropper('crop');
      }

      switch (data.method) {
        case 'scaleX':
        case 'scaleY':
          $(this).data('option', -data.option);
          break;

        case 'getCroppedCanvas':
          if (result) {

            // Bootstrap's Modal
            $('#cropper-example-getCroppedCanvasModal').modal().find('.modal-body').html(result);

            if (!$download.hasClass('disabled')) {
              $download.attr('href', result.toDataURL('image/jpeg'));
            }
          }

          break;

        case 'destroy':
          if (uploadedImageURL) {
            URL.revokeObjectURL(uploadedImageURL);
            uploadedImageURL = '';
            $image.attr('src', originalImageURL);
          }

          break;
      }
    }
  });

  // Import image
  var $inputImage = $('#cropper-example-inputImage');

  if (URL) {
    $inputImage.change(function () {
      var files = this.files;
      var file;

      if (!$image.data('cropper')) {
        return;
      }

      if (files && files.length) {
        file = files[0];

        if (/^image\/\w+$/.test(file.type)) {
          if (uploadedImageURL) {
            URL.revokeObjectURL(uploadedImageURL);
          }

          uploadedImageURL = URL.createObjectURL(file);
          $image.cropper('destroy').attr('src', uploadedImageURL).cropper(options);
          $inputImage.val('');
        } else {
          window.alert('Please choose an image file.');
        }
      }
    });
  } else {
    $inputImage.prop('disabled', true).parent().addClass('disabled');
  }
});
