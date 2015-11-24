<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

            <div class="page-header">
                <h1>Administrator's Home Page</h1>
            </div>

<?php

echo Modules::run('feedback_messages_widget/index', array('full_width' => false));

?>

            <p>
                You have to build your administration interface here.
            </p>

            <p>
                Back to the public site: <a href="<?php echo default_base_url(); ?>"><?php echo default_base_url(); ?></a>
            </p>

            <p>A Material Design icon: <i class="material-icons">star</i> <i class="material-icons">&#xE838;</i></p>
            <p>A Font Awesome icon: <i class="fa fa-star"></i></p>
            <p>A Glyphicon: <span class="glyphicon glyphicon-star"></span></p>
