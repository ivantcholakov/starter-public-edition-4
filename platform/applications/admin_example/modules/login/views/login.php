<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

            <?php echo form_open('', 'class="form-signin" role="form"'); ?>

<?php
if ($error_message != '') {

?>
                <div class="alert alert-danger"><?php echo $error_message; ?></div>
<?php
}

?>              <h2 class="form-signin-heading">Login Page</h2>

                <input type="text" name="username" id="username" class="form-control" placeholder="Username" value="<?php echo set_value('username'); ?>" />
                <input type="password" name="password" id="password" class="form-control" placeholder="Password" value="<?php echo set_value('password'); ?>" />

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

                <input type="text" id="captcha" name="captcha" class="form-control" i18n:placeholder="captcha.label" maxlength="<?php echo $this->captcha->length; ?>" value="<?php echo set_value('catcha'); ?>" />

                <button class="btn btn-lg btn-primary btn-block" type="submit"><i class="fa fa-sign-in"> Login</i></button>

                <p class="help-block">
                    Enter random username and password, enter the captcha string, and click on "Login" button to get in.
                </p>

                <p class="help-block">
                    Back to the public site: <a href="<?php echo default_base_url(); ?>"><?php echo default_base_url(); ?></a>
                </p>

            <?php echo form_close(); ?>
