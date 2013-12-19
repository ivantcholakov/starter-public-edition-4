<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

            <div class="page-header">
                <h1>Administrator's Home Page</h1>
            </div>

<?php

if ($confirmation_message != '') {

?>
            <div class="alert alert-success"><?php echo $confirmation_message; ?></div>
<?php
}

?>
            <p>
                You have to build your administration interface here.
            </p>

            <p>
                Back to the public site: <a href="<?php echo $public_site_url; ?>"><?php echo $public_site_url; ?></a>
            </p>
