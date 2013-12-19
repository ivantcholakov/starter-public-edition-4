<?php defined('BASEPATH') OR exit('No direct script access allowed');

$segment_1 = $this->uri->rsegment(1);

?>

        <!-- Fixed navbar -->
        <div class="navbar navbar-default navbar-fixed-top" role="navigation">

            <div class="container">

                <div class="navbar-header">

                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <a class="navbar-brand" href="<?php echo site_url(); ?>">v. <?php echo PLATFORM_VERSION; ?></a>

                </div>

                <div class="collapse navbar-collapse">

                    <ul class="nav navbar-nav">

                        <li<?php if ($segment_1 == '' || $segment_1 == 'welcome') { ?> class="active"<?php } ?>><a href="<?php echo site_url(); ?>">Home</a></li>

                        <li<?php if ($segment_1 == 'readme') { ?> class="active"<?php } ?>><a href="<?php echo site_url('readme'); ?>">README</a></li>

                    </ul>

              </div>

            </div>

        </div>
