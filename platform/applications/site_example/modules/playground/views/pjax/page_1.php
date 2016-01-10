<?php defined('BASEPATH') OR exit('No direct script access allowed.');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2015
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

template_partial('pjax_subnavbar');

?>

        <section>

            <div class="container">

                <div class="page-header">
                    <h1><?php echo $template['page_title']; ?></h1>
                </div>

                <div class="row">

                    <div class="col-md-4">

                        <p>A page containing an image</p>

                        <p><img src="<?php echo image_path('playground.jpg'); ?>" class="thumbnail img-responsive" /></p>

                    </div>

                </div>

            </div>

        </section>
