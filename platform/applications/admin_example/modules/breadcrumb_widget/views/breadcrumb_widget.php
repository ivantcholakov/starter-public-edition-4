<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

            <div class="row">
                <div class="col-lg-12">

                    <ol class="breadcrumb">
<?php

    $i = 1;

    foreach ($breadcrumbs as $breadcrumb) {

        if ($i < $n) {
?>
                    <li><a href="<?php echo $breadcrumb['uri']; ?>"><?php echo $breadcrumb['name']; ?></a>
<?php
        } else {
?>
                    <li class="active"><?php echo $breadcrumb['name']; ?></li>
<?php
        }

        $i++;
    }
?>

                    </ol>

                </div>
            </div>
