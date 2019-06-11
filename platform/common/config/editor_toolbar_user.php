<?php if (!defined('BASEPATH')) { exit('No direct script access allowed.'); }

/*
$config = array(
    array('Save'),
    array('Bold', 'Italic', 'Underline', 'Strike'),
    array('Cut', 'Copy', 'Paste'),
    array('Undo', 'Redo', '-', 'Find', 'Replace', '-', 'SelectAll', 'RemoveFormat'),
    array('Maximize'),
);
*/

/*
$config = array(
    array('Source', '-', 'Preview'),
    array('Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord'),
    array('Undo', 'Redo', '-', 'Find', 'Replace', '-', 'SelectAll', 'RemoveFormat'),
    array( 'Maximize', 'ShowBlocks'),
    '/',
    array('Format', 'Bold', 'Italic', 'Underline', 'Strike', '-', 'Subscript', 'Superscript'),
    array('NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', 'Blockquote'),
    array('JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'),
    array('Table', 'HorizontalRule', 'SpecialChar', 'PageBreak'),
    array('TextColor', 'BGColor')
);
*/

$config = array(
    /* tools */       array('Maximize', 'ShowBlocks'),
    /* document */    array('Preview'),
    /* clipboard */   array('Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo'),
    /* editing */     array('Find', 'Replace', '-', 'SelectAll'),
    '/',
    /* basicstyles */ array('Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat'),
    /* paragraph */   array('NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'),
    '/',
    /* styles */      array('Format', 'Font', 'FontSize'),
    /* colors */      array('TextColor', 'BGColor'),
    /* insert */      array('Table', 'HorizontalRule', 'SpecialChar'),
);
