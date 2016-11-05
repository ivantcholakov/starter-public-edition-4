<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

                                            <select name="<?php echo $element_name; ?>" id="<?php echo $element_id; ?>"<?php if ($element_class != '') { ?> class="<?php echo $element_class; ?>"<?php } ?>>
                                                <option value=""<?php if ($value == '') { ?> selected="selected"<?php } ?> data-img-src="<?php echo image_path('lib/flags-iso/flat/24/_unknown.png'); ?>">-- <?php echo $this->lang->line('ui_choose'); ?> --</option>
<?php

if (!empty($options)) {

    foreach ($options as $key => $option) {

        $flag = $codes[$key];

        if ($flag != '') {
            $flag = image_path('lib/flags-iso/flat/24/'.$flag.'.png');
        }
?>
                                                <option value="<?php echo $key; ?>"<?php if ($value == $key) { ?> selected="selected"<?php } ?><?php if ($flag != '') { ?> data-img-src="<?php echo $flag; ?>"<?php }?>><?php echo $option; ?></option>
<?php
    }
}

?>
                                            </select>
