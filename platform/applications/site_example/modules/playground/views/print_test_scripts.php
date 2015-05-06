<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan tcholakov, 2015
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

?>

    <script type="text/javascript">
    //<![CDATA[

    $(function () {

<?php

if ($this->registry->get('print')) {

?>

        window.print();
<?php

}

?>

    });

    //]]>
    </script>
