<?php defined('BASEPATH') OR exit('No direct script access allowed.');

$config['disabled'] = true;
$config['denyZipDownload'] = true;
$config['denyUpdateCheck'] = true;
$config['denyExtensionRename'] = true;
$config['theme'] = 'oxygen';
$config['uploadURL'] = resolve_path(DEFAULT_BASE_URI.'editor/');
$config['uploadDir'] = resolve_path(DEFAULTFCPATH.'editor/');
$config['dirPerms'] = DIR_READ_MODE;
$config['filePerms'] = FILE_READ_MODE;

$config['access'] = array(

    'files' => array(
        'upload' => true,
        'delete' => true,
        'copy' => true,
        'move' => true,
        'rename' => true
    ),

    'dirs' => array(
        'create' => true,
        'delete' => true,
        'rename' => true
    )
);

$config['deniedExts'] = 'exe com msi bat php phps phtml php3 php4 cgi pl';
// Native CKEditor types
$config['types']['files'] = '';
$config['types']['flash'] = 'swf';
$config['types']['images'] = '*img';
// Native TinyMCE types
$config['types']['file'] = '';
$config['types']['media'] = 'swf flv avi mpg mpeg qt mov wmv asf rm';
$config['types']['image'] = '*img';

$config['filenameChangeChars'] = array(/*
    ' ' => "_",
    ':' => "."
*/);

$config['dirnameChangeChars'] = array(/*
    ' ' => "_",
    ':' => "."
*/);

$config['mime_magic'] = '';
$config['maxImageWidth'] = 0;
$config['maxImageHeight'] = 0;
$config['thumbWidth'] = 100;
$config['thumbHeight'] = 100;
$config['thumbsDir'] = '.thumbs';
$config['jpegQuality'] = 90;

$config['cookieDomain'] = '';
$config['cookiePath'] = '';
$config['cookiePrefix'] = 'KCFINDER_';

$config['_check4htaccess'] = false;
