<?php defined('BASEPATH') OR exit('No direct script access allowed.');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2015
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

echo js('lib/jquery-pjax/jquery.pjax.js');

?>

    <script type="text/javascript">
    //<![CDATA[

    $(function () {

        $(document).pjax('[data-pjax] a, a[data-pjax]', '#content-container');

    });

    //]]>
    </script>
