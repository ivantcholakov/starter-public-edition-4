<?php

/** This file is part of KCFinder project
  *
  *      @desc Browser calling script
  *   @package KCFinder
  *   @version 3.12
  *    @author Pavel Tzonkov <sunhater@sunhater.com>
  * @copyright 2010-2014 KCFinder Project
  *   @license http://opensource.org/licenses/GPL-3.0 GPLv3
  *   @license http://opensource.org/licenses/LGPL-3.0 LGPLv3
  *      @link http://kcfinder.sunhater.com
  */

// Added by Ivan Tcholakov, 20-OCT-2013.
require dirname(__FILE__).'/../../config.php';
$assign_to_config['csrf_protection'] = false;
require $PLATFORMCREATE;
ci()->load->helper('template');
//

require "core/bootstrap.php";
$browser = "kcfinder\\browser"; // To execute core/bootstrap.php on older
$browser = new $browser();      // PHP versions (even PHP 4)
$browser->action();

// Added by Ivan Tcholakov, 20-OCT-2013.
require $PLATFORMDESTROY;
//
