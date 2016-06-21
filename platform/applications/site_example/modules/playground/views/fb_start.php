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

                            <h1>Facebook PHP SDK for CodeIgniter</h1>

                            <p>Library for integration of Facebook PHP SDK with CodeIgniter 3+</p>

                            <p><strong>Version:</strong> 3.0.0</p>

                            <p>Documentation for this library can be found <a href="https://github.com/darkwhispering/facebook-sdk-codeigniter/" target="_blank">here</a>, and documentation about Facebook PHP SDK v5 can be found <a href="https://developers.facebook.com/docs/php/gettingstarted/" target="_blank">here</a>.</p>

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
