<?php defined('BASEPATH') OR exit('No direct script access allowed');

if (!empty($language_switcher)) {

    $item_active = array();

    foreach ($language_switcher as $key => $item) {

        if (!empty($item['active'])) {
            $item_active = $item;
        }
    }

?>

                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" i18n:title="ui_switch_language"><?php echo isset($item_active['flag']) && $item_active['flag'] != '' ? image('lib/flags-iso/flat/16/'.$item_active['flag'].'.png') : $item_active['label']; ?> <span class="fa fa-caret-down"></span></a>
                            <ul class="dropdown-menu">
<?php

        foreach ($language_switcher as $key => $item) {

?>

                                <li><a href="<?php echo $item['link']; ?>"><?php echo isset($item['flag']) && $item['flag'] != '' ? image('lib/flags-iso/flat/16/'.$item['flag'].'.png').' '.$item['label'] : $item['label']; ?></a></li>
<?php
        }

?>

                            </ul>
                        </li>
                    </ul>

<?php

}
