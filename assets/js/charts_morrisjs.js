$(function() {
  var gridBorder = '#eeeeee';

  new Morris.Line({
    element: 'morrisjs-graph',
    data: [
      { period: '2011 Q3', licensed: 71, sorned: 41 },
      { period: '2011 Q2', licensed: 24, sorned: 80 },
      { period: '2011 Q1', licensed: 39, sorned: 28 },
      { period: '2010 Q4', licensed: 34, sorned: 38 },
      { period: '2009 Q4', licensed: 51, sorned: 11 },
      { period: '2008 Q4', licensed: 68, sorned: 67 },
      { period: '2007 Q4', licensed: 85, sorned: 6 },
      { period: '2006 Q4', licensed: 21, sorned: 87 },
      { period: '2005 Q4', licensed: 38, sorned: 94 }
    ],
    xkey: 'period',
    ykeys: ['licensed', 'sorned'],
    labels: ['Licensed', 'Off the road'],
    lineColors: ['#FFC107', '#E91E63'],
    lineWidth: 1,
    pointSize: 4,
    gridLineColor: gridBorder,
    resize: true
  });

  new Morris.Bar({
    element: 'morrisjs-bars',
    data: [
      { device: 'iPhone',     geekbench: 58 },
      { device: 'iPhone 3G',  geekbench: 39 },
      { device: 'iPhone 3GS', geekbench: 83 },
      { device: 'iPhone 4',   geekbench: 50 },
      { device: 'iPhone 4S',  geekbench: 92 },
      { device: 'iPhone 5',   geekbench: 32 }
    ],
    xkey: 'device',
    ykeys: ['geekbench'],
    labels: ['Geekbench'],
    barRatio: 0.4,
    xLabelAngle: 35,
    hideHover: 'auto',
    barColors: ['#CDDC39'],
    gridLineColor: gridBorder,
    resize: true
  });

  new Morris.Area({
    element: 'morrisjs-area',
    data: [
      { period: '2010 Q1', iphone: 7, ipad: 25, itouch: 12 },
      { period: '2010 Q2', iphone: 14, ipad: 47, itouch: 46 },
      { period: '2010 Q3', iphone: 93, ipad: 83, itouch: 66 },
      { period: '2010 Q4', iphone: 25, ipad: 1, itouch: 39 },
      { period: '2011 Q1', iphone: 95, ipad: 43, itouch: 39 },
      { period: '2011 Q2', iphone: 59, ipad: 28, itouch: 15 },
      { period: '2011 Q3', iphone: 46, ipad: 56, itouch: 60 },
      { period: '2011 Q4', iphone: 68, ipad: 82, itouch: 30 },
      { period: '2012 Q1', iphone: 4, ipad: 80, itouch: 82 },
      { period: '2012 Q2', iphone: 41, ipad: 66, itouch: 84 }
    ],
    xkey: 'period',
    ykeys: ['iphone', 'ipad', 'itouch'],
    labels: ['iPhone', 'iPad', 'iPod Touch'],
    hideHover: 'auto',
    lineColors: ['#673AB7', '#0288D1', '#9E9E9E'],
    fillOpacity: 0.1,
    behaveLikeLine: true,
    lineWidth: 1,
    pointSize: 4,
    gridLineColor: gridBorder,
    resize: true
  });

  new Morris.Donut({
    element: 'morrisjs-donut',
    data: [
      { label: 'Jam',     value: 25 },
      { label: 'Frosted', value: 40 },
      { label: 'Custard', value: 25 },
      { label: 'Sugar',   value: 10 }
    ],
    colors: ['#009688', '#4CAF50', '#D32F2F', '#795548'],
    resize: true,
    labelColor: '#888',
    formatter: function (y) { return y + "%" }
  });
});
