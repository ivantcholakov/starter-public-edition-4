$(function() {
  var chart1 = new Chart(document.getElementById('statistics-chart-1').getContext("2d"), {
    type: 'line',
    data: {
      labels: ['2016-10', '2016-11', '2016-12', '2017-01', '2017-02', '2017-03', '2017-04', '2017-05'],
      datasets: [{
        label: 'Visits',
        data: [93, 25, 95, 59, 46, 68, 4, 41],
        borderWidth: 1,
        backgroundColor: 'rgba(28,180,255,.05)',
        borderColor: 'rgba(28,180,255,1)'
      }, {
        label: 'Returns',
        data: [83, 1, 43, 28, 56, 82, 80, 66],
        borderWidth: 1,
        borderDash: [5, 5],
        backgroundColor: 'rgba(136, 151, 170, 0.1)',
        borderColor: '#8897aa'
      }],
    },
    options: {
      scales: {
        xAxes: [{
          gridLines: {
            display: false
          },
          ticks: {
            fontColor: '#aaa'
          }
        }],
        yAxes: [{
          gridLines: {
            display: false
          },
          ticks: {
            fontColor: '#aaa'
          }
        }]
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
    type: 'bar',
    data: {
      datasets: [{
        data: [24, 92, 77, 90, 91, 78, 28, 49, 23, 81, 15, 97, 94, 16, 99, 61,
          38, 34, 48, 3, 5, 21, 27, 4, 33, 40, 46, 47, 48, 18
        ],
        borderWidth: 0,
        backgroundColor: '#673AB7',
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

  var chart4 = new Chart(document.getElementById('statistics-chart-4').getContext("2d"), {
    type: 'line',
    data: {
      datasets: [{
        data: [24, 92, 77, 90, 91, 78, 28, 49, 23, 81, 15, 97, 94, 16, 99, 61,
          38, 34, 48, 3, 5, 21, 27, 4, 33, 40, 46, 47
        ],
        borderWidth: 1,
        backgroundColor: 'rgba(206, 221, 54, 0.2)',
        borderColor: '#cedd36',
        pointBackgroundColor: 'rgba(0,0,0,0)',
        pointBorderColor: 'rgba(0,0,0,0)',
        pointRadius: 1,

      }],
      labels: ['', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '']
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

  var chart5 = new Chart(document.getElementById('statistics-chart-5').getContext("2d"), {
    type: 'doughnut',
    data: {
      datasets: [{
        data: [85, 15],
        backgroundColor: ['#fff', 'rgba(255,255,255,0.3)'],
        hoverBackgroundColor: ['#fff', 'rgba(255,255,255,0.3)'],
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

  var chart6 = new Chart(document.getElementById('statistics-chart-6').getContext("2d"), {
    type: 'pie',
    data: {
      labels: ['Desktops', 'Smartphones', 'Tablets'],
      datasets: [{
        data: [1225, 654, 211],
        backgroundColor: ['rgba(99,125,138,0.5)', 'rgba(28,151,244,0.5)', 'rgba(2,188,119,0.5)'],
        borderColor: ['#647c8a', '#2196f3', '#02bc77'],
        borderWidth: 1
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
        position: 'right',
        labels: {
          boxWidth: 12
        }
      },
      responsive: false,
      maintainAspectRatio: false
    }
  });

  new PerfectScrollbar(document.getElementById('tasks-inner'));
  new PerfectScrollbar(document.getElementById('team-todo-inner'));

  if ($('html').attr('dir') === 'rtl') {
    $('#sales-dropdown-menu').removeClass('dropdown-menu-right');
  }

  // Resizing charts

  function resizeCharts() {
    chart1.resize();
    chart2.resize();
    chart3.resize();
    chart4.resize();
    chart5.resize();
    chart6.resize();
  }

  // Initial resize
  resizeCharts();

  // For performance reasons resize charts on delayed resize event
  window.layoutHelpers.on('resize.dashboard-1', resizeCharts);
});
