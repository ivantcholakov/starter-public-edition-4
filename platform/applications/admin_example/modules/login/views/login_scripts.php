<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

    <script type="text/javascript">
    //<![CDATA[

    function refresh_captcha() {

        $('#captcha_image').attr('src', '<?php echo $this->captcha->src; ?>' + '?nocache=' + Math.random()*999999999);
        $('#captcha').val('');
    }

    $(function () {

        $('#captcha_image').on('click', function() {
            refresh_captcha();
        });

        $('#captcha_refresh').on('click', function() {
            refresh_captcha();
        });

    });

    //]]>
    </script>
