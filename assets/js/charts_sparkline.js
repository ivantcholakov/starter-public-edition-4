$(function() {
  $('#sparkline-lines').sparkline2([24, 92, 77, 90, 91, 78, 28, 49, 23, 81, 15, 97, 94, 16, 99, 61, 38, 34, 48, 3, 5, 21, 27, 4, 33, 40, 46, 47, 48, 18], {
    height: '100px',
    width: '100%',
    lineColor: '#673AB7',
    fillColor: 'rgba(103, 58, 183, 0.2)',
    spotRadius: 3,
    spotColor: '#FFC107',
    minSpotColor: '#E040FB',
    maxSpotColor: '#607D8B',
    highlightSpotColor: '#FF4081',
    highlightLineColor: '#795548',
  });

  $('#sparkline-bars').sparkline2([-58, -68, -51, -91, -26, 75, 13, 82, -95, -94, -35, -94, -87, -71, 1, 47, -91, -65, -7, -90, -7, 42, -96, -21, 7, 64, -71, -43, 67, 26], {
    height: '100px',
    width: '100%',
    type: 'bar',
    barColor: '#673AB7',
    negBarColor: '#00BCD4',
  });

  $('#sparkline-tristate').sparkline2([-8, -92, -73, -29, -54, -84, -3, 70, 16, 6, 1, 81, -39, 61, -78, 35, 61, 28, 65, 43, -7, 20, -73, -70, 53, 26, 63, -41, 31, 33], {
    height: '100px',
    width: '100%',
    type: 'tristate',
    posBarColor: '#607D8B',
    negBarColor: '#E040FB',
    zeroBarColor: '#E91E63',
  });

  $('#sparkline-discrete').sparkline2([67, 20, 1, 22, 23, 67, 31, 10, 47, 68, 24, 79, 93, 56, 38, 15, 9, 15, 1, 89, 72, 52, 79, 29, 38, 2, 71, 50, 63, 69], {
    height: '100px',
    width: '100%',
    type: 'discrete',
    lineColor: '#0288D1',
  });

  $('#sparkline-bullet').sparkline2([10, 12, 12, 9, 7], {
    height: '100px',
    width: '100%',
    type: 'bullet',
    targetColor: '#0288D1',
    performanceColor: '#009688',
    rangeColors: [ '#E040FB', '#9E9E9E', '#673AB7' ],
  });

  $('#sparkline-pie').sparkline2([17, 64, 12, 77], {
    height: '100px',
    width: '100px',
    type: 'pie',
    sliceColors: [ '#FF4081', '#00BCD4', '#E91E63', '#795548' ],
  });

  $('#sparkline-box').sparkline2([4, 27, 34, 52, 54, 59, 61, 68, 78, 82, 85, 87, 91, 93, 100], {
    height: '100px',
    width: '100%',
    type: 'box',
    boxLineColor: "#4CAF50",
    boxFillColor: "#FFC107",
    whiskerColor: "#FF4081",
    outlierLineColor: "#795548",
    outlierFillColor: "#607D8B",
    medianColor: "#00BCD4",
    targetColor: "#E91E63"
  });

});
