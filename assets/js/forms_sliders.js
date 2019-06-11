// Bootstrap Slider
$(function() {
  $('#bs-slider-1').slider({
    formatter: function(value) {
      return 'Value: ' + value;
    },
  });

  $('#bs-slider-2').slider();

  $('#bs-slider-3').slider({
    reversed: true,
  });

  $('#bs-slider-4').slider({
    reversed: true,
  });

  $('#bs-slider-5').slider();

  $('#bs-slider-6').slider({
    ticks:        [0, 100, 200, 300, 400],
    ticks_labels: ['$0', '$100', '$200', '$300', '$400'],
  });

  $('#bs-slider-7').slider({
    ticks:        [0, 100, 200, 300, 400],
    ticks_labels: ['$0', '$100', '$200', '$300', '$400'],
    reversed:     true,
  });

  $('.bs-slider-variant').slider();
});

// noUiSlider
$(function() {
  var isRtl = $('body').attr('dir') === 'rtl' || $('html').attr('dir') === 'rtl';

  noUiSlider.create(document.getElementById('nouislider-1'), {
    start: [ 80 ],
    connect: [true, false],
    direction: isRtl ? 'rtl' : 'ltr',
    range: {
      'min': 0,
      'max': 100,
    }
  });

  // Vertical

  var slider = document.getElementById('nouislider-2');

  slider.style.height = '200px';
  slider.style.margin = '0 auto 30px';

  noUiSlider.create(slider, {
    start: [ 1450 ],
    connect: [true, false],
    orientation: 'vertical',
    direction: 'rtl',
    step: 150,
    range: {
      'min': 1300,
      'max': 3250
    }
  });

  // Range

  noUiSlider.create(document.getElementById('nouislider-3'), {
    start: [ 4000, 8000 ],
    step: 1000,
    connect: true,
    direction: isRtl ? 'rtl' : 'ltr',
    range: {
      'min': [  2000 ],
      'max': [ 10000 ]
    }
  });

  // Full

  noUiSlider.create(document.getElementById('nouislider-4'), {
    start: [ 1450, 2050, 2350, 3000 ],
    connect: true,
    behaviour: 'tap-drag',
    step: 150,
    tooltips: true,
    range: {
      'min': 1000,
      'max': 3750
    },
    pips: {
      mode: 'steps',
      stepped: true,
      density: 4
    },
    direction: isRtl ? 'rtl' : 'ltr',
  });

  var slider2 = document.getElementById('nouislider-5');

  slider2.style.height = '400px';
  slider2.style.margin = '0 auto 30px';

  noUiSlider.create(slider2, {
    start: [ 1450, 2050, 2350, 3000 ],
    connect: true,
    direction: 'rtl',
    orientation: 'vertical',
    behaviour: 'tap-drag',
    step: 150,
    tooltips: true,
    range: {
      'min': 1000,
      'max': 3750
    },
    pips: {
      mode: 'steps',
      stepped: true,
      density: 4
    }
  });

  // Colors

  var slider3 = document.getElementById('nouislider-6');
  var slider4 = document.getElementById('nouislider-7');
  var slider5 = document.getElementById('nouislider-8');
  var slider6 = document.getElementById('nouislider-9');
  var slider7 = document.getElementById('nouislider-10');
  var slider8 = document.getElementById('nouislider-11');
  var slider9 = document.getElementById('nouislider-12');

  var options =  {
    start: [ 2050, 3000 ],
    connect: true,
    behaviour: 'tap-drag',
    step: 150,
    tooltips: true,
    range: {
      'min': 1000,
      'max': 3750
    },
    pips: {
      mode: 'steps',
      stepped: true,
      density: 4
    },
    direction: isRtl ? 'rtl' : 'ltr'
  };

  noUiSlider.create(slider3, options);
  noUiSlider.create(slider4, options);
  noUiSlider.create(slider5, options);
  noUiSlider.create(slider6, options);
  noUiSlider.create(slider7, options);
  noUiSlider.create(slider8, options);
  noUiSlider.create(slider9, options);
});
