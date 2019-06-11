<?php defined('BASEPATH') OR exit('No direct script access allowed.');

$config['disabled'] = true;
$config['denyZipDownload'] = true;
$config['denyUpdateCheck'] = true;
$config['denyExtensionRename'] = true;
$config['theme'] = 'default';
$config['uploadURL'] = resolve_path(DEFAULT_BASE_URI.'editor/');
$config['uploadDir'] = resolve_path(DEFAULTFCPATH.'editor/');
$config['dirPerms'] = DIR_WRITE_MODE;
$config['filePerms'] = FILE_WRITE_MODE;

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

$config['deniedExts'] = 'exe com msi bat cgi pl php phps phtml php3 php4 php5 php6 py pyc pyo pcgi pcgi3 pcgi4 pcgi5 pchi6';
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
$config['jpegQuality'] = 100;

$config['cookieDomain'] = '';
$config['cookiePath'] = '';
$config['cookiePrefix'] = 'KCFINDER_';

$config['_check4htaccess'] = false;
$config['_normalizeFilenames'] = false;
$config['_dropUploadMaxFilesize'] = 10485760;
