// Extend sparkline plugin to handle resizing
//

// Inline id generator
function getUniqueId(){let t=(Math.floor(25*Math.random())+10).toString(36)+"_";t+=(new Date).getTime().toString(36)+"_";do t+=Math.floor(35*Math.random()).toString(36);while(t.length<32);return t;}

// Defaults
const DEFAULT_BAR_SPACING = '2px';

// Definition
//

class SparklineExt {
  constructor(element, values, config) {
    this.uniqueId = getUniqueId();

    this.element = element;
    this.$parent = $(element.parentNode);

    this.update(values, config);

    this._setListeners();
  }

  // public

  update(values, config) {
    if (values !== null) {
      this._values = values;
    }

    if (config !== null) {
      // Set defaults
      if (config.width === '100%' && (config.type === 'bar' || config.type === 'tristate') && typeof config.barSpacing === 'undefined') {
        config.barSpacing = DEFAULT_BAR_SPACING;
      }

      this.config = config;
    }

    // Copy config
    const _config = $.extend(true, {}, this.config);

    if (_config.width === '100%') {
      if (_config.type === 'bar' || _config.type === 'tristate') {
        _config.barWidth = this._getBarWidth(this.$parent, this._values.length, _config.barSpacing);
      } else {
        _config.width = Math.floor(this.$parent.width());
      }
    }

    $(this.element).sparkline(this._values, _config);
  }

  destroy() {
    this._unsetListeners();
    $(this.element)
      .removeData('sparklineExt')
      .removeData('_jqs_mhandler')
      .removeData('_jqs_vcanvas')
      .off()
      .find('canvas').remove();
  }

  // private

  _getBarWidth($parent, barsCount, spacer) {
    const width = $parent.width();
    const span  = parseInt(spacer, 10) * (barsCount - 1);

    return Math.floor((width - span) / barsCount);
  }

  _setListeners() {
    $(window).on(`resize.sparklineExt.${this.uniqueId}`, () => {
      if (this.config.width !== '100%') { return; }

      // Copy config
      const _config = $.extend(true, {}, this.config);

      if (_config.type === 'bar' || _config.type === 'tristate') {
        _config.barWidth = this._getBarWidth(this.$parent, this._values.length, _config.barSpacing);
      } else {
        _config.width = Math.floor(this.$parent.width());
      }

      $(this.element).sparkline(this._values, _config);
    });
  }

  _unsetListeners() {
    $(window).off(`resize.sparklineExt.${this.uniqueId}`);
  }

  // static

  static _parseArgs(element, args) {
    let values;
    let config;

    if (Object.prototype.toString.call(args[0]) === '[object Array]' || args[0] === 'html' || args[0] === null) {
      values = args[0];
      config = args[1] || null;
    } else {
      config = args[0] || null;
    }

    if ((values === 'html' || values === undefined) && values !== null) {
      values = element.getAttribute('values');

      if (values === undefined || values === null) {
        values = $(element).html();
      }

      values = values.replace(/(^\s*<!--)|(-->\s*$)|\s+/g, '').split(',');
    }

    if (!values || Object.prototype.toString.call(values) !== '[object Array]' || values.length === 0) {
      values = null;
    }

    return { values, config };
  }

  static _jQueryInterface(...args) {
    return this.each(function() {
      let data     = $(this).data('sparklineExt');
      const method = (args[0] === 'update' || args[0] === 'destroy') ? args[0] : null;

      const { values, config } = SparklineExt._parseArgs(this, method ? args.slice(1) : args);

      if (!data) {
        data = new SparklineExt(this, values || [], config || {});
        $(this).data('sparklineExt', data);
      } else if (values) {
        data.update(values, config);
      }

      if (method === 'update') {
        data.update(values, config);
      } else if (method === 'destroy') {
        data.destroy();
      }
    });
  }
}

// jQuery
//

$.fn.sparkline2             = SparklineExt._jQueryInterface;
$.fn.sparkline2.Constructor = SparklineExt;
$.fn.sparkline2.noConflict  = function() {
  $.fn.sparkline2 = JQUERY_NO_CONFLICT;
  return SparklineExt._jQueryInterface;
};
