<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2015
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

// Place the following function within a helper file and load it.
// Rework this function not to access images that should be
// protected with watermarks.
if (!function_exists('image_process_nowm')) {

    function image_process_nowm($src, $width = null, $height = null, $no_crop = null, $keep_canvas_size = null) {

        if ($no_crop !== null) {
            $no_crop = empty($no_crop) ? 0 : 1;
        }

        if ($keep_canvas_size !== null) {
            $keep_canvas_size = empty($keep_canvas_size) ? 0 : 1;
        }

        return http_build_url(site_url('playground/image-process-nowm'), array('query' => http_build_query(array('src' => $src, 'w' => $width, 'h' => $height, 'no_crop' => $no_crop, 'keep_canvas_size' => $keep_canvas_size))), HTTP_URL_JOIN_QUERY);
    }
}

if (!function_exists('_display_colorbox_gallery')) {

    function _display_colorbox_gallery($images, $mode = null) {

        $mode = $mode != '' ? 'colorbox-'.$mode : 'colorbox';

        if (!empty($images)) {

            foreach ($images as $image) {

                $image_url = image_url($image['image']);
                $image_thumb_url = image_process_nowm($image_url, 180, 120);

?>

                        <div class="image-container">
                            <a href="<?php echo $image_url; ?>" title="<?php echo isset($image['title']) ? html_escape($image['title']) : ''; ?>" target="blank" rel="<?php echo html_escape($mode); ?>"><img src="<?php echo $image_thumb_url; ?>" /></a>
                        </div>

<?php

            }
        }
    }
}

?>

    <style>
        .image-container {
            float: left;
            margin: 5px;
        }
    </style>

        <section>

            <div class="container">

                <div class="page-header">
                    <h1><?php echo $template['page_title']; ?></h1>
                </div>

                <p>
                    <a href="http://www.jacklmoore.com/colorbox/" target="_blank">http://www.jacklmoore.com/colorbox/</a>,
                    <a href="https://github.com/jackmoore/colorbox" target="_blank">https://github.com/jackmoore/colorbox</a>
                </p>

                <div class="col-md-12">

                    <h3>Colorbox - Default Mode</h3>

                    <div class="clearfix"></div>

                    <div>

<?php

_display_colorbox_gallery($images);

?>

                    </div>

                    <div class="clearfix"></div>

                </div>

                <div class="col-md-12">

                    <h3>Colorbox - Slideshow Mode</h3>

                    <div class="clearfix"></div>

                    <div>

<?php

_display_colorbox_gallery($images, 'slideshow');

?>

                    </div>

                    <div class="clearfix"></div>

                </div>

            </div>

        </section>
