<?php defined('BASEPATH') OR exit('No direct script access allowed');

// https://developers.google.com/web/fundamentals/performance/optimizing-content-efficiency/webfont-optimization
// https://developers.google.com/fonts/docs/webfont_loader
// https://github.com/typekit/webfontloader
// https://github.com/typekit/fvd
// https://google-webfonts-helper.herokuapp.com

?>

    <script type="text/javascript" src="<?php echo js_url('lib/webfontloader/webfontloader.js'); ?>"></script>

    <script type="text/javascript">
    //<![CDATA[

        WebFont.load({
            custom: {
                families: [
                    'Material Icons',
                    'FontAwesome'
                ],
                urls: [
                    ASSET_CSS_URI + 'lib/material-icons/material-icons.min.css',
                    ASSET_CSS_URI + 'lib/font-awesome-4/font-awesome.min.css'
                ]
            },
            timeout: 2000
        });

    //]]>
    </script>
