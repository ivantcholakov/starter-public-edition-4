$(function() {
  var chart1 = new Chart(document.getElementById('statistics-chart-1').getContext("2d"), {
    type: 'line',
    data: {
      labels: ['2016-09', '2016-10', '2016-11', '2016-12', '2017-01', '2017-02', '2017-03', '2017-04', '2017-05', '2017-06', '2017-07', '2017-08', '2017-09', '2017-10', '2017-11', '2017-12', '2018-01', '2018-02'],
      datasets: [{
        label: 'Sales',
        data: [137, 187, 85, 72, 85, 120, 183, 89, 143, 105, 116, 77, 76, 180, 158, 172, 143, 164],
        borderWidth: 2,
        backgroundColor: 'rgba(87, 181, 255, .85)',
        borderColor: 'rgba(87, 181, 255, 1)',
        pointBackgroundColor: 'rgba(0,0,0,0)',
        pointBorderColor: 'rgba(0,0,0,0)',
        pointRadius: 10,
      }],
    },

    options: {
      scales: {
        xAxes: [{
          gridLines: {
            display: false
          },
          ticks: {
            fontColor: '#aaa',
            autoSkipPadding: 50
          }
        }],
        yAxes: [{
          gridLines: {
            display: false
          },
          ticks: {
            fontColor: '#aaa',
            maxTicksLimit: 5
          }
        }]
      },
      legend: {
        display: false
      },
      responsive: false,
      maintainAspectRatio: false
    }
  });

  var chart2 = new Chart(document.getElementById('statistics-chart-2').getContext("2d"), {
    type: 'line',
    data: {
      datasets: [{
        data: [24, 92, 77, 90, 91, 78, 28, 49, 23, 81, 15, 97, 94, 16, 99, 61,
          38, 34, 48, 3, 5, 21, 27, 4, 33, 40, 46, 47, 48, 60
        ],
        borderWidth: 1,
        backgroundColor: 'rgba(103, 58, 183, .2)',
        borderColor: 'rgba(103, 58, 183, 1)',
        pointBorderColor: 'rgba(0,0,0,0)',
        pointRadius: 1,
        lineTension: 0
      }],
      labels: ['', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '']
    },

    options: {
      scales: {
        xAxes: [{
          display: false,
        }],
        yAxes: [{
          display: false
        }]
      },
      legend: {
        display: false
      },
      tooltips: {
        enabled: false
      },
      responsive: false,
      maintainAspectRatio: false
    }
  });

  var chart3 = new Chart(document.getElementById('statistics-chart-3').getContext("2d"), {
    type: 'line',
    data: {
      datasets: [{
        data: [24, 92, 77, 90, 91, 78, 28, 49, 23, 81, 15, 97, 94, 16, 99, 61,
          38, 34, 48, 3, 5, 21, 27, 4, 33, 40, 46, 47, 48, 60
        ],
        borderWidth: 1,
        backgroundColor: 'rgba(206, 221, 54, .2)',
        borderColor: 'rgba(206, 221, 54, 1)',
        pointBorderColor: 'rgba(0,0,0,0)',
        pointRadius: 1,
        lineTension: 0
      }],
      labels: ['', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '']
    },

    options: {
      scales: {
        xAxes: [{
          display: false,
        }],
        yAxes: [{
          display: false
        }]
      },
      legend: {
        display: false
      },
      tooltips: {
        enabled: false
      },
      responsive: false,
      maintainAspectRatio: false
    }
  });

  var chart4 = new Chart(document.getElementById('statistics-chart-4').getContext("2d"), {
    type: 'line',
    data: {
      datasets: [{
        data: [24, 92, 77, 90, 91, 78, 28, 49, 23, 81, 15, 97, 94, 16, 99, 61,
          38, 34, 48, 3, 5, 21, 27, 4, 33, 40, 46, 47, 48, 60
        ],
        borderWidth: 1,
        backgroundColor: 'rgba(136, 151, 170, .2)',
        borderColor: 'rgba(136, 151, 170, 1)',
        pointBorderColor: 'rgba(0,0,0,0)',
        pointRadius: 1,
        lineTension: 0
      }],
      labels: ['', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '']
    },

    options: {
      scales: {
        xAxes: [{
          display: false,
        }],
        yAxes: [{
          display: false
        }]
      },
      legend: {
        display: false
      },
      tooltips: {
        enabled: false
      },
      responsive: false,
      maintainAspectRatio: false
    }
  });

  // Resizing charts

  function resizeCharts() {
    chart1.resize();
    chart2.resize();
    chart3.resize();
    chart4.resize();
  }

  // Initial resize
  resizeCharts();

  // For performance reasons resize charts on delayed resize event
  window.layoutHelpers.on('resize.dashboard-3', resizeCharts);
});
