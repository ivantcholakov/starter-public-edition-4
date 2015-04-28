<?php defined('BASEPATH') OR exit('No direct script access allowed.');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2014
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

if (!isset($subnavbar_item_active)) {
    $subnavbar_item_active = '';
}

?>

                <ul class="nav nav-pills">
                    <li<?php if ($subnavbar_item_active == 'v1') { ?> class="active"<?php } ?>><a href="<?php echo site_url('playground/assign-rating'); ?>">Variant 1</a></li>
                    <li<?php if ($subnavbar_item_active == 'v2') { ?> class="active"<?php } ?>><a href="<?php echo site_url('playground/assign-rating-2'); ?>">Variant 2</a></li>
                </ul>
