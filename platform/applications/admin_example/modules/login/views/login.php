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

                <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>

                <p class="help-block">
                    Enter random username and password and click on "Login" button to get in.
                </p>

                <p class="help-block">
                    Back to the public site: <a href="<?php echo $public_site_url; ?>"><?php echo $public_site_url; ?></a>
                </p>

            <?php echo form_close(); ?>
