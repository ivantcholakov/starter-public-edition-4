<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2014-2015
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

?>

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

if (!empty($nav)) {

?>

                    <ul class="nav navbar-nav">
<?php

    foreach ($nav as $item) {

        if (empty($item['children'])) {

            $classes = '';

            if (!empty($item['is_active'])) {
                $classes = ' active';
            }

            $classes = trim($classes);

?>

                        <li<?php if ($classes != '') { ?> class="<?php echo $classes; ?>"<?php } ?>><a href="<?php echo $item['link']; ?>"><?php if ($item['icon'] != '') { ?><i class="<?php echo $item['icon']; ?> hidden-md"></i>&nbsp; <?php } echo $item['label']; ?></a></li>
<?php

        } else {

?>

                        <li class="dropdown dropdown-split-right">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">
                                <?php if ($item['icon'] != '') { ?><i class="<?php echo $item['icon']; ?> hidden-sm"></i>&nbsp; <?php } echo $item['label']; ?> <i class="fa fa-caret-down"></i>
                            </a>
                            <ul class="dropdown-menu pull-right-sm">

                                <li<?php if (!empty($item['is_active']) && empty($item['has_active'])) { ?> class="active"<?php } ?>><a href="<?php echo $item['link']; ?>"><?php if ($item['icon'] != '') { ?><i class="<?php echo $item['icon']; ?>"></i>&nbsp; <?php } echo $item['label']; ?></a></li>
                                <li class="divider"></li>

<?php
            _main_menu_widget_display_children($item['children']);
?>

                            </ul>
                        </li>
<?php

        }
    }

?>

                    </ul>
<?php

}

echo Modules::run('language_switcher_widget/index', 'navbar');

?>

                </div>

            </div>

        </div>

<?php

function _main_menu_widget_display_children($items, $level = 0) {

    foreach ($items as $item) {

        if (empty($item['blank'])) {
?>

                                <li<?php if (!empty($item['is_active'])) { ?> class="active"<?php } ?>><a href="<?php echo $item['link']; ?>"<?php echo _stringify_attributes($item['attributes']); ?>><?php echo str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $level); if ($item['icon'] != '') { ?><i class="<?php echo $item['icon']; ?>"></i>&nbsp; <?php } echo $item['label']; ?></a></li>

<?php

        } else {
?>

                                <li class="divider"></li>

<?php
        }

        if (!empty($item['children'])) {
            _main_menu_widget_display_children($item['children'], $level + 1);
        }
    }
}
