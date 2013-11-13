<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div id="container">

    <div id="body">

        <h1 class="my_section">Login Page</h1>

<?php

if ($error_message != '') {

?>
        <div style="border: 1px solid red;"><?php echo $error_message; ?></div>
<?php
}

?>
        <p>
            <?php echo form_open(); ?>

                <label for="username">Username:</label>
                <br />
                <input type="text" name="username" id="username" value="<?php echo set_value('username'); ?>"/>

                <br />
                <br />
    

                <label for="password">Password:</label>
                <br />
                <input type="password" name="password" id="password" value="<?php echo set_value('password');  ?>"/>

                <br />
                <br />

                <button type="submit">Login</button>

            <?php echo form_close(); ?>

        </p>

        <p>
            Eneter random username and password and click on "Login" button to get in.
        </p>

        <p>
            Back to the public site: <a href="<?php echo $public_site_url; ?>"><?php echo $public_site_url; ?></a>
        </p>

    </div>

    <p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
</div>
