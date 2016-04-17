<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2015-2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

// The image we play with, full URL.
$my_image = image_url('playground.jpg');

?>

    <style>
        .image-container {
            border: 1px solid blue;
            display:table-cell;
            vertical-align:middle;
            text-align: center;
        }
        .image-container-120x180 {
            width: 120px;
            height: 180px;
        }
        .image-container-180x120 {
            width: 180px;
            height: 120px;
        }
    </style>

        <section>

            <div class="container">

                <div class="page-header">
                    <h1><?php echo $template['page_title']; ?></h1>
                </div>

                <div class="col-md-6">

                    <h3>Fit an Image by Width</h3>

                    <p>
                        <img src="<?php echo thumbnail($my_image, 120); ?>" />
                        <br />
                        width = 120px
                    </p>

                    <p>
                        <img src="<?php echo thumbnail($my_image, 180); ?>" />
                        <br />
                        width = 180px
                    </p>

                </div>

                <div class="col-md-6">

                    <h3>Fit an Image by Height</h3>

                    <p>
                        <img src="<?php echo thumbnail($my_image, null, 120); ?>" />
                        <br />
                        height = 120px
                    </p>

                    <p>
                        <img src="<?php echo thumbnail($my_image, null, 180); ?>" />
                        <br />
                        height = 180px
                    </p>

                </div>

                <div class="col-md-6">

                    <h3>Fit an Image by Width and Height</h3>
                    <h4 style="margin-bottom: 10px;">(the image is cropped for ratio maintaining)</h4>

                    <p>
                        <img src="<?php echo thumbnail($my_image, 180, 120); ?>" />
                        <br />
                        width = 180px, height = 120px
                    </p>

                    <p>
                        <img src="<?php echo thumbnail($my_image, 120, 180); ?>" />
                        <br />
                        width = 120px, height = 180px
                    </p>

                </div>

                <div class="col-md-6">

                    <h3>Resize an Image Within Width and Height</h3>
                    <h4 style="margin-bottom: 10px;">(the image is not being cropped)</h4>

                    <p>
                        <div class="image-container image-container-180x120">
                            <img src="<?php echo thumbnail($my_image, 180, 120, true); ?>" />
                        </div>

                        width = 180px, height = 120px
                    </p>

                    <p>
                        <div class="image-container image-container-120x180">
                            <img src="<?php echo thumbnail($my_image, 120, 180, true); ?>" />
                        </div>
                        width = 120px, height = 180px
                    </p>

                </div>

                <div class="col-md-6">

                    <h3>Fit an Image Within a Canvas with Given Width and Height</h3>
                    <h4 style="margin-bottom: 10px;">(the image fits within a canvas with a given backgrond color)</h4>

                    <p>
                        <div class="image-container image-container-180x120">
                            <img src="<?php echo thumbnail($my_image, 180, 120, true, true); ?>" />
                        </div>

                        width = 180px, height = 120px
                    </p>

                    <p>
                        <div class="image-container image-container-120x180">
                            <img src="<?php echo thumbnail($my_image, 120, 180, true, true); ?>" />
                        </div>
                        width = 120px, height = 180px
                    </p>

                </div>

            </div>

        </section>
