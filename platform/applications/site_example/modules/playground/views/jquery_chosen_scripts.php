<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2014
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

echo js('lib/chosen/chosen.jquery.min.js');
echo js('lib/chosen-image/chosenImage.jquery.js');

?>

    <script type="text/javascript">
    //<![CDATA[

    $(function() {

        $('#country_1').chosen({
            width: '100%'   // This makes the control responsive.
        });

        $('#country_2').chosenImage({
            width: '100%',
            disable_search: true    // disable_search: false - it does not work well, there is no proper event to be listened.
        });

    });

    //]]>
    </script>
