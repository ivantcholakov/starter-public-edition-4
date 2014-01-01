<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>


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
<?php

$this->menu->container_tag_attrs = 'class="nav navbar-nav"';
echo $this->menu->render($nav, $active, NULL, 'basic');
echo $this->menu->reset();

?>

              </div>

            </div>

        </div>



