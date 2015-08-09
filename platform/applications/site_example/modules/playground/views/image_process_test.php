<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2015
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

// Place the following function within a helper file and load it.
if (!function_exists('image_process')) {

    function image_process($src, $width = null, $height = null) {

        return http_build_url(site_url('playground/image-process'), array('query' => http_build_query(array('src' => $src, 'w' => $width, 'h' => $height))), HTTP_URL_JOIN_QUERY);
    }
}

// The image we play with, full URL.
$my_image = image_url('playground.jpg');

?>

        <section>

            <div class="container">

                <div class="page-header">
                    <h1>Image Manipulations Test</h1>
                </div>

                <div class="col-md-4">

                    <h3>Fit Image by Width</h3>

                    <p>
                        <img src="<?php echo image_process($my_image, 120); ?>" />
                        <br />
                        width = 120px
                    </p>

                    <p>
                        <img src="<?php echo image_process($my_image, 160); ?>" />
                        <br />
                        width = 160px
                    </p>

                </div>

                <div class="col-md-4">

                    <h3>Fit Image by Height</h3>

                    <p>
                        <img src="<?php echo image_process($my_image, null, 120); ?>" />
                        <br />
                        height = 120px
                    </p>

                    <p>
                        <img src="<?php echo image_process($my_image, null, 160); ?>" />
                        <br />
                        height = 160px
                    </p>

                </div>

                <div class="col-md-4">

                    <h3>Fit Image by Width and Height</h3>
                    <h4 style="margin-bottom: 10px;">(the image is cropped for ratio maintaining)</h4>

                    <p>
                        <img src="<?php echo image_process($my_image, 160, 120); ?>" />
                        <br />
                        width = 160px, height = 120px
                    </p>

                    <p>
                        <img src="<?php echo image_process($my_image, 120, 160); ?>" />
                        <br />
                        width = 120px, height = 160px
                    </p>

                </div>


            </div>

        </section>
