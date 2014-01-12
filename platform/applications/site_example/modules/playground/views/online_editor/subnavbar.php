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
                    <li<?php if ($subnavbar_item_active == 'user-mode') { ?> class="active"<?php } ?>><a href="<?php echo site_url('playground/online-editor/user-mode'); ?>">Online Editor - User Mode</a></li>
                    <li<?php if ($subnavbar_item_active == 'admin-mode') { ?> class="active"<?php } ?>><a href="<?php echo site_url('playground/online-editor/admin-mode'); ?>">Online Editor - Admin Mode</a></li>
                </ul>
