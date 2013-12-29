<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2013
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

?>

    <script type="text/javascript">
    //<![CDATA[

    function refresh_captcha(captcha_img) {
        captcha_img.src = '<?php echo $this->captcha->src; ?>' + '?nocache=' + Math.random()*999999999;
    }

    function test_captcha() {

        setTimeout(

            function() {

                $.ajax({
                    type: 'get',
                    url: SITE_URL + 'playground/captcha/test_captcha',
                    cache: false,
                    success: function(data) {
                        $('#captcha_test').html(data);
                    },
                    error: function () {
                        $('#captcha_test').html('');
                    }
                });

            }
            , 500   // Let the captcha image load first.
        );
    }

    $(function () {

        $('#captcha_image').on('click', function() {

            refresh_captcha(this);
            test_captcha();
        });

        test_captcha();
    });

    //]]>
    </script>
