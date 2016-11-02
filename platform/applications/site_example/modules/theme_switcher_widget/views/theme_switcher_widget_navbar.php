<?php defined('BASEPATH') OR exit('No direct script access allowed');

if (!empty($theme_switcher)) {

    $item_active = array();

    foreach ($theme_switcher as $key => $item) {

        if (!empty($item['active'])) {
            $item_active = $item;
        }
    }

?>

                    <div class="navbeer-collapsable-item ui dropdown item">

                            <?php echo 'Theme: '.(isset($item_active['label']) ? $item_active['label'] : ''); ?>
                            <i class="dropdown icon"></i>

                            <div class="menu">
<?php

    foreach ($theme_switcher as $key => $item) {

?>

                                <a class="item<?php if (!empty($item['active'])) { ?> active<?php } ?>" href="<?php echo $item['link']; ?>"><?php echo $item['label']; ?></a>
<?php

    }

?>

                            </div>

                    </div>

<?php

}
