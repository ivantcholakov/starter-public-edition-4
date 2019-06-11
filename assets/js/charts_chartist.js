$(function() {
  new Chartist.Line('#chartist-graph', {
    labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'],
    series: [
      [ 8, 14, 5, 13, 12 ],
      [ 7, 8, 1, 3, 1 ],
      [ 5, 12, 1, 9, 7 ]
    ],
  }, {
    fullWidth: true,
    chartPadding: {
      right: 40
    }
  });

  new Chartist.Line('#chartist-bi-polar', {
    labels: [1, 2, 3, 4, 5, 6, 7, 8],
    series: [
      [ 1, -1, -2, 0, 2, -1, -2, -1 ],
      [ -2, -1, 0, -3, -2, 1, -3, 2 ],
      [ 2, -1, -1, -3, -2, 0, -1, 1 ],
      [ 1, -3, 2, -3, -3, 2, -2, -3 ] ]
  }, {
    high: 3,
    low: -3,
    showArea:  true,
    showLine:  false,
    showPoint: false,
    fullWidth: true,
    axisX: {
      showLabel: false,
      showGrid:  false
    }
  });

  new Chartist.Bar('#chartist-bars', {
    labels: ['First quarter of the year', 'Second quarter of the year', 'Third quarter of the year', 'Fourth quarter of the year'],
    series: [
      [ 75177, 30327, 33902, 45922 ],
      [ 67592, 31235, 64863, 78175 ],
      [ 1978, 1951, 8121, 8132 ] ]
  }, {
    seriesBarDistance: 10,
    axisX: { offset: 60 },
    axisY: {
      offset:        80,
      scaleMinSpace: 15,

      labelInterpolationFnc: function(value) {
        return value + ' CHF';
      },
    },
  });

  new Chartist.Bar('#chartist-h-bars', {
    labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
    series: [
      [ 8, 2, 8, 2, 1, 4, 5 ],
      [ 5, 1, 7, 4, 6, 5, 6 ] ]
  }, {
    seriesBarDistance: 10,
    reverseData:       true,
    horizontalBars:    true,
    axisY:             { offset: 70 }
  });

  function sum(a, b) {
    return a + b;
  }
  var pieData = {
    series: [ 3, 5, 7 ],
  };
  new Chartist.Pie('#chartist-pie', pieData, {
    labelInterpolationFnc: function(value) {
      return Math.round(value / pieData.series.reduce(sum) * 100) + '%';
    }
  });

  new Chartist.Pie('#chartist-gauge', {
    series: [20, 10, 30, 40],
  }, {
    donut:      true,
    donutWidth: 60,
    startAngle: 270,
    total:      200,
    showLabel:  false
  });
});
