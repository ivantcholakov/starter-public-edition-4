<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2014
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

?>

        <section>

            <div class="container">

                <div class="page-header">
                    <h1>Google Maps JavaScript API v3 Demo</h1>
                </div>

                <div class="row">

                    <div class="col-md-12">

<?php

if (!$driver_ok) {

?>

                        <div class="alert alert-warning text-center">pdo_sqlite database driver is needed for this demo to work.</div>
<?php

} else {

?>

                        <div class="panel panel-default">

                            <div class="panel-body">

                                <?php echo form_open(CURRENT_URL, 'id="test_form" method="post" class="form-horizontal" role="form"'); ?>

                                    <div class="form-group">

                                        <label for="country_id" class="col-sm-3 control-label">
                                            Country:
                                        </label>

                                        <div class="col-sm-9">

<?php

echo Modules::run('playground/country_dropdown_widget/index', array('element_name' => 'country_id', 'element_class' => 'form-control', 'value' => set_value('country_id', '')));

?>

                                        </div>

                                    </div>

                                    <div class="form-group">

                                        <div class="col-sm-offset-3 col-sm-9">

                                            <div id="map_canvas" class="google-maps"></div>

                                        </div>

                                    </div>

                                <?php echo form_close(); ?>

                            </div>

                        </div>

<?php

}

?>

                    </div>

                </div>

            </div>

        </section>
