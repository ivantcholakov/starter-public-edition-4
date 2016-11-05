<?php defined('BASEPATH') OR exit('No direct script access allowed');

if (!empty($language_switcher)) {

    $item_active = array();

    foreach ($language_switcher as $key => $item) {

        if (!empty($item['active'])) {
            $item_active = $item;
        }
    }

?>

                    <div class="ui dropdown item">

                            <?php echo isset($item_active['flag']) && $item_active['flag'] != '' ? image('lib/flags-iso/flat/24/'.$item_active['flag'].'.png', null, 'class="ui middle aligned umage"') : $item_active['label']; ?>
                            <i class="dropdown icon"></i>

                            <div class="menu">
<?php

        foreach ($language_switcher as $key => $item) {

?>

                                <a class="item<?php if (!empty($item['active'])) { ?> active<?php } ?>" href="<?php echo $item['link']; ?>"><?php echo isset($item['flag']) && $item['flag'] != '' ? image('lib/flags-iso/flat/24/'.$item['flag'].'.png', null, 'class="ui middle aligned umage"').' '.$item['label'] : $item['label']; ?></a>
<?php
        }

?>

                            </div>

                    </div>

<?php

}
