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

CodeIgniter 3 Documentation
-----------------------------

https://www.codeigniter.com/userguide3/

Requirements
------------

PHP 5.3.7 or higher, Apache 2.2 - 2.4 (mod_rewrite should be enabled).
For database support seek information within CodeIgniter 3 documentation.

For UTF-8 encoded sites it is highly recommendable the following PHP extensions to be installed:

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
After such a rearrangement open the file config.php (www/config.php before rearrangement), find the setting $PLATFORMPATH and change this path accordingly.

The following directories (the locations are the original) must have writable access:

```
platform/upload/
platform/writable/
www/cache/
www/editor/
www/upload/
```

Have a look at the files .htaccess and robots.txt and adjust them for your site.
Within the folder platform/applications you will by default two applications - "front" and "admin".
Have a look at their configuration files. Also, the common PHP configuration files you may find at platform/common/config/ folder.

The platform auto-detects its base URL address nevertheless its public part is on the document root of the web-server or not.
I don't expect you to be forced to set it up manually within platform/common/config/config.php.

Installation on a developer's machine
-------------------------------------

In addition to the section above, it is desirable on a developer's machine
additional components to be installed globally, they are mostly to support
compilation of web resources (for example: less -> css, ts -> js). The system
accesses them using PHP command-shell functions.

When installing the additional components globally, the command-line console would
require administrative privileges.

* Install Node.js and npm, for example see https://docs.npmjs.com/getting-started/installing-node
As a result, from the command line these commands should work:

```sh
node -v
npm -v
```

* Install less.js compiler (http://lesscss.org/) globally:

```sh
npm install less -g
```

Then the following command should work:

```sh
lessc -v
```

* Install PostCSS and its CLI utility (https://github.com/postcss/postcss-cli) globally:

```sh
npm -g install postcss-cli
```

And this command should work:

```sh
postcss -v
```

* Install Autoprefixer (https://github.com/postcss/autoprefixer) globally:

```sh
npm -g install autoprefixer
```

* Install cssnano (https://github.com/ben-eb/cssnano):

```sh
npm -g install cssnano
```

* Install TypeScript compiler (if it is needed):

```sh
npm -g install typescript-compiler
```

This command should work:

```sh
tsc -v
```

Coding Rules
------------

For originally written code:

* A tab is turned into four spaces.

For CodeIgniter system files, third-party libraries, components, etc.:

* Use the code rules adopted by the corresponding authors.

Features
--------

* CodeIgniter 3, https://codeigniter.com/, https://github.com/bcit-ci/CodeIgniter
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
* CodeIgniter Form Validation External Callbacks, https://gist.github.com/1503599, https://ellislab.com/forums/viewthread/205469/
* User Agent Helper Functions for CodeIgniter, https://github.com/ivantcholakov/codeigniter-user-agent-helper
* Template library for CodeIgniter by Phil Sturgeon, http://philsturgeon.co.uk/code/codeigniter-template
* CodeIgniter Asset Library by Phil Sturgeon.
* UTF-8 string support for CodeIgniter based on Kohana's implementation, https://github.com/ivantcholakov/codeigniter-utf8
* PHP fallback function http_build_url(), https://github.com/ivantcholakov/http_build_url
* Core_Model, see https://github.com/ivantcholakov/codeigniter-base-model
* normalize.css, a collection of HTML element and attribute style-normalizations, https://github.com/necolas/normalize.css
* Modernizr, a JavaScript library that detects HTML5 and CSS3 features in the user’s browser, http://modernizr.com
* html5shiv.js and html5shiv-printshiv.js (separate, packed within Modernizr too) - The HTML5 Shiv enables use of HTML5 sectioning elements in legacy Internet Explorer and provides basic HTML5 styling for Internet Explorer 6-9, Safari 4.x (and iPhone 3.x), and Firefox 3.x., https://github.com/aFarkas/html5shiv
* Internationalization, initially based on CodeIgniter 2.1 internationalization i18n, https://github.com/bcit-ci/CodeIgniter/wiki/CodeIgniter-2.1-internationalization-i18n, but totally reworked.
* cURL library for CodeIgniter, https://github.com/philsturgeon/codeigniter-curl
* CodeIgniter-REST Client, https://github.com/philsturgeon/codeigniter-restclient
* CodeIgniter Rest Server, https://github.com/chriskacerguis/codeigniter-restserver
* A simple Event System for CodeIgniter, https://github.com/ericbarnes/CodeIgniter-Events, https://github.com/nathanmac/CodeIgniter-Events
* Support for database stored settings (Settings library).
* Textile, A Humane Web Text Generator, https://txstyle.org, https://github.com/textile/php-textile
* Markdownify - The HTML to Markdown converter for PHP, https://github.com/Elephant418/Markdownify
* Parsedown - Better Markdown Parser in PHP - https://github.com/erusev/parsedown
* Parsedown Extra - An extension of Parsedown that adds support for Markdown Extra - https://github.com/erusev/parsedown-extra
* Mustache, Logic-less templates, https://github.com/bobthecow/mustache.php, https://github.com/janl/mustache.js
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

Parsing of ```<i18n>``` tags is done on the final output buffer only when
the MIME-type is 'text/html'.

**Note:** Enabling globally the i18n parser maybe is not the best idea. If you use HMVC, maybe it would
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

Within the folder platform/common/libraries/Parser/drivers/ you may see all the additional parser drivers implemented.
Also within the folder platform/common/config/ you may find the corresponding configuration files for the drivers,
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

Have a look at platform/common/config/less_compile.php file. It contains a list of files (sources, destinations)
to be used for LESS to CSS compilation. You may edit this list according to your needs. Before compilation, make sure
that destination files (if exist) are writable and their containing folders are writable too.

LESS-compilation is to be done from command-line. Open a terminal at the folder platform/www/ and write the following
command:

```bash
php cli.php less compile
```

Or, you may choose which LESS-sources to compile by pointing at their names:

```bash
php cli.php less compile bootstrap-3 bootstrap-3-min
```

* A way for database classes/drivers modification: Files under platform/core/framework/database/ folder may be copied
into platform/common/database/ (the prefered location) or platform/applications/{application_name}/database.
The copied files can be modified/customized. See https://github.com/ivantcholakov/starter-public-edition-4/issues/5
* CodeIgniter Cache Helper, https://github.com/stevenbenner/codeigniter-cache-helper
* auto_link() helper accepts attributes, https://github.com/bcit-ci/CodeIgniter/wiki/auto-link
* Menu Library, https://github.com/nihaopaul/Spark-Menu, https://github.com/Barnabas/Spark-Menu (the original spark-source), https://github.com/daylightstudio/FUEL-CMS/blob/master/fuel/modules/fuel/libraries/Menu.php
* Function print_d() (enhanced debug print), ~~https://github.com/vikerlane/print_d~~ https://github.com/CesiumComputer/print_d
* Registry library for CodeIgniter, https://github.com/ivantcholakov/codeigniter-registry
* jQuery Validation Plugin, http://jqueryvalidation.org/
* Extended JavaScript regular expressions XRegExp, http://xregexp.com/
* DataTables jQuery plugin (http://datatables.net) and Datatable library for server-side processing support.
* An icon subset of flags from GoSquared, https://www.gosquared.com/resources/flag-icons/
* phpass (PasswordHash class), http://www.openwall.com/phpass/, http://cvsweb.openwall.com/cgi/cvsweb.cgi/projects/phpass/PasswordHash.php
* Gravatar Library for CodeIgniter, https://github.com/ivantcholakov/Codeigniter-Gravatar
* CodeIgniter Advanced Images (Smart Resize and Crop), https://github.com/jenssegers/codeigniter-advanced-images/
* Multiplayer - A tiny library to build nice HTML embed codes for videos, https://github.com/felixgirault/multiplayer, https://packagist.org/packages/fg/multiplayer
* Smiley Icons, http://thuthuatvietnam.com/sites/default/files/uploads/files/2013/08/huong-dan-su-dung-smiley-helper-tren-codeigniter.zip, http://thuthuatvietnam.com/huong-dan-su-dung-smileys-helper-tren-codeigniter.html
* Smiley Icons from Django-emoticons, https://github.com/Fantomas42/django-emoticons
* Secure Random Bytes in PHP, https://github.com/GeorgeArgyros/Secure-random-bytes-in-PHP
* php-passgen - A library for generating cryptographically secure passwords in PHP, https://github.com/defuse/php-passgen
* A PHP port of the YUI CSS compressor, https://github.com/tubalmartin/YUI-CSS-compressor-PHP-port
* JSMinPlus - a JavaScript minifier, https://github.com/mrclay/minify/blob/2.2.0/min/lib/JSMinPlus.php
* less.js script for client-side usage (for learning and development purposes, for production compile less assets before deploying), https://github.com/less/less.js
* Ellipsis (jQuery version) - A plugin to truncate strings that are too long, https://github.com/danbeam/ellipsis/
* Facebook PHP SDK v5 for CodeIgniter - Library for integration of Facebook PHP SDK v5 with CodeIgniter 3, https://github.com/darkwhispering/facebook-sdk-codeigniter
* Roave Security Advisories - This package ensures that your application doesn't have installed dependencies with known security vulnerabilities, https://github.com/Roave/SecurityAdvisories
* Requests for PHP - A HTTP library written in PHP, for human beings, https://github.com/rmccue/Requests, http://requests.ryanmccue.info
* Pjax jQuery plugin - pushState + ajax = pjax, https://github.com/defunkt/jquery-pjax, http://pjax.herokuapp.com
* scssphp, a compiler for SCSS written in PHP, https://github.com/leafo/scssphp, http://leafo.github.io/scssphp/
* TSCompiler (the PHP implementation), https://github.com/ComFreek/TSCompiler
* Colorbox, a light-weight, customizable lightbox plugin for jQuery, https://github.com/jackmoore/colorbox
* php-json-minify, a JSON minifier and uncommenter written in PHP, https://github.com/T1st3/php-json-minify
* Animate.css, a bunch of cool, fun, and cross-browser animations for you to use in your projects, https://github.com/daneden/animate.css, http://daneden.github.io/animate.css/
* Web Font Loader, gives you added control when using linked fonts via @font-face, https://github.com/typekit/webfontloader
* Material Design icons by Google https://github.com/google/material-design-icons, http://google.github.io/material-design-icons/
* Material Design icons with Bootstrap-like styling, https://github.com/mervick/material-design-icons
* Lex, a lightweight template parser used by PyroCMS, https://github.com/pyrocms/lex
* Twig, the flexible, fast, and secure template engine for PHP, http://twig.sensiolabs.org
* PHP 5.x support for random_bytes() and random_int(), https://github.com/paragonie/random_compat
* WhichBrowser/Parser, a useragent parser library for PHP, https://github.com/WhichBrowser/Parser
* iHover, a collection of hover effects using pure CSS, https://github.com/gudh/ihover
* imagesLoaded - "You images done yet or what?", https://github.com/desandro/imagesloaded
* Masonry - a cascading grid layout library, https://github.com/desandro/masonry
* Semantic UI - a component framework based around useful principles from natural language, http://www.semantic-ui.com
* A collection of HTTP related packages (HTTPlug), https://github.com/php-http , http://httplug.io
* jQuery keepalive Plugin, sends ajax requests to the server at configurable intervals to keep a PHP session from expiring, https://github.com/waynewalls/jquery.keepalive
* CSS & JavaScript minifier, in PHP, https://github.com/matthiasmullie/minify , http://www.minifier.org
* SweetAlert, a beautiful replacement for JavaScript's "alert", https://github.com/t4t5/sweetalert , http://t4t5.github.io/sweetalert/
* Handlebars.js - an extension to the Mustache templating language, https://github.com/wycats/handlebars.js , http://handlebarsjs.com
* Handlebars.php - Handlebars processor for PHP, https://github.com/XaminProject/handlebars.php
* Slick, the last carousel you'll ever need, https://github.com/kenwheeler/slick , http://kenwheeler.github.io/slick/
* Intervention Image - a PHP image handling and manipulation library, https://github.com/Intervention/image
* Letter Avatar for PHP - generate user avatar using name initials letter, https://github.com/yohang88/letter-avatar

The Playground
--------------

It is hard everything about this platform to be documented in a formal way. This is why
a special site section "The Playground" has been created, aimed at demonstration of
platform's features/concepts. You may look at the examples and review their code.

A contact form has been created that with minimal adaptation you may use directly in your projects.

If you have no previous experience with CodeIgniter, get familiar with its User Guide first:
https://www.codeigniter.com/user_guide/

Real Life Usage
---------------

* http://blitz-club.com/ (casino clubs), designer: Irina Stancheva
* http://glassbricks.org/ (family counseling), designer: Irina Stancheva
* http://unicontrol.eu/ (remote monitoring and control of machines and equipment, SCADA), designer: Irina Stancheva
* http://techmi-mg.com (services and products based on marble and granite), designer: Irina Stancheva
* http://euroauto.bg (car dealership, leasing of cars), designer: Irina Stancheva
* http://hotel-salvia.com (a family hotel), designer: Irina Stancheva
* http://yasla-valshebstvo.com (nursery), designer: Irina Stancheva
* http://evita-clinic.com (medical and dental services, one page site so far), designer: Irina Stancheva
* http://index-bg.org (social activities, drug prevention), designer: Irina Stancheva
* http://vsichkiremonti.bg (repair services), the design is based on AdminLTE project.
* http://mominidvori.com (a hotel in Bansko, Bulgaria), designer: Irina Stancheva
* http://hotel-classic.eu (a hotel in Sofia, Bulgaria), designer: Irina Stancheva
* http://nelasms.com (a seller of spare parts for trucks), designer: Irina Stancheva
* http://afilipov.eu (a personal site, Andrey Filipov), designer: Irina Stancheva
* http://petyakonstantinova.com (a personal site, Petya Konstantinova), designer: Irina Stancheva
* http://liveconsult.eu (training about business or personal relations), designer: Irina Stancheva
* http://hop-mebeli.com/ - an online shop, furniture, migrated from starter-public-edition-3, designer: Irina Stancheva
* http://iridadesign.com (we), designer: Irina Stancheva
* http://profitherm.bg - water pumps supplier, designer: Irina Stancheva (Semantic UI based design)
* http://art-tochka.com/ - an online shop, gifts, migrated from starter-public-edition-3, designer: Irina Stancheva (still Bootstrap-based design)
* http://viapontica123.bg - a small hotel, designer: Irina Stancheva
* http://ivetfashion.com - a model management company, designer: Irina Stancheva

Reported by Webnice Ltd., http://webnicebg.com

* http://katonovi.com (an online store)
* http://lvhalsokost.se
* http://astoconsult.com (industrial property)
* http://bba-bulgaria.com (a medical NGO)
* http://evroforest.com (a parquet seller)
* http://sip2000.bg (consultancy and training about public procurement)
* http://lz1866.com (a locomotive services provider)
* http://www.prista-oil.com/ - production and distribution of motor and industrial oils, greases and special fluids; battery business
* http://mycity.bg/ - a virtual tourist guide
* http://vonleart.com - wedding photography
* http://spa-rusalka.com - a SPA-hotel
* http://polypoolsbg.com - a FiberGlass pools provider
* http://ruseplasticsurgery.com - plastic surgery
* http://tciships.com/ - logistics
* http://matracimore.com - a provider of mattresses
* http://freshway-bg.com - an air fresheners provider
* http://rosifashion.com - a womenswear provider
* http://shop.rosifashion.com - a womenswear shop
* http://mkferavita.com - herbal products

Reported by Krishna Guragai, @krishnaguragain

* https://redmudcoffee.com (a coffee seller)
* https://hamroschoolapp.com (a home page of a mobile application)

Credits
-------

* Many thanks to Irida Design OOD, http://iridadesign.com - for sponsoring this project;
* Gwenaël Gallon, https://github.com/dev-ggallon - for an important bug-fix about detect_url(), French translation, and various component updates;
* quasiperfect (GitHub name), https://github.com/quasiperfect - for various suggestions and bug-reports;
* Exelord (GitHub name), https://github.com/Exelord - for Polish translation;
* Krishna Guragai, https://github.com/krishnaguragain - for drafting the Facebook PHP SDK integration.
* Denislav Adilev, http://forum.codeigniter.com/user-9053.html - for his overall influence and recommendations,
for testing and various bug-reports about the Template library, Twig and Lex parsers integration, language support, image processing and modular extensions.

License Information
-------------------

For original code in this project:  
Copyright (c) 2012 - 2017:  
Ivan Tcholakov (the initial author) ivantcholakov@gmail.com,  
Gwenaël Gallon.  
License: The MIT License (MIT), http://opensource.org/licenses/MIT

CodeIgniter:  
Copyright (c) 2008 - 2014, EllisLab, Inc. (https://ellislab.com/)  
Copyright (c) 2014 - 2016, British Columbia Institute of Technology (http://bcit.ca/)  
License: The MIT License (MIT), http://opensource.org/licenses/MIT

Third parties:  
License information is to be found directly within code and/or within additional files at corresponding folders.

Donations
---------

Ivan Tcholakov, November 11-th, 2015: No donations are accepted here. If you wish to help, you need the time and the skills of being a direct contributor,
by providing code/documentation and reporting issues. Period.
