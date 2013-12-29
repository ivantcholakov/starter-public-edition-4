<?php defined('BASEPATH') OR exit('No direct script access allowed');

$segment_1 = $this->uri->rsegment(1);

?>

        <!-- Fixed navbar -->
        <div class="navbar navbar-default navbar-fixed-top" role="navigation">

            <div class="container">

                <div class="navbar-header">

                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only"><i18n>ui_toggle_navigation</i18n></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <a class="navbar-brand" href="<?php echo site_url(); ?>">v. <?php echo PLATFORM_VERSION; ?></a>

                </div>

                <div class="collapse navbar-collapse">

                    <ul class="nav navbar-nav">

                        <li<?php if ($segment_1 == '' || $segment_1 == 'welcome') { ?> class="active"<?php } ?>><a href="<?php echo site_url(); ?>"><i class="fa fa-home"></i> Home</a></li>

                        <li<?php if ($segment_1 == 'readme') { ?> class="active"<?php } ?>><a href="<?php echo site_url('readme'); ?>"><i class="fa fa-info-circle"></i> README</a></li>

                        <li<?php if ($segment_1 == 'contact_page_test') { ?> class="active"<?php } ?>><a href="<?php echo site_url('contact-page-test'); ?>"><i class="fa fa-envelope"></i> Contact Page Test</a></li>

                        <li<?php if ($segment_1 == 'playground' || $this->uri->segment(1) == 'playground' || $this->uri->segment(2) == 'playground') { ?> class="active"<?php } ?>><a href="<?php echo site_url('playground'); ?>"><i class="fa fa-sun-o"></i> The Playground</a></li>

                    </ul>

              </div>

            </div>

        </div>
