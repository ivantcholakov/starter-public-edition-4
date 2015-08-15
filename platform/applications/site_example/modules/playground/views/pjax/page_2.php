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
                    <h1>Pjax - Test Page 2</h1>
                </div>

                <div class="row">

                    <div class="col-md-4">

                        <p>A page containing a video</p>


<?php

if (!is_php($php_required)) {

?>

                        <div class="status alert alert-warning">
                           PHP <?php echo $php_required; ?> is required for this example.
                        </div>

<?php

} else {

?>


                        <p><?php echo $this->multiplayer->html($video); ?></p>

                        <p><a href="<?php echo $video; ?>" target="_blank"><?php echo $video; ?></a></p>

<?php

}

?>

                    </div>

                </div>

            </div>

        </section>
