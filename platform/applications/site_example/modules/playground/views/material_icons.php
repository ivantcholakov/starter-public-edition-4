<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2015
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

                        <p>
                            <a href="https://github.com/mervick/material-design-icons" target="_blank">https://github.com/mervick/material-design-icons</a>
                            <br />
                            <a href="http://google.github.io/material-design-icons/#icon-font-for-the-web" target="_blank">http://google.github.io/material-design-icons/#icon-font-for-the-web</a>,
                            <a href="https://www.google.com/design/icons/" target="_blank">https://www.google.com/design/icons/</a>
                        </p>
<?php

if (!empty($items)) {

?>

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover table-condensed table-valign-middle" id="datatable">

                            <thead>

                                <tr>
                                    <th class="col-sm-2">Icon (size 4x)</th>
                                    <th class="col-sm-5">Bootstrap-Like Tag (additional features are possible)</th>
                                    <th class="col-sm-5">Tag with Ligature</th>
                                </tr>

                            </thead>

                            <tfoot>

                                <tr>
                                    <th>Icon (size 4x)</th>
                                    <th>Bootstrap-Like Tag (additional features are possible)</th>
                                    <th>Tag with Ligature</th>
                                </tr>

                            </tfoot>

                            <tbody>
<?php

    foreach ($items as $item) {

?>

                                <tr>
                                    <td><i class="mdi mdi-<?php echo str_replace('_', '-', $item['name']); ?> mdi-4x"></i></td>
                                    <td><?php echo html_escape('<i class="mdi mdi-'.str_replace('_', '-', $item['name']).'"></i>'); ?></td>
                                    <td><?php echo html_escape('<i class="material-icons">'.$item['name'].'</i>'); ?></td>
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
