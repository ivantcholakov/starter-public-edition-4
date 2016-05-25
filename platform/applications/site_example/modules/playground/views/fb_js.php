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
                                <h3>Javascript SDK login example</h3>

                                <p>Simple example how you can use the Facebook PHP SDK for CodeIgniter together with the Facebook Javascript SDK and the login to Facebook functionality.</p>

                                <p><strong>For this example to work, make sure you have set 'facebook_login_type' as 'js' in the config file and have <i>publish_actions</i> permissions!</strong></p>

                                <p>
                                        This example code do 4 things
                                        <ol>
                                                <li>Check if the user is logged in to Facebook on page load.</li>
                                                <li>If user are logged in, display form to user to publish to their wall.</li>
                                                <li>If user is not logged in, display login button.</li>
                                                <li>Display the form after login and publish to users wall when subbmitting form without any page refresh</li>
                                        </ol>
                                </p>

                                <div class="login">
                                        <button>Login</button>
                                </div>

                                <div class="form">
                                        <form class="post-to-wall">
                                                <textarea name="message" placeholder="Type some text here and submit to post to your wall"></textarea>
                                                <input type="submit" name="submit" value="Post" />
                                        </form>
                                </div>

                                <p class="note"><i>Note: You can publish text posts to a users wall using only the Javascript SDK. This is ONLY an example on how the Javascript SDK can work togheter with the PHP SDK to publish and/or read information and content.</i></p>


                        </div>

<?php

}

?>

                    </div>

                </div>

            </div>

        </section>
