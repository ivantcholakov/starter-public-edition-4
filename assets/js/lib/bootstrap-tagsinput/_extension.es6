// Fix input position calculation
//

const tagsinputBuild   = $.fn.tagsinput.Constructor.prototype.build;
const tagsinputDestroy = $.fn.tagsinput.Constructor.prototype.destroy;

$.fn.tagsinput.Constructor.prototype.build = function(options) {
  if (options && options.typeahead) {
    $.extend(options.typeahead, {
      minLength: 1,
      afterSelect: () => {
        this.$input[0].value = '';
        this.$input.data('typeahead').lookup('');
      }
    });
  }

  const result = tagsinputBuild.call(this, options);
  const re     = /<|>/g;

  this.$inpWidth = $('<div class="bootstrap-tagsinput-input" style="position:absolute;z-index:-101;top:-9999px;opacity:0;white-space:nowrap;"></div>');
  $('<div style="position:absolute;width:0;height:0;z-index:-100;opacity:0;overflow:hidden;"></div>').append(this.$inpWidth).prependTo(this.$container);

  const getWidth = val => Math.ceil(this.$inpWidth.html((val || '').replace(re, '#')).outerWidth() + 12) + 'px';

  this.$input[0].style.width = getWidth();
  this.$input.on('keydown keyup focusout', function() {
    this.style.width = getWidth(this.value);

    if (this.value.length < 1 && options && options.typeahead) {
      $(this).data('typeahead').lookup('');
    }
  });
  this.$input.on('paste', function() {
    setTimeout($.proxy(function() { this.style.width = getWidth(this.value); }, this), 100);
  });

  return result;
};

$.fn.tagsinput.Constructor.prototype.destroy = function() {
  this.$input.off('keydown keyup focusout paste change');

  return tagsinputDestroy.call(this);
};

// Re-initialize [data-role=tagsinput]
$(function() {
  $('input[data-role=tagsinput], select[multiple][data-role=tagsinput]').tagsinput('destroy');
  $('input[data-role=tagsinput], select[multiple][data-role=tagsinput]').tagsinput();
});
