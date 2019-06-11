$(function() {
  var options = {
    tooltips: {
      controls: false,
      seek: true
    }
  };

  var videoPlayer = plyr.setup(document.getElementById('plyr-video-player'), options)[0];
  var audioPlayer = plyr.setup(document.getElementById('plyr-audio-player'), options)[0];

  // RTL: Fix time displaying
  if ($('body').attr('dir') === 'rtl' || $('html').attr('dir') === 'rtl') {
    function plyrRtlTooltip(instance, e) {
      var duration = instance.getDuration();
      var container = instance.getContainer();

      if (!options.tooltips.seek || duration === 0 || !container) { return; }

      var clientRect = container.querySelector('.plyr__progress').getBoundingClientRect();

      // Revert percents
      var percent = 100 - (100 / clientRect.width * (e.pageX - clientRect.left));

      percent = percent < 0 ? 0 : (percent > 100 ? 100 : percent);

      var time = duration / 100 * percent;

      var secs = ("0" + parseInt(time % 60)).slice(-2);
      var mins = ("0" + parseInt((time / 60) % 60)).slice(-2);
      var hours = parseInt((time / 60 / 60) % 60);
      var displayHours = parseInt((duration / 60 / 60) % 60) > 0;

      container.querySelector('.plyr__progress .plyr__tooltip').innerHTML =
        (displayHours ? hours + ":" : "") + mins + ":" + secs;
    }

    videoPlayer.on('mouseenter mouseleave mousemove', function(e) {
      plyrRtlTooltip(videoPlayer, e);
    });
    audioPlayer.on('mouseenter mouseleave mousemove', function(e) {
      plyrRtlTooltip(audioPlayer, e);
    });
  }
});
