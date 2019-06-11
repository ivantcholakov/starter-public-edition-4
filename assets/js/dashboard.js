$(function() {
  var chart1 = new Chart(document.getElementById('statistics-chart-1').getContext("2d"), {
    type: 'bar',
    data: {
      datasets: [{
        data: [24, 92, 77, 90, 91, 78, 28, 49, 23, 81, 15, 97, 94, 16, 99, 61,
          38, 34, 48, 3, 5, 21, 27, 4, 33, 40, 46, 47, 48, 18
        ],
        borderWidth: 0,
        backgroundColor: 'rgba(87, 181, 255, 1)',
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
      responsive: false,
      maintainAspectRatio: false
    }
  });

  var chart2 = new Chart(document.getElementById('statistics-chart-2').getContext("2d"), {
    type: 'line',
    data: {
      datasets: [{
        data: [24, 92, 77, 90, 91, 78, 28, 49, 23, 81, 15, 97, 94, 16, 99, 61,
          38, 34, 48, 3, 5, 21, 27, 4, 33, 40, 46, 47, 48, 18
        ],
        borderWidth: 1,
        backgroundColor: 'rgba(0,0,0,0)',
        borderColor: '#009688',
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
      responsive: false,
      maintainAspectRatio: false
    }
  });

  var chart3 = new Chart(document.getElementById('statistics-chart-3').getContext("2d"), {
    type: 'doughnut',
    data: {
      datasets: [{
        data: [54, 46],
        backgroundColor: ['#673AB7', '#f9f9f9'],
        hoverBackgroundColor: ['#673AB7', '#f9f9f9'],
        borderWidth: 0
      }]
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
      cutoutPercentage: 94,
      responsive: false,
      maintainAspectRatio: false
    }
  });

  if ($('html').attr('dir') === 'rtl') {
    $('#revenue-dropdown-menu').removeClass('dropdown-menu-right');
  }

  // Resizing charts

  function resizeCharts() {
    chart1.resize();
    chart2.resize();
    chart3.resize();
  }

  // Initial resize
  resizeCharts();

  // For performance reasons resize charts on delayed resize event
  window.layoutHelpers.on('resize.dashboard-2', resizeCharts);
});
