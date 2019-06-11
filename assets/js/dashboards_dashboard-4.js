$(function() {
  var chart1 = new Chart(document.getElementById('statistics-chart-1').getContext("2d"), {
    type: 'doughnut',
    data: {
      datasets: [{
        data: [24, 76],
        backgroundColor: ['#4CAF50', 'rgba(255, 255, 255, .1)'],
        hoverBackgroundColor: ['#4CAF50', 'rgba(255, 255, 255, .1)'],
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

  var chart2 = new Chart(document.getElementById('statistics-chart-2').getContext("2d"), {
    type: 'doughnut',
    data: {
      datasets: [{
        data: [86, 14],
        backgroundColor: ['#d9534f', 'rgba(255, 255, 255, .1)'],
        hoverBackgroundColor: ['#d9534f', 'rgba(255, 255, 255, .1)'],
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

  var chart3 = new Chart(document.getElementById('statistics-chart-3').getContext("2d"), {
    type: 'doughnut',
    data: {
      datasets: [{
        data: [63, 37],
        backgroundColor: ['#28c3d7', 'rgba(255, 255, 255, .1)'],
        hoverBackgroundColor: ['#28c3d7', 'rgba(255, 255, 255, .1)'],
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

  var chart4 = new Chart(document.getElementById('statistics-chart-4').getContext("2d"), {
    type: 'line',
    data: {
      datasets: [{
        data: [24, 92, 77, 90, 91, 78, 28, 49, 23, 81, 15, 97, 94, 16, 99, 61,
          38, 34, 48, 3, 5, 21, 27, 4, 33, 40, 46, 47, 48, 18
        ],
        borderWidth: 2,
        backgroundColor: 'rgba(87, 181, 255, .85)',
        borderColor: 'rgba(87, 181, 255, 1)',
        pointBorderColor: 'rgba(0,0,0,0)',
        pointBackgroundColor: 'rgba(0,0,0,0)',
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

  var chart5 = new Chart(document.getElementById('statistics-chart-5').getContext("2d"), {
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

  var chart6 = new Chart(document.getElementById('statistics-chart-6').getContext("2d"), {
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
      tooltips: {
        enabled: false
      },
      responsive: false,
      maintainAspectRatio: false
    }
  });

  var chart7 = new Chart(document.getElementById('statistics-chart-7').getContext("2d"), {
    type: 'line',
    data: {
      datasets: [{
        data: [24, 92, 77, 90, 91, 78, 28, 49, 23, 81, 15, 97, 94, 16, 99, 61,
          38, 34, 48, 3, 5, 21, 27, 4, 33, 40, 46, 47, 48, 60
        ],
        borderWidth: 1,
        backgroundColor: 'rgba(206, 221, 54, 0)',
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

  var chart8 = new Chart(document.getElementById('statistics-chart-8').getContext("2d"), {
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

  var chart9 = new Chart(document.getElementById('statistics-chart-9').getContext("2d"), {
    type: 'bar',
    data: {
      datasets: [{
        data: [24, 92, 77, 90, 91, 78, 28, 49, 23, 81, 15, 97, 94, 16, 99, 61,
          38, 34, 48, 3, 5, 21, 27, 4, 33, 40, 46, 47, 48, 18
        ],
        borderWidth: 0,
        backgroundColor: '#8897AA',
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

  var chart10 = new Chart(document.getElementById('statistics-chart-10').getContext("2d"), {
    type: 'pie',
    data: {
      labels: ['18 - 24', '25 - 34', '34 - 45', '45+'],
      datasets: [{
        data: [1225, 654, 211, 402],
        backgroundColor: ['rgba(99,125,138,0.5)', 'rgba(28,151,244,0.5)', 'rgba(2,188,119,0.5)', 'rgba(206, 221, 54, 0.5)'],
        borderColor: ['#647c8a', '#2196f3', '#02bc77', 'rgba(206, 221, 54, 1)'],
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

  if ($('html').attr('dir') === 'rtl') {
    $('#type-gadgets-dropdown-menu, #new-users-dropdown-menu, #age-users-dropdown-menu').removeClass('dropdown-menu-right');
  }

  // Resizing charts

  function resizeCharts() {
    chart1.resize();
    chart2.resize();
    chart3.resize();
    chart4.resize();
    chart5.resize();
    chart6.resize();
    chart7.resize();
    chart8.resize();
    chart9.resize();
    chart10.resize();
  }

  // Initial resize
  resizeCharts();

  // For performance reasons resize charts on delayed resize event
  window.layoutHelpers.on('resize.dashboard-4', resizeCharts);
});
