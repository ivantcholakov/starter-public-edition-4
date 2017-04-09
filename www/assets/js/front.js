
$(function () {

    // A workaround about dropdown initialization.
    // See https://github.com/Semantic-Org/Semantic-UI/issues/2072
    // "[Dropdown] Add Nullable Option for Single Selection"

    $('.ui.dropdown:not(.native):not(.special)[multiple]').dropdown();
    $('.ui.dropdown:not(.native):not(.special):not([multiple]):not(.nullable)').dropdown();
    $('.ui.dropdown:not(.native):not(.special):not([multiple]).nullable').dropdown({
        onChange: function(value) {

            var target = $(this);
            var wrapper = target.prop('tagName') == 'SELECT' ? target.parent() : target;

            if (value) {

                var icon = wrapper.find('.dropdown.icon');

                icon.removeClass('dropdown').addClass('delete').on('click', function(e) {

                    target.dropdown('clear');
                    $(this).removeClass('delete').addClass('dropdown');

                    e.preventDefault();
                    return false;
                });
            }
        },
        fireOnInit: true
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

    $('#main_navigation .menu.toggle').on("click", function(e) {

        e.preventDefault();

        //$('#main_navigation .ui.vertical.menu').toggle();
        var menu = $('#main_navigation .ui.vertical.menu');
        menu.transition({
            animation: 'slide down',
            onComplete : function() {

                if (menu.hasClass('hidden')) {
                    menu.hide();
                } else {
                    menu.show();
                }
            }
        });
    });
});


/*
 * prettyPrint
 */

$('pre').addClass('prettyprint');

!function ($) {
    $(function() {
        window.prettyPrint && prettyPrint();
    })
} (window.jQuery);


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
