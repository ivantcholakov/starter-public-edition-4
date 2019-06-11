$(function() {
  // Wrap charts
  $('.chartjs-demo').each(function() {
    $(this).wrap($('<div style="height:' + this.getAttribute('height') + 'px"></div>'));
  });


  var graphChart = new Chart(document.getElementById('chart-graph').getContext("2d"), {
    type: 'line',
    data: {
      labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
      datasets: [{
        label:           'My First dataset',
        data:            [43, 91, 89, 16, 21, 79, 28],
        borderWidth:     1,
        backgroundColor: 'rgba(255, 193, 7, 0.3)',
        borderColor:     '#FFC107',
        borderDash:      [5, 5],
        fill: false
      }, {
        label:           'My Second dataset',
        data:            [24, 63, 29, 75, 28, 54, 38],
        borderWidth:     1,
        backgroundColor: 'rgba(233, 30, 99, 0.3)',
        borderColor:     '#E91E63',
      }],
    },

    // Demo
    options: {
      responsive: false,
      maintainAspectRatio: false
    }
  });

  var barsChart = new Chart(document.getElementById('chart-bars').getContext("2d"), {
    type: 'bar',
    data: {
      labels: ['Italy', 'UK', 'USA', 'Germany', 'France', 'Japan'],
      datasets: [{
        label: '2010 customers #',
        data: [53, 99, 14, 10, 43, 27],
        borderWidth: 1,
        backgroundColor: 'rgba(205, 220, 57, 0.3)',
        borderColor: '#CDDC39'
      }, {
        label: '2014 customers #',
        data: [55, 74, 20, 90, 67, 97],
        borderWidth: 1,
        backgroundColor: 'rgba(103, 58, 183, 0.3)',
        borderColor: '#673AB7'
      }]
    },

    // Demo
    options: {
      responsive: false,
      maintainAspectRatio: false
    }
  });

  var radarChart = new Chart(document.getElementById('chart-radar').getContext("2d"), {
    type: 'radar',
    data: {
      labels: ['Eating', 'Drinking', 'Sleeping', 'Designing', 'Coding', 'Cycling', 'Running'],
      datasets: [{
        label: 'My First dataset',
        backgroundColor: 'rgba(76, 175, 80, 0.3)',
        borderColor: '#4CAF50',
        pointBackgroundColor: '#4CAF50',
        pointBorderColor: '#fff',
        pointHoverBackgroundColor: '#fff',
        pointHoverBorderColor: '#4CAF50',
        data: [39, 99, 77, 38, 52, 24, 89],
        borderWidth: 1
      }, {
        label: 'My Second dataset',
        backgroundColor: 'rgba(0, 150, 136, 0.3)',
        borderColor: '#009688',
        pointBackgroundColor: '#009688',
        pointBorderColor: '#fff',
        pointHoverBackgroundColor: '#fff',
        pointHoverBorderColor: '#009688',
        data: [6, 33, 14, 70, 58, 90, 26],
        borderWidth: 1
      }]
    },

    // Demo
    options: {
      responsive: false,
      maintainAspectRatio: false
    }
  });

  var polarAreaChart = new Chart(document.getElementById('chart-polar-area').getContext("2d"), {
    type: 'polarArea',
    data: {
      datasets: [{
        data: [ 12, 10, 14, 6, 15 ],
        backgroundColor: [ '#FF6384', '#4BC0C0', '#FFCE56', '#E7E9ED', '#36A2EB' ],
        label: 'My dataset'
      }],
      labels: [ 'Red', 'Green', 'Yellow', 'Grey', 'Blue' ]
    },

    // Demo
    options: {
      responsive: false,
      maintainAspectRatio: false
    }
  });

  var pieChart = new Chart(document.getElementById('chart-pie').getContext("2d"), {
    type: 'pie',
    data: {
      labels: [ 'Red', 'Blue', 'Yellow' ],
      datasets: [{
        data: [ 180, 272, 100 ],
        backgroundColor: [ '#FF6384', '#36A2EB', '#FFCE56' ],
        hoverBackgroundColor: [ '#FF6384', '#36A2EB', '#FFCE56' ]
      }]
    },

    // Demo
    options: {
      responsive: false,
      maintainAspectRatio: false
    }
  });

  var doughnutChart = new Chart(document.getElementById('chart-doughnut').getContext("2d"), {
    type: 'doughnut',
    data: {
      labels: [ 'Red', 'Blue', 'Yellow' ],
      datasets: [{
        data: [ 137, 296, 213 ],
        backgroundColor: [ '#FF6384', '#36A2EB', '#FFCE56' ],
        hoverBackgroundColor: [ '#FF6384', '#36A2EB', '#FFCE56' ]
      }]
    },

    // Demo
    options: {
      responsive: false,
      maintainAspectRatio: false
    }
  });

  // Resizing charts

  function resizeCharts() {
    graphChart.resize();
    barsChart.resize();
    radarChart.resize();
    polarAreaChart.resize();
    pieChart.resize();
    doughnutChart.resize();
  }

  // Initial resize
  resizeCharts();

  // For performance reasons resize charts on delayed resize event
  window.layoutHelpers.on('resize.charts-demo', resizeCharts);
});
