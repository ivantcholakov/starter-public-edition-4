<?php

/** This file is part of KCFinder project
  *
  *      @desc Base configuration file
  *   @package KCFinder
  *   @version 3.12
  *    @author Pavel Tzonkov <sunhater@sunhater.com>
  * @copyright 2010-2014 KCFinder Project
  *   @license http://opensource.org/licenses/GPL-3.0 GPLv3
  *   @license http://opensource.org/licenses/LGPL-3.0 LGPLv3
  *      @link http://kcfinder.sunhater.com
  */

/* IMPORTANT!!! Do not comment or remove uncommented settings in this file
   even if you are using session configuration.
   See http://kcfinder.sunhater.com/install for setting descriptions */

// Modified by Ivan Tcholakov, 20-DEC-2016.
//return array(
$_CONFIG = array(
//


// GENERAL SETTINGS

    'disabled' => true,
    'uploadURL' => "upload",
    'uploadDir' => "",
    'theme' => "default",

    'types' => array(

    // (F)CKEditor types
        'files'   =>  "",
        'flash'   =>  "swf",
        'images'  =>  "*img",

    // TinyMCE types
        'file'    =>  "",
        'media'   =>  "swf flv avi mpg mpeg qt mov wmv asf rm",
        'image'   =>  "*img",
    ),


// IMAGE SETTINGS

    'imageDriversPriority' => "imagick gmagick gd",
    // Modified by Ivan Tcholakov, 20-DEC-2016.
    //'jpegQuality' => 90,
    'jpegQuality' => 100,
    //
    'thumbsDir' => ".thumbs",

    'maxImageWidth' => 0,
    'maxImageHeight' => 0,

    'thumbWidth' => 100,
    'thumbHeight' => 100,

    'watermark' => "",


// DISABLE / ENABLE SETTINGS

    'denyZipDownload' => false,
    'denyUpdateCheck' => false,
    'denyExtensionRename' => false,


// PERMISSION SETTINGS

    'dirPerms' => 0755,
    'filePerms' => 0644,

    'access' => array(

        'files' => array(
            'upload' => true,
            'delete' => true,
            'copy'   => true,
            'move'   => true,
            'rename' => true
        ),

        'dirs' => array(
            'create' => true,
            'delete' => true,
            'rename' => true
        )
    ),

    'deniedExts' => "exe com msi bat cgi pl php phps phtml php3 php4 php5 php6 py pyc pyo pcgi pcgi3 pcgi4 pcgi5 pchi6",


// MISC SETTINGS

    'filenameChangeChars' => array(/*
        ' ' => "_",
        ':' => "."
    */),

    'dirnameChangeChars' => array(/*
        ' ' => "_",
        ':' => "."
    */),

    'mime_magic' => "",

    'cookieDomain' => "",
    'cookiePath' => "",
    'cookiePrefix' => 'KCFINDER_',


// THE FOLLOWING SETTINGS CANNOT BE OVERRIDED WITH SESSION SETTINGS

    '_sessionVar' => "KCFINDER",
    '_check4htaccess' => true,
    '_normalizeFilenames' => false,
    '_dropUploadMaxFilesize' => 10485760,
    //'_tinyMCEPath' => "/tiny_mce",
    //'_cssMinCmd' => "java -jar /path/to/yuicompressor.jar --type css {file}",
    //'_jsMinCmd' => "java -jar /path/to/yuicompressor.jar --type js {file}",
);

// Added by Ivan Tcholakov, 12-JUN-2011.
$cfg = isset($_GET['cfg']) ? $_GET['cfg'] : null;
if ($cfg == '') {
    if (isset($_SESSION['KCFINDER']['cfg'])) {
        $cfg = $_SESSION['KCFINDER']['cfg'];
    }
}
if ($cfg != '') {
    if (isset($_SESSION)) {
        $_SESSION['KCFINDER']['cfg'] = $cfg;
    }

    $filemanager_config = KCFinderConfig::get($cfg);

    if (!empty($filemanager_config) && is_array($filemanager_config)) {
        $_CONFIG = array_merge($_CONFIG, $filemanager_config);
    } else {
        unset($_SESSION['KCFINDER']['cfg']);
    }
}
//

// Added by Ivan Tcholakov, 20-DEC-2016.
return $_CONFIG;
//
