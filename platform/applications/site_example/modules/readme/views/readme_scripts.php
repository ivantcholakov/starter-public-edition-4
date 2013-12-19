<?php defined('BASEPATH') OR exit('No direct script access allowed');

echo js('lib/google-code-prettify/prettify.js');

?>

    <script type="text/javascript">
    //<![CDATA[

        $('pre').addClass('prettyprint');

        !function ($) {
            $(function() {
                window.prettyPrint && prettyPrint();
            })
        } (window.jQuery);

    //]]>
    </script>
