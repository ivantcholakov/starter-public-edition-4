
$(function () {

    $('.ui.dropdown:not(.native):not(.special)[multiple]').dropdown({
        fullTextSearch: true,
        duration: 100
    });

    $('.ui.dropdown:not(.native):not(.special):not([multiple]):not(.clearable)').dropdown({
        fullTextSearch: true,
        duration: 100
    });

    $('.ui.dropdown:not(.native):not(.special):not([multiple]).clearable').dropdown({
        clearable: true,
        fullTextSearch: true,
        duration: 100
    });

    $('body').on('click', '.message .close', function() {

        $(this)
          .closest('.message')
          .transition('fade')
        ;
    });

    $('.ui.accordion')
      .accordion()
    ;

    $('.popover').popup({ 'on': Modernizr.touch ? 'click' : 'hover' });

    $('#sidebar_toggle').on('click', function() {

        $('#sidebar').transition({
            animation: 'slide right',
            onComplete : function() {

                $.ajax({
                    type: 'post',
                    mode: 'queue',
                    url: SITE_URL + 'side-menu-widget/toggle-ajax',
                    data: {
                        state: $('#sidebar').hasClass('hidden') ? 'hidden' : 'visible'
                    },
                    success: function(data) {

                    }
                });
            }
        });

    });
});


$.keepalive.configure( {
    interval : 1000 * 60 * 80,  // Ping every 80 minutes for keeping the PHP session alive.
    url: SITE_URL + 'keep-alive/ping',
    successCallback : function() {},
    errorCallback : function() {}
});


/*
 * See http://appglobe.com/scroll-to-top-animation/
 */

(function($) {

    addScrollTopAnimation();

    function addScrollTopAnimation() {

        var $scrolltop_link = $('.ui.button.scroll.top');

        $scrolltop_link.on( 'click' ,  function ( ev ) {

            ev.preventDefault();

            $( 'html, body' ).animate( {

                scrollTop: 0

            }, 700 );

        })

        // Hides the link initially
        .data('hidden', 1).hide(); 

        var scroll_event_fired = false;

        $(window).on('scroll', function() {

            scroll_event_fired = true;

        });

        /* 
        Checks every 300 ms if a scroll event has been fired.
        */
        setInterval( function() {

            if( scroll_event_fired ) {

                /* 
                Stop code below from being executed until the next scroll event. 
                */
                scroll_event_fired = false; 

                var is_hidden =  $scrolltop_link.data('hidden'); 

                /* 
                Display the scroll top link when the page is scrolled 
                down the height of half a viewport from top,  Hide it otherwise. 
                */
                if ( $( this ).scrollTop()  >  $( this ).height() / 2 ) {

                    if( is_hidden ) {

                        $scrolltop_link.fadeIn(600).data('hidden', 0);

                    }
                }

                else {

                    if( !is_hidden ) {

                        $scrolltop_link.fadeOut(600).data('hidden', 1);

                    }
                }

            }

        }, 300); 

    }

})(jQuery);
