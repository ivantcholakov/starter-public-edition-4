<?php defined('BASEPATH') OR exit('No direct script access allowed');

if (!empty($theme_switcher)) {

    $item_active = array();

    foreach ($theme_switcher as $key => $item) {

        if (!empty($item['active'])) {
            $item_active = $item;
        }
    }

?>

                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" i18n:title="ui_switch_language"><?php echo 'Theme: '.(isset($item_active['label']) ? $item_active['label'] : ''); ?> <span class="fa fa-caret-down"></span></a>
                            <ul class="dropdown-menu">
<?php

    foreach ($theme_switcher as $key => $item) {

?>

                                <li<?php if (!empty($item['active'])) { ?> class="active"<?php } ?>><a href="<?php echo $item['link']; ?>"><?php echo $item['label']; ?></a></li>
<?php

    }

?>

                            </ul>
                        </li>
                    </ul>

<?php

}
