$(function() {
  // Bind normal buttons
  Ladda.bind( '.button-demo button', { timeout: 2000 } );

  // Bind progress buttons and simulate loading progress
  Ladda.bind( '.progress-demo button', {
    callback: function( instance ) {
      var progress = 0;
      var interval = setInterval( function() {
        progress = Math.min( progress + Math.random() * 0.1, 1 );
        instance.setProgress( progress );

        if( progress === 1 ) {
          instance.stop();
          clearInterval( interval );
        }
      }, 200 );
    }
  } );
});
