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
                    <li<?php if ($subnavbar_item_active == 'simple-example') { ?> class="active"<?php } ?>><a href="<?php echo site_url('playground/datatables'); ?>">DataTables Simple Example</a></li>
                    <li<?php if ($subnavbar_item_active == 'ssp') { ?> class="active"<?php } ?>><a href="<?php echo site_url('playground/datatables/ssp'); ?>">DataTables with Server-Side Processing</a></li>
                </ul>
