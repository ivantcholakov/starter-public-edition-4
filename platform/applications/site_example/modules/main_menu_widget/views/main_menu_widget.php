<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2014-2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

?>

        <nav id="main_navigation">

            <div class="ui grid">
                <div class="row">

                <div id="main_menu" class="column">

                    <div class="navbeer ui inverted blue borderless menu page grid">

                        <div class="navbeer-sandwich ui dropdown item" style="display: none;">
                            <i class="navbeer-sandwich-icon content big icon"></i>
                            <div class="navbeer-sandwich-content menu"></div><!--Keep empty-->
                        </div>

                        <a class="navbeer-brand" href="<?php echo site_url(); ?>">
                            <!--<img src="<?php echo base_uri('apple-touch-icon-precomposed.png'); ?>" />-->
                            <span><strong>v. <?php echo PLATFORM_VERSION; ?></strong></span>
                        </a>

                        <div class="navbeer-menu right menu">
<?php

if (!empty($nav)) {

    foreach ($nav as $item) {

        if (empty($item['children'])) {

            $classes = 'item navbeer-collapsable-item';

            if (!empty($item['is_active'])) {
                $classes .= ' active';
            }

?>

                        <a href="<?php echo $item['link']; ?>"<?php if ($classes != '') { ?> class="<?php echo $classes; ?>"<?php } ?>><?php if ($item['icon'] != '') { ?><i class="<?php echo $item['icon']; ?>"></i> <?php } echo $item['label']; ?></a>
<?php

        } else {

            $classes = 'navbeer-collapsable-item ui dropdown item';

            if (!empty($item['is_active'])) {
                // TODO: See why dropdown item does not work when it is active.
                //$classes .= ' active';
            }

?>

                        <div<?php if ($classes != '') { ?> class="<?php echo $classes; ?>"<?php } ?>>

                            <?php if ($item['icon'] != '') { ?><i class="<?php echo $item['icon']; ?>"></i> <?php } echo $item['label']; ?>
                            <i class="dropdown icon"></i>

                            <div class="menu">

                                <a href="<?php echo $item['link']; ?>" class="item<?php if (!empty($item['is_active']) && empty($item['has_active'])) { ?> active<?php } ?>"><?php if ($item['icon'] != '') { ?><i class="<?php echo $item['icon']; ?>"></i> <?php } echo $item['label']; ?></a>
                                <div class="ui divider"></div>

<?php
            _main_menu_widget_display_children($item['children']);
?>

                            </div>

                        </div>
<?php

        }
    }
}

echo Modules::run('theme_switcher_widget/index', 'navbar');
echo Modules::run('language_switcher_widget/index', 'navbar');
?>

                        </div>

                    </div>

                </div>

                </div>
            </div>

        </nav>

<?php

function _main_menu_widget_display_children($items, $level = 0) {

    foreach ($items as $item) {

        if (empty($item['blank'])) {
?>

                                <a href="<?php echo $item['link']; ?>"<?php echo _stringify_attributes($item['attributes']); ?> class="item<?php if (!empty($item['is_active']) && empty($item['has_active'])) { /* !!! */ ?> active<?php } ?>"><?php echo str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $level); if ($item['icon'] != '') { ?><i class="<?php echo $item['icon']; ?>"></i> <?php } echo $item['label']; ?></a>

<?php

        } else {
?>

                                <div class="ui divider"></div>

<?php
        }

        if (!empty($item['children'])) {
            _main_menu_widget_display_children($item['children'], $level + 1);
        }
    }
}
