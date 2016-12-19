<?php

/** This file is part of KCFinder project
  *
  *      @desc Upload calling script
  *   @package KCFinder
  *   @version 2.54
  *    @author Pavel Tzonkov <sunhater@sunhater.com>
  * @copyright 2010-2014 KCFinder Project
  *   @license http://www.opensource.org/licenses/gpl-2.0.php GPLv2
  *   @license http://www.opensource.org/licenses/lgpl-2.1.php LGPLv2
  *      @link http://kcfinder.sunhater.com
  */

// Added by Ivan Tcholakov, 20-OCT-2013.
require dirname(__FILE__).'/../../config.php';
require $PLATFORMCREATE;
ci()->load->helper('template');
//

require "core/autoload.php";
$uploader = new uploader();
$uploader->upload();

// Added by Ivan Tcholakov, 20-OCT-2013.
require $PLATFORMDESTROY;
//
