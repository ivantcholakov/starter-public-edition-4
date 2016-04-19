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

                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">

                                <thead>

                                    <tr>
                                        <th>Static Thumbnails</th>
                                        <th>Dynamic Thumbnails</th>
                                    </tr>

                                </thead>

                                <tfoot>

                                    <tr>
                                        <th>Static Thumbnails</th>
                                        <th>Dynamic Thumbnails</th>
                                    </tr>

                                </tfoot>

                                <tbody>

                                    <tr class="info">
                                        <td colspan="2">
                                            <h4 class="text-center">Fit an Image by Width</h4>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
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
                                        </td>
                                        <td>
                                            <p>
                                                <img src="<?php echo thumbnail($my_image, 120, null, null, null, true); ?>" />
                                                <br />
                                                width = 120px
                                            </p>

                                            <p>
                                                <img src="<?php echo thumbnail($my_image, 180, null, null, null, true); ?>" />
                                                <br />
                                                width = 180px
                                            </p>
                                        </td>
                                    </tr>

                                    <tr class="info">
                                        <td colspan="2">
                                            <h4 class="text-center">Fit an Image by Height</h4>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
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
                                        </td>
                                        <td>
                                            <p>
                                                <img src="<?php echo thumbnail($my_image, null, 120, null, null, true); ?>" />
                                                <br />
                                                height = 120px
                                            </p>

                                            <p>
                                                <img src="<?php echo thumbnail($my_image, null, 180, null, null, true); ?>" />
                                                <br />
                                                height = 180px
                                            </p>
                                        </td>
                                    </tr>

                                    <tr class="info">
                                        <td colspan="2">
                                            <h4 class="text-center">Fit an Image by Width and Height<br /><small>(the image is cropped for ratio maintaining)</small></h4>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
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
                                        </td>
                                        <td>
                                            <p>
                                                <img src="<?php echo thumbnail($my_image, 180, 120, null, null, true); ?>" />
                                                <br />
                                                width = 180px, height = 120px
                                            </p>

                                            <p>
                                                <img src="<?php echo thumbnail($my_image, 120, 180, null, null, true); ?>" />
                                                <br />
                                                width = 120px, height = 180px
                                            </p>
                                        </td>
                                    </tr>

                                    <tr class="info">
                                        <td colspan="2">
                                            <h4 class="text-center">Resize an Image Within Width and Height<br /><small>(the image is not being cropped)</small></h4>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
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
                                        </td>
                                        <td>
                                            <p>
                                                <div class="image-container image-container-180x120">
                                                    <img src="<?php echo thumbnail($my_image, 180, 120, true, null, true); ?>" />
                                                </div>

                                                width = 180px, height = 120px
                                            </p>

                                            <p>
                                                <div class="image-container image-container-120x180">
                                                    <img src="<?php echo thumbnail($my_image, 120, 180, true, null, true); ?>" />
                                                </div>
                                                width = 120px, height = 180px
                                            </p>
                                        </td>
                                    </tr>

                                    <tr class="info">
                                        <td colspan="2">
                                            <h4 class="text-center">Fit an Image Within a Canvas with Given Width and Height<br /><small>(the image fits within a canvas with a given backgrond color)</small></h4>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
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
                                        </td>
                                        <td>
                                            <p>
                                                <div class="image-container image-container-180x120">
                                                    <img src="<?php echo thumbnail($my_image, 180, 120, true, true, true); ?>" />
                                                </div>

                                                width = 180px, height = 120px
                                            </p>

                                            <p>
                                                <div class="image-container image-container-120x180">
                                                    <img src="<?php echo thumbnail($my_image, 120, 180, true, true, true); ?>" />
                                                </div>
                                                width = 120px, height = 180px
                                            </p>
                                        </td>
                                    </tr>

                                </tbody>

                            </table>
                        </div>

            </div>

        </section>
