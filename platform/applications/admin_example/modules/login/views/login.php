<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

            <?php echo form_open('', 'class="form-signin" role="form"'); ?>

                <!-- Put your logo here. -->
                <!--<img src="<?php echo default_base_url('apple-touch-icon-precomposed.png'); ?>" class="img-responsive center-block" />-->

                <h2>Admin Login Page</h2>

<?php

echo Modules::run('feedback_messages/feedback_messages_widget/index', array('feedback_message_expand' => true));

?>

                <div class="form-group<?php if (!empty($validation_errors['username'])) { ?> has-error<?php } ?>">
                    <label for="username" class="control-label">* <?php echo $this->lang->line('ui_username').' / '.'E-mail'; ?></label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                        <input type="text" name="username" id="username" class="form-control" value="<?php echo set_value('username'); ?>" />
                    </div>
                </div>

                <div class="form-group<?php if (!empty($validation_errors['password'])) { ?> has-error<?php } ?>">
                    <label for="password" class="control-label">* <i18n>ui_password</i18n></label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
                        <input type="password" name="password" id="password" class="form-control" value="<?php echo set_value('password'); ?>" />
                    </div>
                </div>

                <div class="form-group">

                    <div class="img-thumbnail">

                        <img id="captcha_image"
                            src="<?php echo $this->captcha->src.'?nocache='.rand(100000000, 999999999); ?>"
                            class="img-thumbnail"
                            style="cursor: pointer; margin-right: 5px; padding: 0; border-radius: 4px;"
                            i18n:title="captcha.tip"
                        /><button type="button" id="captcha_refresh" class="btn btn-default" i18n:title="ui_refresh"
                            style="vertical-align: middle; margin-top: 5px; margin-bottom: 5px; margin-right: 2px; outline: 0;"
                        >
                            <i id="captcha_refresh" class="fa fa-refresh"></i>
                        </button>

                    </div>

                </div>

                <div class="form-group<?php if (!empty($validation_errors['captcha'])) { ?> has-error<?php } ?>">
                    <label for="captcha" class="control-label">* <i18n>captcha.label</i18n></label>
                    <input type="text" id="captcha" name="captcha" class="form-control" maxlength="<?php echo $this->captcha->length; ?>" value="<?php echo set_value('catcha'); ?>" />
                </div>

                <div class="form-group">
                    <button class="btn btn-lg btn-primary btn-block" type="submit"><i class="fa fa-sign-in"> <i18n>ui_login</i18n></i></button>
                </div>

                <div class="form-group">
                    <p class="help-block">
                        Enter random username and password, enter the captcha string, and click on "Login" button to get in.
                    </p>
                </div>

                <div class="form-group">
                    <p class="help-block">
                        Back to the public site: <a href="<?php echo default_base_url(); ?>"><?php echo default_base_url(); ?></a>
                    </p>
                </div>

            <?php echo form_close(); ?>
