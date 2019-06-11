$(function() {
  var gridColor = '#aaaaaa';
  var gridBorder = '#eeeeee';
  var legendBg = '#f5f5f5';

  $.plot($('#flot-graph'), [
    {
      label: 'Visits',
      data: [
        [ 6, 196 ], [ 7, 175 ], [ 8, 212 ], [ 9, 247 ], [ 10, 152 ], [ 11, 225 ], [ 12, 155 ], [ 13, 203 ], [ 14, 166 ], [ 15, 151 ]
      ]
    },
    {
      label: 'Returning visits',
      data: [
        [ 6, 49 ], [ 7, 56 ], [ 8, 30 ], [ 9, 29 ], [ 10, 66 ], [ 11, 2 ], [ 12, 2 ], [ 13, 8 ], [ 14, 34 ], [ 15, 63 ]
      ]
    }
  ], {
    series: {
      shadowSize: 0,
      lines: {
        show: true
      },
      points: {
        show: true,
        radius: 4
      }
    },

    grid: {
      color: gridColor,
      borderColor: gridBorder,
      borderWidth: 1,
      hoverable: true,
      clickable: true
    },

    xaxis: { tickColor: gridBorder, },
    yaxis: { tickColor: gridBorder, },
    legend: { backgroundColor: legendBg },
    tooltip: { show: true },
    colors: ["#607D8B", "#4CAF50"]
  });

  $.plot($('#flot-bars'), [
    {
      label: 'Visits',
      data: [
        [ 6, 156 ], [ 7, 195 ], [ 8, 171 ], [ 9, 211 ], [ 10, 150 ], [ 11, 169 ], [ 12, 173 ], [ 13, 200 ], [ 14, 233 ], [ 15, 161 ]
      ]
    },
    {
      label: 'Returning visits',
      data: [
        [ 6, 24 ], [ 7, 20 ], [ 8, 31 ], [ 9, 4 ], [ 10, 92 ], [ 11, 87 ], [ 12, 28 ], [ 13, 21 ], [ 14, 80 ], [ 15, 76 ]
      ]
    }
  ], {
    series: {
      shadowSize: 0,
      bars: {
        show: true,
        barWidth: .6,
        align: 'center',
        lineWidth: 1,
        fill: 0.25
      }
    },

    grid: {
      color: gridColor,
      borderColor: gridBorder,
      borderWidth: 1,
      hoverable: true,
      clickable: true
    },

    xaxis: { tickDecimals: 2, tickColor: gridBorder },
    yaxis: { tickColor: gridBorder },
    legend: { backgroundColor: legendBg },

    tooltip: { show: true },
    colors: ['#FF5722', '#0288D1']
  });

  $.plot($('#flot-categories'), [
    {
      label: 'iPhone',
      data: [
        [ "2010.Q1", 35 ], [ '2010.Q2', 67 ], [ '2010.Q3', 13 ], [ '2010.Q4', 75 ]
      ]
    },
    {
      label: 'iPad',
      data: [
        [ "2010.Q1", 18 ], [ '2010.Q2', 80 ], [ '2010.Q3', 72 ], [ '2010.Q4', 33 ]
      ]
    },
    {
      label: 'iTouch',
      data: [
        [ '2010.Q1', 32 ], [ '2010.Q2', 49 ], [ '2010.Q3', 25 ], [ '2010.Q4', 87 ]
      ]
    }
  ], {
    series: {
      shadowSize: 0,
      lines: {
        show: true,
        fill: 0.1,
        lineWidth: 1
      }
    },

    grid: {
      color: gridColor,
      borderColor: gridBorder,
      borderWidth: 1,
      hoverable: true,
      clickable: true
    },

    xaxis: { mode: 'categories', tickColor: gridBorder },
    yaxis: { tickColor: gridBorder },
    legend: { backgroundColor: legendBg },

    tooltip: {
      show: true,
      content: '%s: %y'
    },

    colors: ['#E040FB', '#E91E63', '#00BCD4']
  });

  $.plot($('#flot-pie'), [
    { label: 'Series1', data: 77 },
    { label: 'Series2', data: 81 },
    { label: 'Series3', data: 46 },
    { label: 'Series4', data: 35 },
    { label: 'Series5', data: 79 },
    { label: 'Series6', data: 84 },
    { label: 'Series7', data: 51 }
  ], {
    series: {
      shadowSize: 0,
      pie: {
        show: true,
        radius: 1,
        innerRadius: 0.5,

        label: {
          show: true,
          radius: 3 / 4,
          background: { opacity: 0 },

          formatter: function(label, series) {
            return '<div style="font-size:11px;text-align:center;color:white;">' + Math.round(series.percent) + '%</div>';
          }
        }
      }
    },

    grid: {
      color: gridColor,
      borderColor: gridBorder,
      borderWidth: 1,
      hoverable: true,
      clickable: true
    },

    xaxis: { tickColor: gridBorder },
    yaxis: { tickColor: gridBorder },
    legend: { backgroundColor: legendBg },
    colors: ['#4CAF50', '#FF5722', '#607D8B', '#009688', '#E91E63', '#795548', '#0288D1']
  });
});
