<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2014
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

?>

        <section>

            <div class="container">

                <div class="page-header">
                    <h1>Gravatar Test</h1>
                </div>

                <div class="row">

                    <div class="col-md-4">

                        <h3>Request:</h3>

                        <?php echo form_open('', 'id="gravatar_test_form" method="post" role="form"'); ?>
<?php

if (isset($error_message) && $error_message != '') {

?>


                            <div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <?php echo $error_message; ?>
                            </div>

<?php

}

?>

                            <div class="form-group">
                                <div class="input-group<?php if (!empty($validation_errors['email'])) { ?> has-error<?php } ?>" style="width: 100%;">
                                    <span class="input-group-addon"><i class="fa fa-envelope-o fa-fw"></i></span>
                                    <input type="text" id="email" name="email" class="form-control" placeholder="* Enter an email address" value="<?php echo set_value('email', $email); ?>" />
                                </div>
                            </div>

                            <div class="form-group">
                                <img id="captcha_image"
                                    src="<?php echo $this->captcha->src.'?nocache='.rand(100000000, 999999999); ?>"
                                    class="thumbnail"
                                    style="cursor: pointer;"
                                    i18n:title="captcha.tip"
                                />
                            </div>

                            <div class="form-group">
                                <div class="input-group<?php if (!empty($validation_errors['captcha'])) { ?> has-error<?php } ?>">
                                    <span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
                                    <input type="text" id="captcha" name="captcha" class="form-control" i18n:placeholder="captcha.label|* " maxlength="<?php echo $this->captcha->length; ?>" />
                                </div>
                            </div>


                            <div class="form-group">
                                <span class="help-block"><i18n>ui_required_fields_note</i18n></span>
                            </div>

                            <div class="form-group">
                                <button id="gravatar_test_form_submit" name="gravatar_test_form_submit" type="submit" class="btn btn-primary btn-lg">
                                    <i id="gravatar_test_form_submit_icon" class="fa fa-check fa-fw"></i>
                                    <i id="gravatar_test_form_processing" class="fa fa-spinner fa-spin fa-fw" style="display: none;"></i>
                                    Get Gravatar Info
                                </button>
                            </div>

                        <?php echo form_close(); ?>

                        <script type="text/javascript">
                        //<![CDATA[

                        function refresh_captcha() {

                            $('#captcha_image').attr('src', '<?php echo $this->captcha->src; ?>' + '?nocache=' + Math.random()*999999999);
                            $('#gravatar_test_form_captcha').val('');
                        }

                        $(function () {

                            $('#captcha_image').on('click', function() {
                                refresh_captcha();
                            });

                            $('#gravatar_test_form').submit(function(e) {

                                $('#gravatar_test_form_submit').attr('disabled', 'disabled');
                                $('#gravatar_test_form_submit_icon').hide();
                                $('#gravatar_test_form_processing').show();
                            });

                        });

                        //]]>
                        </script>

                    </div>

                    <div class="col-md-8">

<?php

if ($this->input->method() == 'post' && empty($error_message)) {

?>
                        <h3>Result:</h3>

                        <p>
                            <img class="img-thumbnail" src="<?php echo $gravatar; ?>" />
                        </p>

                        <?php echo print_d($profile); ?>

                        <div class="clearfix"></div>

                        <?php echo print_d($last_error); ?>

                        <div class="clearfix"></div>

<?php

}

?>


                    </div>

                </div>

            </div>

        </section>
