<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div id="container">

    <div id="body">

        <h1 class="my_section">Administrator Home Page</h1>

<?php

if ($confirmation_message != '') {

?>
        <div style="color: green;"><?php echo $confirmation_message; ?></div>
<?php
}

?>
        <p>
            You have to build your administration interface here.
        </p>

        <p>
            <a href="<?php echo site_url('logout'); ?>">Logout</a>
        </p>

        <p>
            Back to the public site: <a href="<?php echo $public_site_url; ?>"><?php echo $public_site_url; ?></a>
        </p>

    </div>

    <p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
</div>
