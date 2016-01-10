<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2014
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

?>

        <section>

            <div class="container">

                <div class="page-header">
                    <h1><?php echo $template['page_title']; ?></h1>
                </div>

                <div class="row">

                    <div class="col-md-12">
<?php

if (!empty($file_extensions)) {

?>

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover table-condensed table-valign-middle" id="datatable">

                            <thead>

                                <tr>
                                    <th class="col-sm-1">File Name</th>
                                    <th class="col-sm-1">Icon Class</th>
                                    <th class="col-sm-1">Icon</th>
                                </tr>

                            </thead>

                            <tfoot>

                                <tr>
                                    <th>File Name</th>
                                    <th>Icon Class</th>
                                    <th>Icon</th>
                                </tr>

                            </tfoot>

                            <tbody>
<?php

    foreach ($file_extensions as $ext) {

        $file_name = 'x.'.$ext;
?>

                                <tr>
                                    <td><?php echo $file_name; ?></td>
                                    <td><?php echo file_type_icon_fa($file_name); ?></td>
                                    <td><i class="fa fa-2x <?php echo file_type_icon_fa($file_name); ?>"></i></td>
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
