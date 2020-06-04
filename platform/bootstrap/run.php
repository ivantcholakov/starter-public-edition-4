<?php

/*
 * --------------------------------------------------------------------
 * Mark the initialization type. Do not modify this setting.
 * --------------------------------------------------------------------
 */
define('NORMAL_MVC_EXECUTION', TRUE);

/*
 * ------------------------------------------------------
 *  Create the system core.
 * ------------------------------------------------------
 */
require dirname(__FILE__).'/create.php';

/*
 * ------------------------------------------------------
 *  Call the requested controller's method
 * ------------------------------------------------------
 */
call_user_func_array(array(&$CI, $method), $params);

/*
 * ------------------------------------------------------
 *  Destroy the system core.
 * ------------------------------------------------------
 */
require dirname(__FILE__).'/destroy.php';
