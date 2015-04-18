<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

        <section>

            <div class="container">

                <div class="row">

                    <div class="col-md-12">


<?php

if ($error_message != '') {

?>

                        <div class="alert alert-warning text-center"><?php echo $error_message; ?></div>

<?php

} else {

?>

                        <div class="wrapper">

                            <h1>Facebook PHP SDK v4 for CodeIgniter</h1>

                            <p>Library for integration of Facebook PHP SDK v4 with CodeIgniter 3</p>

                            <p><strong>Version:</strong> 2.0.0</p>

                            <p>Documentation for this library can be found <a href="https://github.com/darkwhispering/facebook-sdk-v4-codeigniter/" target="_blank">here</a>, and documentation about Facebook PHP SDK v4 can be found <a href="https://developers.facebook.com/docs/php/gettingstarted/4.0.0" target="_blank">here</a>.</p>

                            <div class="examples">
                                <a href="<?php echo site_url('playground/fb/web-login'); ?>" class="web">Redirect Login<br/>Example</a>
                                <a href="<?php echo site_url('playground/fb/js-login'); ?>" class="js">Javascript Login<br/>Example</a>
                            </div>

                        </div>
<?php

}

?>

                    </div>

                </div>

            </div>

        </section>
