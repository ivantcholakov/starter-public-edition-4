<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2014
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

?>

        <section>

            <div class="container">

                <div class="page-header">
                    <h1>jQuery Chosen Plugin Test</h1>
                </div>

                <div class="row">

                    <div class="col-md-12">

<?php

if (!$driver_ok) {

?>

                        <div class="alert alert-warning text-center">pdo_sqlite database driver is needed for this demo to work.</div>
<?php

} else {

    file_partial('messages');

?>

                        <div class="panel panel-default">

                            <div class="panel-body">

                                <?php echo form_open(CURRENT_URL, 'id="test_form" method="post" class="form-horizontal" role="form"'); ?>

                                    <div class="form-group<?php if (!empty($validation_errors['country_1'])) { ?> has-error<?php } ?>">

                                        <label for="country_1" class="col-sm-3 control-label">
                                            * Country 1:
                                        </label>

                                        <div class="col-sm-9">

<?php

    echo form_dropdown(
        'country_1',
        array('' => '-- '.$this->lang->line('ui_choose').' --') + $country_names,
        set_value('country_1', $country_1),
        'id="country_1" class="form-control"'
    );

?>

                                        </div>

                                    </div>

                                    <div class="form-group<?php if (!empty($validation_errors['country_2'])) { ?> has-error<?php } ?>">

                                        <label for="country_2" class="col-sm-3 control-label">
                                            * Country 2:
                                        </label>

                                        <div class="col-sm-9">

<?php

echo Modules::run('playground/country_dropdown_widget/index', array('element_name' => 'country_2', 'element_class' => 'form-control', 'value' => set_value('country_2', $country_2)));

?>

                                        </div>

                                    </div>

                                    <div class="form-group">

                                        <div class="col-sm-offset-3 col-sm-9">

                                            <p class="help-block">
                                                <i18n>ui_required_fields_note</i18n>
                                            </p>

                                        </div>

                                    </div>

                                    <div class="form-group">

                                        <div class="col-sm-offset-3 col-sm-9">

                                            <button id="test_form_submit" name="test_form_submit" type="submit" class="btn btn-primary">
                                                <i class="fa fa-check fa-fw"></i>
                                                Submit Form
                                            </button>

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
