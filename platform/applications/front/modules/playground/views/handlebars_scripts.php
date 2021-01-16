<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

echo js('lib/handlebars/handlebars.min.js');

?>

    <script type="text/javascript">
    //<![CDATA[

    var data = <?php echo json_encode($data); ?>;

    var source = <?php echo json_encode($handlebars_template); ?>;

    $(function () {

        var template = Handlebars.compile(source);
        $('#the_result').html(template(data));
    });

    //]]>
    </script>
