<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

            <div class="page-header">
                <h1>Administrator's Home Page</h1>
            </div>

<?php

echo Modules::run('feedback_messages/feedback_messages_widget/index');

?>

            <p>
                You have to build your administration interface here.
            </p>

            <p>
                Back to the public site: <a href="<?php echo default_base_url(); ?>"><?php echo default_base_url(); ?></a>
            </p>
