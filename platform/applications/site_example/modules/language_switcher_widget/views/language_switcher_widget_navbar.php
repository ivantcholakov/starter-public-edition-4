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
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" i18n:title="ui_switch_language"><?php echo image('flags/'.$item_active['flag'].'.png'); ?> <b class="caret"></b></a>
                            <ul class="dropdown-menu">
<?php

        foreach ($language_switcher as $key => $item) {

?>

                                <li><a href="<?php echo $item['link']; ?>"><?php echo image('flags/'.$item['flag'].'.png').' '.$item['label']; ?></a></li>
<?php
        }

?>

                            </ul>
                        </li>
                    </ul>

<?php

}
