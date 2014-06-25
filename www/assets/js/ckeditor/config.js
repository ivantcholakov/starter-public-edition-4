/**
 * @license Copyright (c) 2003-2014, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';

	// Allow i tags to be empty (for Font Awesome).
	config.protectedSource.push(/<i[^>]><\/i>/g);
};

// Allow i tags to be empty (for Font Awesome).
CKEDITOR.dtd.$removeEmpty['i'] = false;
