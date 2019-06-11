// Bootstrap Datepicker
$(function() {
  var isRtl = $('html').attr('dir') === 'rtl';

  $('#datepicker-base').datepicker({
    orientation: isRtl ? 'auto right' : 'auto left'
  });
  $('#datepicker-features').datepicker({
    calendarWeeks:         true,
    todayBtn:              'linked',
    daysOfWeekDisabled:    '1',
    clearBtn:              true,
    todayHighlight:        true,
    multidate:             true,
    daysOfWeekHighlighted: '1,2',
    orientation: isRtl ? 'auto left' : 'auto right',

    beforeShowMonth: function(date) {
      if (date.getMonth() === 8) {
        return false;
      }
    },

    beforeShowYear: function(date){
      if (date.getFullYear() === 2014) {
        return false;
      }
    }
  });
  $('#datepicker-range').datepicker({
    orientation: isRtl ? 'auto right' : 'auto left'
  });
  $('#datepicker-inline').datepicker();
});

// Bootstrap Daterangepicker
$(function() {
  var isRtl = $('body').attr('dir') === 'rtl' || $('html').attr('dir') === 'rtl';

  $('#daterange-1').daterangepicker({
    opens: (isRtl ? 'left' : 'right'),
    showWeekNumbers: true
  });

  $('#daterange-2').daterangepicker({
    timePicker: true,
    timePickerIncrement: 30,
    locale: {
      format: 'MM/DD/YYYY h:mm A'
    },
    opens: (isRtl ? 'left' : 'right')
  });

  $('#daterange-3').daterangepicker({
      singleDatePicker: true,
      showDropdowns: true,
      opens: (isRtl ? 'left' : 'right')
    }, function(start, end, label) {
      var years = moment().diff(start, 'years');

      alert("You are " + years + " years old.");
    }
  );

  // Button

  var start = moment().subtract(29, 'days');
  var end = moment();

  function cb(start, end) {
    $('#daterange-4').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
  }

  $('#daterange-4').daterangepicker({
    startDate: start,
    endDate: end,
    ranges: {
     'Today': [moment(), moment()],
     'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
     'Last 7 Days': [moment().subtract(6, 'days'), moment()],
     'Last 30 Days': [moment().subtract(29, 'days'), moment()],
     'This Month': [moment().startOf('month'), moment().endOf('month')],
     'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
   },
   opens: (isRtl ? 'left' : 'right')
  }, cb);

  cb(start, end);
});

// Bootstrap Material DateTimePicker
$(function() {
  $('#b-m-dtp-date').bootstrapMaterialDatePicker({
    weekStart: 0,
    time: false,
    clearButton: true
  });

  $('#b-m-dtp-time').bootstrapMaterialDatePicker({
    date: false,
    shortTime: false,
    format: 'HH:mm'
  });

  $('#b-m-dtp-datetime').bootstrapMaterialDatePicker({
    weekStart: 1,
    format : 'dddd DD MMMM YYYY - HH:mm',
    shortTime: true,
    nowButton : true,
    minDate : new Date()
  });
});

// jQuery Timepicker
$(function() {
  var isRtl = $('body').attr('dir') === 'rtl' || $('html').attr('dir') === 'rtl';

  $('#timepicker-example-1').timepicker({
    scrollDefault: 'now',
    orientation: (isRtl ? 'r' : 'l')
  });

  $('#timepicker-example-2').timepicker({
    minTime: '2:00pm',
    maxTime: '11:30pm',
    showDuration: true,
    orientation: (isRtl ? 'r' : 'l')
  });

  $('#timepicker-example-3').timepicker({
    disableTimeRanges: [
      ['1am', '2am'],
      ['3am', '4:01am']
    ],
    orientation: (isRtl ? 'r' : 'l')
  });

  $('#timepicker-example-4').timepicker({
    'timeFormat': 'H:i:s',
    orientation: (isRtl ? 'r' : 'l')
  });
  $('#timepicker-example-5').timepicker({
    'timeFormat': 'h:i A',
    orientation: (isRtl ? 'r' : 'l')
  });

  $('#timepicker-example-6').timepicker({
    'step': 15,
    orientation: (isRtl ? 'r' : 'l')
  });
});

// Minicolors
$(function() {
  var isRtl = $('body').attr('dir') === 'rtl' || $('html').attr('dir') === 'rtl';

  $('#minicolors-hue').minicolors({
    control:  'hue',
    position: 'bottom ' + (isRtl ? 'right' : 'left'),
  });

  $('#minicolors-saturation').minicolors({
    control:  'saturation',
    position: 'bottom ' + (isRtl ? 'left' : 'right'),
  });

  $('#minicolors-wheel').minicolors({
    control:  'wheel',
    position: 'top ' + (isRtl ? 'left' : 'right'),
  });

  $('#minicolors-opacity').minicolors({
    control: 'wheel',
    opacity: true,
    position: 'bottom ' + (isRtl ? 'right' : 'left'),
  });

  $('#minicolors-brightness').minicolors({
    control:  'brightness',
    position: 'top ' + (isRtl ? 'right' : 'left'),
  });

  $('#minicolors-hidden').minicolors({
    position: 'top ' + (isRtl ? 'right' : 'left'),
  });
});
