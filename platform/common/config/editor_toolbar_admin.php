<?php defined('BASEPATH') OR exit('No direct script access allowed.');

$config = array(
	/* tools */       array('Maximize', 'ShowBlocks', '-', 'About'),
	/* document */    array('Source', '-', 'Preview'),
	/* clipboard */   array('Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo'),
	/* editing */     array('Find', 'Replace', '-', 'SelectAll'),
	'/',
	/* basicstyles */ array('Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat'),
	/* paragraph */   array('NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'),
	/* links */       array('Link', 'Unlink', 'Anchor'),
	'/',
	/* styles */      array('Format', 'Font', 'FontSize'),
	/* colors */      array('TextColor', 'BGColor'),
	/* insert */      array('Image', /*'Flash', */'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak'),
);
