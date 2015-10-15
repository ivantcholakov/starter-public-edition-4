<?php defined('BASEPATH') OR exit('No direct script access allowed');

echo js('lib/colorbox/jquery.colorbox-min.js');

?>

    <script type="text/javascript">
    //<![CDATA[

    // Our customized translations.
    jQuery.extend(jQuery.colorbox.settings, {
        current: <?php echo json_encode($this->lang->line('ui_slideshow_current')); ?>,
        previous: <?php echo json_encode($this->lang->line('ui_slideshow_previous')); ?>,
        next: <?php echo json_encode($this->lang->line('ui_slideshow_next')); ?>,
        close: <?php echo json_encode($this->lang->line('ui_close')); ?>,
        slideshowStart: <?php echo json_encode($this->lang->line('ui_slideshow_start')); ?>,
        slideshowStop: <?php echo json_encode($this->lang->line('ui_slideshow_stop')); ?>
    });

    // See https://github.com/jackmoore/colorbox/issues/158

    // Make ColorBox responsive
    jQuery.colorbox.settings.minWidth  = '500';
    jQuery.colorbox.settings.maxWidth  = '95%';
    jQuery.colorbox.settings.maxHeight = '95%';

    // ColorBox resize function
    var resizeTimer;

    function resizeColorBox() {

        if (resizeTimer) {
            clearTimeout(resizeTimer);
        }

        resizeTimer = setTimeout(function() {
            if (jQuery('#cboxOverlay').is(':visible')) {
                jQuery.colorbox.reload();
            }
        }, 300);
    }

    // Resize ColorBox when resizing window or changing mobile device orientation
    jQuery(window).resize(resizeColorBox);
    window.addEventListener('orientationchange', resizeColorBox, false);

    // Activate ColorBox
    function activateColorBox() {

        $("a[rel='colorbox']").colorbox();

        $("a[rel='colorbox-slideshow']").colorbox({
            slideshow: true,
            slideshowAuto: false
        });
    }

    $(function() {
        activateColorBox();
    });

    //]]>
    </script>
