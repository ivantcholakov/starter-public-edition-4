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

    $country_2_selected = set_value('country_2', $country_2);

?>
                                            <select name="country_2" id="country_2" class="form-control">
                                                <option value=""<?php if ($country_2_selected == '') { ?> selected="selected"<?php } ?> data-img-src="<?php echo image_path('lib/flags-iso/flat/24/_unknown.png'); ?>">-- <i18n>ui_choose</i18n>  --</option>
<?php

    if (!empty($country_names)) {

        foreach ($country_names as $key => $name) {

            $flag = $country_codes[$key];

            if ($flag != '') {
                $flag = image_path('lib/flags-iso/flat/24/'.$flag.'.png');
            }
?>
                                                <option value="<?php echo form_prep($key); ?>"<?php if ($country_2_selected == $key) { ?> selected="selected"<?php } ?><?php if ($flag != '') { ?> data-img-src="<?php echo $flag; ?>"<?php }?>><?php echo $name; ?></option>
<?php
        }
    }

?>
                                            </select>

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
