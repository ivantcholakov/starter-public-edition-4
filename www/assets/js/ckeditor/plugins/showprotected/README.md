CKEditor showprotected Plugin
==========================

A plugin for CKEditor that makes protected source sections visible and editable.
It'll show an icon in their place in the editor, which when double-clicked
will bring up a dialog allowing them to be edited.

###Demo
http://igx89.github.io/CKEditor-ShowProtected-Plugin/

![Screenshot](http://igx89.github.io/CKEditor-ShowProtected-Plugin/screenshots/screenshot_1.png)

![Screenshot](http://igx89.github.io/CKEditor-ShowProtected-Plugin/screenshots/screenshot_2.png)

![Screenshot](http://igx89.github.io/CKEditor-ShowProtected-Plugin/screenshots/screenshot_3.png)

####License

Licensed under the terms of the MIT, GPL LGPL and MPL licenses.

####Installation

 1. Extract the contents of the file into the "plugins" folder of CKEditor.
 2. In the CKEditor configuration file (config.js) add the following code:

````
config.extraPlugins = 'showprotected';

// Add regular expressions marking the sections you want protected
// (see http://docs.ckeditor.com/#!/api/CKEDITOR.config-cfg-protectedSource)
// Examples:
config.protectedSource.push( /<\?[\s\S]*?\?>/g ); // PHP
config.protectedSource.push( /\[@[\s\S]*?\/]/g ); // Freemarker
config.protectedSource.push( /\[#[\s\S]*?]/g ); // Freemarker
config.protectedSource.push( /\[\/#[\s\S]*?]/g ); // Freemarker
config.protectedSource.push( /\${[\s\S]*?}/g ); // Freemarker
````
