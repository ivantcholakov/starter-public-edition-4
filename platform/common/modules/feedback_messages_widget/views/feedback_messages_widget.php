<?php defined('BASEPATH') OR exit('No direct script access allowed');

$feedback_message_target = isset($feedback_message_target) ? trim($feedback_message_target) : '';
$feedback_message_target = $feedback_message_target != '' ? $feedback_message_target : trim(ci()->session->flashdata('feedback_message_target'));
$feedback_message_target = $feedback_message_target != '' ? $feedback_message_target : trim(ci()->session->tempdata('feedback_message_target'));
$feedback_message_target = $feedback_message_target != '' ? $feedback_message_target : trim(ci()->registry->get('feedback_message_target'));
$feedback_message_target = $feedback_message_target != '' ? $feedback_message_target : 'main_feedback_message';

$normal_message = isset($normal_message) ? trim($normal_message) : '';
$normal_message = $normal_message != '' ? $normal_message : trim(ci()->session->flashdata('normal_message'));
$normal_message = $normal_message != '' ? $normal_message : trim(ci()->session->tempdata('normal_message'));
$normal_message = $normal_message != '' ? $normal_message : trim(ci()->registry->get('normal_message'));

$confirmation_message = isset($confirmation_message) ? trim($confirmation_message) : '';
$confirmation_message = $confirmation_message != '' ? $confirmation_message : trim(ci()->session->flashdata('confirmation_message'));
$confirmation_message = $confirmation_message != '' ? $confirmation_message : trim(ci()->session->tempdata('confirmation_message'));
$confirmation_message = $confirmation_message != '' ? $confirmation_message : trim(ci()->registry->get('confirmation_message'));

$warning_message = isset($warning_message) ? trim($warning_message) : '';
$warning_message = $warning_message != '' ? $warning_message : trim(ci()->session->flashdata('warning_message'));
$warning_message = $warning_message != '' ? $warning_message : trim(ci()->session->tempdata('warning_message'));
$warning_message = $warning_message != '' ? $warning_message : trim(ci()->registry->get('warning_message'));

$error_message = isset($error_message) ? trim($error_message) : '';
$error_message = $error_message != '' ? $error_message : trim(ci()->session->flashdata('error_message'));
$error_message = $error_message != '' ? $error_message : trim(ci()->session->tempdata('error_message'));
$error_message = $error_message != '' ? $error_message : trim(ci()->registry->get('error_message'));

if ($feedback_message_target == $feedback_message_id) {

    ci()->session->unset_tempdata('feedback_message_target');
    ci()->session->unset_tempdata('normal_message');
    ci()->session->unset_tempdata('confirmation_message');
    ci()->session->unset_tempdata('warning_message');
    ci()->session->unset_tempdata('error_message');

    ci()->session->unset_userdata('feedback_message_target');
    ci()->session->unset_userdata('normal_message');
    ci()->session->unset_userdata('confirmation_message');
    ci()->session->unset_userdata('warning_message');
    ci()->session->unset_userdata('error_message');
}

?>

                <div id="<?php echo $feedback_message_id; ?>" class="clearfix">

<?php

if ($feedback_message_target == $feedback_message_id && $normal_message != '') {

    if ($feedback_message_full_width) {

?>

                    <div class="alert alert-info alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <?php echo $normal_message; ?>

                    </div>

<?php

    } else {

?>

                    <div class="centered-block-container">
                        <div class="alert alert-info alert-dismissable centered-block">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <?php echo $normal_message; ?>

                        </div>
                    </div>
<?php
    }
}

if ($feedback_message_target == $feedback_message_id && $confirmation_message != '') {

    if ($feedback_message_full_width) {

?>

                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <?php echo $confirmation_message; ?>

                    </div>
<?php

    } else {

?>

                    <div class="centered-block-container">
                        <div class="alert alert-success alert-dismissable centered-block">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <?php echo $confirmation_message; ?>

                        </div>
                    </div>
<?php
    }
}

if ($feedback_message_target == $feedback_message_id && $warning_message != '') {

    if ($feedback_message_full_width) {

?>

                    <div class="alert alert-warning alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <?php echo $warning_message; ?>

                    </div>
<?php

    } else {

?>

                    <div class="centered-block-container">
                        <div class="alert alert-warning alert-dismissable centered-block">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <?php echo $warning_message; ?>

                        </div>
                    </div>
<?php
    }
}

if ($feedback_message_target == $feedback_message_id && $error_message != '') {

    if ($feedback_message_full_width) {

?>

                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <?php echo $error_message; ?>

                    </div>
<?php

    } else {

?>

                    <div class="centered-block-container">
                        <div class="alert alert-danger alert-dismissable centered-block">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <?php echo $error_message; ?>

                        </div>
                    </div>
<?php
    }
}

?>

                </div>

<?php

if ($feedback_message_with_javascript) {

?>

    <script type="text/javascript">
    //<![CDATA[

    function show_<?php echo $feedback_message_id; ?>(message, message_type) {

        if (typeof message != 'undefined' && message != '') {

            if (typeof message_type == 'undefined' || message_type == '') {
                message_type = 'normal_message';
            }

<?php

    if ($feedback_message_full_width) {

?>

            var visual_class = 'alert alert-info alert-dismissable';
<?php

    } else {

?>

            var visual_class = 'alert alert-info alert-dismissable centered-block';
<?php

    }

?>


            switch (message_type) {

                case 'confirmation-message':
                case 'confirmation_message':
<?php

    if ($feedback_message_full_width) {

?>

                    visual_class = 'alert alert-success alert-dismissable';
<?php

    } else {

?>

                    visual_class = 'alert alert-success alert-dismissable centered-block';
<?php

    }

?>

                    break;

                case 'warning-message':
                case 'warning_message':
<?php

    if ($feedback_message_full_width) {

?>

                    visual_class = 'alert alert-warning alert-dismissable';
<?php

    } else {

?>

                    visual_class = 'alert alert-warning alert-dismissable centered-block';
<?php

    }

?>

                    break;

                case 'error-message':
                case 'error_message':
<?php

    if ($feedback_message_full_width) {

?>

                    visual_class = 'alert alert-danger alert-dismissable';
<?php

    } else {

?>

                    visual_class = 'alert alert-danger alert-dismissable centered-block';
<?php

    }

?>

                    break;
            }

<?php

    if ($feedback_message_full_width) {

?>

            $('#<?php echo $feedback_message_id; ?>').html('<div class="' +  visual_class + '"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> ' +  message + ' </div>');
<?php

    } else {

?>

            $('#<?php echo $feedback_message_id; ?>').html('<div class="centered-block-container"><div class="' +  visual_class + '"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> ' +  message + ' </div></div>');
<?php

    }

?>

        }
    }

    function clear_<?php echo $feedback_message_id; ?>() {
        $('#<?php echo $feedback_message_id; ?>').html('');
    }

    //]]>
    </script>

<?php

}
