A PHP Application Starter, Version 4, Based on CodeIgniter
==========================================================

Project Repository
------------------

https://github.com/ivantcholakov/starter-public-edition-4

Note
----

This version supports multiple applications.

Live Demo
---------

http://iridadesign.com/starter-public-edition-4/www/

CodeIgniter 3.0-dev Documentation
---------------------------------

Since CodeIgniter 3.0 has not been officially released yet, its documentation may be temporarily accessed these ways:

* From the repository source: https://github.com/EllisLab/CodeIgniter/tree/develop/user_guide_src
* From the CodeIgniter 3 Documentation Nightlies supported by Lonnie Ezell: http://ci3docs.cibonfire.com/

Requirements
------------

PHP 5.2.4+ (officially, actually the platform works on PHP 5.2.0), Apache 2.2 - 2.4 (mod_rewrite should be enabled).
For database support seek information within CodeIgniter 3.0-dev documentation.

For UTF-8 encoded sites it is highly recommendabe the following PHP extensions to be installed:

* **mbstring**;
* **iconv**;
* **pcre** compiled with UTF-8 support (the "u" modifier should work).

Installation
------------

Download source and place it on your web-server within its document root or within a sub-folder.
Make the folder platform/writable to be writable. It is to contain CodeIgniter's cache, logs and other things that you might add.
Open the site with a browser on an address like this: http://localhost/starter-public-edition-4/www/

On your web-server you may move one level up the content of the folder www, so the segment www from the address to disappear.
Also you can move the folder platform to a folder outside the document root of the web server for increased security.
After such a rearangement open the file config.php (www/config.php before rearrangement), find the setting $PLATFORMPATH and change this path accordingly.
Don't forget to check platform/writable folder, it should be writable.

Have a look at the files .htaccess and robots.txt and adjust them for your site.
Within the folder platform/applications you will by default two applications - "site_example" and "admin_example".
Have a look at their configuration files. Also, The common PHP configuration files you may find at platform/core/common/config/ folder.

The platform auto-detects its base URL address nevertheless its public part is on the document root of the web-server or not.
I don't expect you to be forced to set it up manually within platform/core/common/config/config.php.

Features
--------

* CodeIgniter 3.0-dev, http://codeigniter.com/, https://github.com/EllisLab/CodeIgniter
* On a web-server you can place your site (www folder) within a subdirectory.
* Codeigniter Cross Modular Extensions - XHMVC,
https://bitbucket.org/xperez/codeigniter-cross-modular-extensions-xhmvc,
http://www.4amics.com/x.perez/2013/06/xhmvc-common-modular-extensions/ (only the essential piece of code).
* Support for the old CI 2.x class/file name convention. When you port your older libraries, models, and controllers,
you would not be forced to rename them according to the new strict "ucfirst" naming convention.
* Native PHP session support by default.
* Modular Extensions - HMVC for CodeIgniter, https://bitbucket.org/wiredesignz/codeigniter-modular-extensions-hmvc
* Enhanced bootsrapping process, see the content of the folder platform/core/bootstrap/.
* In addition to the normal MVC execution, it is possible to run non-MVC scripts, look at the folder www/non-mvc/ for examples.
* Adapted for HMVC rooting has been implemented. Within a module you are able to place controllers in this way:
```
    modules/demo/controllers/page/Page.php     -> address: site_url/demo/page/[index/method]
    modules/demo/controllers/page/Other.php    -> address: site_url/demo/page/other/[index/method]
```
Deeper directory nesting as in CI 3 has not been implemented for now.

* SEO Friendly URLs in CodeIgniter, http://www.einsteinseyes.com/blog/techno-babble/seo-friendly-urls-in-codeigniter-2-0-hmvc/
* Hack 2. Prevent Model-Controller Name Collision, http://net.tutsplus.com/tutorials/php/6-codeigniter-hacks-for-the-masters/

Instead of:

```php
// Filename: Welcome.php
class Welcome extends Base_Controller {
    // ...
}
```

you can write:

```php
// Filename: Welcome_controller.php
class Welcome_controller extends Base_Controller {
    // ...
}
```

Thus the class name Welcome is available to be used as a model name instead of those ugly names Welcome_model, Welcome_m, etc.
The technique of this hack is available, but it is not mandatory.

* Hack 4. Running CodeIgniter from the Command Line, http://net.tutsplus.com/tutorials/php/6-codeigniter-hacks-for-the-masters/ - see the file www/cli.php.
* Form Validation Callbacks in HMVC in Codeigniter, http://www.mahbubblog.com/php/form-validation-callbacks-in-hmvc-in-codeigniter/
* Making CodeIgniter’s Profiler AJAX compatible, http://dragffy.com/blog/posts/making-codeigniters-profiler-ajax-compatible
* CodeIgniter Form Validation External Callbacks, https://gist.github.com/1503599, http://ellislab.com/forums/viewthread/205469/
* User Agent Helper Functions for CodeIgniter, https://github.com/ivantcholakov/codeigniter-user-agent-helper
* Template library for CodeIgniter by Phil Sturgeon, http://philsturgeon.co.uk/code/codeigniter-template
* CodeIgniter Asset Library by Phil Sturgeon.
* UTF-8 string support for CodeIgniter based on Kohana's implementation, https://github.com/ivantcholakov/codeigniter-utf8
* PHP fallback function http_build_url(), https://github.com/ivantcholakov/http_build_url
* Core_Model, see https://github.com/ivantcholakov/codeigniter-base-model
* Some basic javascripts + normalize.css.
* Internationalization, initially based on CodeIgniter 2.1 internationalization i18n, https://github.com/EllisLab/CodeIgniter/wiki/CodeIgniter-2.1-internationalization-i18n, but totally reworked.
* cURL library for CodeIgniter, https://github.com/philsturgeon/codeigniter-curl
* CodeIgniter-REST Client, https://github.com/philsturgeon/codeigniter-restclient
* CodeIgniter Rest Server, https://github.com/chriskacerguis/codeigniter-restserver
* A simple Event System for CodeIgniter, https://github.com/ericbarnes/CodeIgniter-Events, https://github.com/nathanmac/CodeIgniter-Events
* Support for database stored settings (Settings library).
* Textile, A Humane Web Text Generator, http://textile.thresholdstate.com/, https://github.com/textile/php-textile
* Markdown Extra - A text-to-HTML conversion tool, http://michelf.com/projects/php-markdown/
* Markdownify - A HTML-to-text conversion tool, http://milianw.de/projects/markdownify/
* Mustache, Logic-less templates, https://github.com/bobthecow/mustache.php
* Less.php compiler, https://github.com/oyejorge/less.php
* PHPMailer, http://phpmailer.worxware.com/, https://github.com/PHPMailer/PHPMailer
* A CodeIgniter compatible email-library powered by PHPMailer, https://github.com/ivantcholakov/codeigniter-phpmailer
* A PHP class for transliteration, https://github.com/ivantcholakov/transliterate
* AES (256, 192, 128) Symmetric Encryption, Compatible with OpenSSL, https://github.com/ivantcholakov/gibberish-aes-php
* HTML Purifier, http://htmlpurifier.org/
* Core_Lang, language translations: Support has been implemented for placeholders %s, %d, etc.
* Translation within views by using i18n tag, http://devzone.zend.com/1441/zend-framework-and-translation/

How to use this feature:

Enable the configuration option 'parse_i18n':
```php
$config['parse_i18n'] = TRUE;
```
Then in your views you can use the following syntax:
```php
<i18n>translate_this</i18n>
```
or with parameters
```php
<i18n replacement="John,McClane">dear</i18n>
```
where $lang['dear'] = 'Dear Mr. %s %s,';

Here is a way how to translate title, alt, placeholder and value attributes:

```php
<img src="..." i18n:title="click_me" />
```
or with parameters
```php
<img src="..." i18n:title="dear|John,McClane" />
```

You can override the global setting 'parse_i18n' within the controller by inserting the line:
```php
$this->parse_i18n = TRUE; // or FALSE
```

Parsing of <i18n> tags is done on the final output buffer only when
the MIME-type is 'text/html'.

**Note:** Enablig globally the i18n parser maybe is not the best idea. If you use HMVC, maybe it would
be better i18n-parsing to be done selectively for particular html-fragments. See below on how to use the
Parser class for this purpose.

* KCAPTCHA Version 2.0 - A Port for CodeIgniter, https://github.com/ivantcholakov/codeigniter-kcaptcha
* Parser class: Driver support has been implemented.

Instead of:

```php
$this->load->library('parser');
```

write the following:

```php
$this->load->parser();
```

Quick tests:

```php
// The default parser.
$this->load->parser();
echo $this->parser->parse_string('Hello, {name}!', array('name' => 'John'), TRUE);
```

There are some other parser-drivers implemented. Examples:

```php
// Mustache parser.
$this->load->parser('mustache');
echo $this->mustache->parse_string('Hello, {{name}}!', array('name' => 'John'), TRUE);
```

```php
// Parsing a Mustache type of view.
$email_content = $this->mustache->parse('email.mustache', array('name' => 'John'), TRUE);
echo $email_content;
```

```php
// Textile parser
$this->load->parser('textile');
echo $this->textile->parse_string('h1. Hello!', NULL, TRUE);
echo $this->textile->parse('hello.textile', NULL, TRUE);
```

```php
// Markdown parser
$this->load->parser('markdown');
echo $this->markdown->parse_string('# Hello!', NULL, TRUE);
echo $this->markdown->parse('hello.markdown', NULL, TRUE);
```

```php
// Markdownify parser
$this->load->parser('markdownify');
echo $this->markdownify->parse_string('<h1>Hello!</h1>', NULL, TRUE);
echo $this->markdownify->parse('hello.html', NULL, TRUE);
```

```php
// LESS parser
$this->load->parser('less');
echo $this->less->parse_string('@color: #4D926F; #header { color: @color; } h2 { color: @color; }', NULL, TRUE);
echo $this->less->parse(DEFAULTFCPATH.'assets/less/lib/bootstrap-3/bootstrap.less', NULL, TRUE);
```

Within the folder platform/core/common/libraries/Parser/drivers/ you may see all the additional parser drivers implemented.
Also within the folder platform/core/common/config/ you may find the corresponding configuration files for the drivers,
name by convention parser_*driver_name*.php. Better don't tweak the default configuration options, you may alter them
directly on parser call where it is needed.

The simple CodeIgniter's parser driver-name is 'parser', you may use it according to CodeIgniter's manual.

**Enanced syntax for using parsers** (which I prefer)

Using the generic parser class directly, with specifying the desired driver:

```php
$this->load->parser();

// The fourth parameter means Mustache parser that is loaded automatically.
echo $this->parser->parse_string($mustache_template, $data, true, 'mustache');

// The fourth parameter means Markdown and auto_link parsers parser to be applied in a chain.
echo $this->parser->parse_string($content, null, true, array('markdown', 'auto_link'));

// The same chaining example, this time a configuration option of the second parser has been altered.
echo $this->parser->parse_string($content, null, true, array('markdown', 'auto_link' => array('attributes' => 'target="_blank"')));
```

Using parsers indirectly on rendering views:

```php
// You don't need to load explicitly the parser library here.

// The fourth parameter means that i18n parser is to be applied.
// This is a way to handle internationalization on views selectively.
$this->load->view('main_menu_widget', $data, false, 'i18n');
```

Using a parser indirectly with Phil Sturgeon's Template library:

```php
// You don't need to load explicitly the parser library here.

$this->template
    ->set(compact('success', 'messages', 'subject', 'body'))
    ->enable_parser_body('i18n')  // Not elegant enough, sorry.
    ->build('email_test');
```

* CodeIgniter Checkbox Helper, https://gist.github.com/mikedfunk/4004986
* Configured LESS-assets compiler has been added.

Have a look at platform/core/common/config/less_compile.php file. It contains a list of files (sources, destinations)
to be used for LESS to CSS compilation. You may edit this list according to your needs. Before compilation, make sure
that destination files (if exist) are writable and their containing folders are writable too.

LESS-compilation is to be done from command-line. Open a terminal at the folder platform/www/ and write the following
command:

```bash
php cli.php less compile
```

* A way for database classes/drivers modification: Files under platform/core/framework/database/ folder may be copied
into platform/core/common/database/ (the prefered location) or platform/applications/{application_name}/database.
The copied files can be modified/customized. See https://github.com/ivantcholakov/starter-public-edition-4/issues/5
* CodeIgniter Cache Helper, https://github.com/stevenbenner/codeigniter-cache-helper
* auto_link() helper accepts attributes, https://github.com/EllisLab/CodeIgniter/wiki/auto-link
* Menu Library, https://github.com/nihaopaul/Spark-Menu, https://github.com/Barnabas/Spark-Menu (the original spark-source), https://github.com/daylightstudio/FUEL-CMS/blob/master/fuel/modules/fuel/libraries/Menu.php
* Function print_d() (enhanced debug print), https://github.com/vikerlane/print_d
* Registry library for CodeIgniter, https://github.com/ivantcholakov/codeigniter-registry
* Bootstrap, http://getbootstrap.com/
* Bootstrap Hover Dropdown Plugin, https://github.com/CWSpear/bootstrap-hover-dropdown
* jQuery Validation Plugin, http://jqueryvalidation.org/
* Extended JavaScript regular expressions XRegExp, http://xregexp.com/
* DataTables jQuery plugin (http://datatables.net) and Datatable library for server-side processing support.
* An icon subset of flags from GoSquared, https://www.gosquared.com/resources/flag-icons/
* Bootstrap Vertical Tabs, https://github.com/dbtek/bootstrap-vertical-tabs
* Jasny Bootstrap, The missing components for your favorite front-end framework, http://jasny.github.io/bootstrap/, https://github.com/jasny/bootstrap
* phpass (PasswordHash class), http://www.openwall.com/phpass/, http://cvsweb.openwall.com/cgi/cvsweb.cgi/projects/phpass/PasswordHash.php
* Gravatar library for CodeIgniter, https://github.com/rsmarshall/Codeigniter-Gravatar
* CodeIgniter Advanced Images (Smart Resize and Crop), https://github.com/jenssegers/codeigniter-advanced-images/
* Multiplayer - A tiny library to build nice HTML embed codes for videos, https://github.com/felixgirault/multiplayer, https://packagist.org/packages/fg/multiplayer
* jQuery Chosen Plugin, http://harvesthq.github.com/chosen/, https://github.com/harvesthq/chosen/
* jQuery Chosen Image Plugin (with modifications for jQuery Chosen 1.2 compatibility), https://github.com/djgrant/chosen-image
* An alternate stylesheet for Chosen that integrates with Bootstrap, https://github.com/alxlit/bootstrap-chosen

The Playground
--------------

It is hard everything about this platform to be documented in a formal way. This is why
a special site section "The Playground" has been created, aimed at demonstration of
platform's features/concepts. You may look at the examples and review their code.

A contact form has been created that with minimal adaptation you may use directly in your projects.

If you have no previous experience with CodeIgniter, get familiar with its User Guide first:
http://ellislab.com/codeigniter/user-guide/

Real Life Usage
---------------

* http://blitz-club.com/, designer: Irina Stancheva


Credits
-------

* Many thanks to Irida Design OOD, http://iridadesign.com - for sponsoring this project;
* Gwenaeël Gallon, https://github.com/dev-ggallon - for an important bug-fix about detect_url(), French translation, and various component updates.
* GitHub : quasiperfect, https://github.com/quasiperfect - for various suggestions and bug-reports.

License Information
-------------------

For original code in this project:  
Author: Ivan Tcholakov ivantcholakov@gmail.com, 2012-2014, and other contributors.  
License: The MIT License (MIT), http://opensource.org/licenses/MIT

CodeIgniter:  
Copyright (c) 2008 - 2014, EllisLab, Inc. (http://ellislab.com/)  
Copyright (c) 2014, British Columbia Institute of Technology (http://bcit.ca/)  
License: The MIT License (MIT), http://opensource.org/licenses/MIT

Third parties:  
License information is to be found directly within code and/or within additional files at corresponding folders.
