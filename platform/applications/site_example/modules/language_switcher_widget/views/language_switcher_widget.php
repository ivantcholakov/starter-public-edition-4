<?php defined('BASEPATH') OR exit('No direct script access allowed');

if (!empty($language_switcher)) {

    $i = 0;

    foreach ($language_switcher as $key => $item) {

        if ($i > 0) {
            echo ' | ';
        }

        if (!empty($item['active'])) {
?>

    <strong><?php echo anchor($item['link'], image('lib/flags/'.$item['flag'].'.png').' '.$item['label']); ?></strong>
<?php

        } else {

?>

    <?php echo anchor($item['link'], image('lib/flags/'.$item['flag'].'.png'). ' '.$item['label']); ?>

<?php
        }

        $i++;
    }
}
