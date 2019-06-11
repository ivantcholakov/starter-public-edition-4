$(function() {
  $('#vegas-example').vegas({
    slides: [
      { src: "assets/img/bg/1.jpg" },
      { src: "assets/img/bg/2.jpg" },
      { src: "assets/img/bg/3.jpg" },
      { src: "assets/img/bg/4.jpg" },
      { src: "assets/img/bg/5.jpg" }
    ],
    transition: [ 'fade', 'zoomOut', 'zoomIn', 'blur' ],
    animation: [ 'kenburnsUp', 'kenburnsDown', 'kenburnsLeft', 'kenburnsRight' ]
  });

  // Progess color
  $('#vegas-example .vegas-timer-progress').css('background', 'rgba(0,0,0,.2)');

  // Overlays
  $('#vegas-dark-overlay-example, #vegas-light-overlay-example').vegas({
    overlay: true,
    timer: false,
    shuffle: true,
    slides: [
      { src: "assets/img/bg/1.jpg" },
      { src: "assets/img/bg/2.jpg" },
      { src: "assets/img/bg/3.jpg" },
      { src: "assets/img/bg/4.jpg" },
      { src: "assets/img/bg/5.jpg" }
    ],
    transition: [ 'fade', 'blur' ],
  });

  // Fixed bg
  $('#vegas-fixed-bg-example').vegas({
    overlay: false,
    timer: false,
    shuffle: true,
    slides: [
      { src: "assets/img/bg/1.jpg" },
      { src: "assets/img/bg/2.jpg" },
      { src: "assets/img/bg/3.jpg" },
      { src: "assets/img/bg/4.jpg" },
      { src: "assets/img/bg/5.jpg" }
    ],
    transition: [ 'fade', 'blur' ],
  });
});
