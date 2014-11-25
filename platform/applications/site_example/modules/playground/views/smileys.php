<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2014
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

// It is not to be placed here, I know.
function _force_htmlentities($string) {

    $arr = preg_split('/(?<!^)(?!$)/u', $string);  // An array of every multi-byte characters.

    $result = '';

    if (!empty($arr)) {

        foreach ($arr as $c) {
            $result .= '&#'.ord($c).';';
        }
    }

    return $result;
}

?>

        <section>

            <div class="container">

                <div class="page-header">
                    <h1>Smiley Test</h1>
                </div>

                <div class="row">

                    <div class="col-md-12">
<?php

if (!empty($smileys)) {

?>

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover table-condensed table-valign-middle" id="datatable">

                            <thead>

                                <tr>
                                    <th class="col-sm-1">Text</th>
                                    <th class="col-sm-1">Image Name</th>
                                    <th class="col-sm-1">Image</th>
                                </tr>

                            </thead>

                            <tfoot>

                                <tr>
                                    <th>Text</th>
                                    <th>Image Name</th>
                                    <th>Image</th>
                                </tr>

                            </tfoot>

                            <tbody>
<?php

    foreach ($smileys as $key => $item) {

?>

                                <tr>
                                    <td><?php echo _force_htmlentities($key); ?></td>
                                    <td><?php echo $item[0]; ?></td>
                                    <td> <?php echo $key; ?> </td>
                                </tr>
<?php

    }

?>

                            </tbody>

                        </table>
                    </div>

<?php

}

?>

                    </div>

                </div>

            </div>

        </section>
