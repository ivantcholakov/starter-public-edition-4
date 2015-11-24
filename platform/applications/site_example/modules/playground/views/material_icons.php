<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2015
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

?>

        <section>

            <div class="container">

                <div class="page-header">
                    <h1>Material Icons Test</h1>
                </div>

                <div class="row">

                    <div class="col-md-12">

                        <p>
                            <a href="http://google.github.io/material-design-icons/#icon-font-for-the-web" target="_blank">http://google.github.io/material-design-icons/#icon-font-for-the-web</a>,
                            <a href="https://www.google.com/design/icons/" target="_blank">https://www.google.com/design/icons/</a>
                        </p>
<?php

if (!empty($items)) {

?>

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover table-valign-middle" id="datatable">

                            <thead>

                                <tr>
                                    <th class="col-xs-2 col-sm-3">Icon</th>
                                    <th class="col-xs-8 col-sm-3">Name</th>
                                    <th class="col-xs-2 col-sm-3">Codepoint</th>
                                </tr>

                            </thead>

                            <tfoot>

                                <tr>
                                    <th>Icon</th>
                                    <th>Name</th>
                                    <th>Codepoint</th>
                                </tr>

                            </tfoot>

                            <tbody>
<?php

    foreach ($items as $item) {

?>

                                <tr>
                                    <td><i class="material-icons"><?php echo $item['name']; ?></i></td>
                                    <td><?php echo $item['name']; ?></td>
                                    <td><?php echo html_escape('&#x'.strtoupper($item['codepoint']).';'); ?></td>
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
