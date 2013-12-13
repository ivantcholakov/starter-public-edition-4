A PHP Application Starter, Version 4, Based on CodeIgniter
==========================================================


Note
----

This version supports multiple applications.


Requirements
------------

PHP 5.2.4+ (officially, actually the platform works on PHP 5.2.0), Apache 2.2 - 2.4.
For database support seek information within CodeIgniter 3.0-dev documentation.

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
* Codeigniter Cross Modular Extensions - XHMVC,
https://bitbucket.org/xperez/codeigniter-cross-modular-extensions-xhmvc,
http://www.4amics.com/x.perez/2013/06/xhmvc-common-modular-extensions/ (only the essential piece of code).
* Support for the old CI 2.x class/file name convention. When you port your older libraries, models, and controllers,
you would not be forced to rename them according to the new strict "ucfirst" naming convention.
* Native PHP session support by default.
* Modular Extensions - HMVC for CodeIgniter, https://bitbucket.org/wiredesignz/codeigniter-modular-extensions-hmvc
* Enhanced bootsrapping process, see the content of the folder platform/core/bootstrap/.
In addition to the normal MVC execution, it is possible to run non-MVC scripts, for example:

```php
<?php

// Platform's core initialization.
require dirname(__FILE__).'/../config.php'; // This is www/config.php file.
require $PLATFORMCREATE;

ci()->load->helper('template');

echo html_tag();

?>

<head>
    <meta charset="utf-8" />
<?php

// Accessing some configuration options.
$title = config_item('default_title');
$description = config_item('default_description');
$keywords = config_item('default_keywords');

// Accessing the dummy controller.
$ci = get_instance();

// Accessing the dummy controller properties.
$ci->template->title($title);
$ci->template->set_metadata('description', $description);
$ci->template->set_metadata('keywords', $keywords);

// Using some helper functions.
template_title();
echo viewport();
template_metadata();

echo favicon();
echo apple_touch_icon_precomposed();
echo cleartype_ie();

// A CSS loading example.
echo css('lib/bootstrap-2/bootstrap.css');

// Loading javascripts example.
echo js_platform();
echo js_selectivizr();
echo js_modernizr();
echo js_respond();

echo js_jquery();

?>

</head>
<?php

echo body_tag();

?>

    <div class="container">

        <div class="content" style="margin-top: 40px;">

            <div class="clearfix" style="margin-bottom: 20px;">

                <?php echo image('tests/logo/logo-114x114.png'); /* Inserting an image using a helper function. */ ?>

                <br />
                A logo should be seen here.

            </div>

            <h2 style="margin-bottom: 20px;">Dealing with Legacy Pages Example</h2>

            <p>
                This is a sample of an "old legacy page" that is not rewritten in (H)MVC style yet. Sometimes this costs a lot of time.
                In this case access to the configuration, helper functions, etc. might be useful. This is why the core of the framework
                initializes at the beginning of the page (using a dummy controller) and destroys itself at the end of the page. Between
                these two actions you can read framework's configurations options, using asset helper functions, access database and so forth.
                Please, have a look at PHP source code of this page.
            </p>

            <p>
                If it is necessary, use the helper function <strong>get_instance()</strong> to access the dummy controller and its properties and methods.
            </p>

            <p style="margin-top: 25px;">
                <a href="<?php echo site_url('tests/pages'); ?>">Back to the tests</a>
            </p>

        </div>

    </div>

<?php

echo js_jquery_extra_selectors();
echo js_bp_plugins();
echo js_mbp_helper();
echo js_scale_fix_ios();
echo js_imgsizer();

echo div_debug();

// Platform's core destruction.
require $PLATFORMDESTROY;

?>

</body>
</html>

```

In this "vanilla-style" script all the libraries, helpers, models, configuration options are accessible.
This feature is very convenient when you migrate a non-MVC site to CodeIgniter.

Also, have a look at the normal front-controller index.php:

```php
<?php

/*
 * --------------------------------------------------------------------
 * The Front-Controller.
 * --------------------------------------------------------------------
 */

require dirname(__FILE__).'/config.php';
require $PLATFORMRUN;

```

It is just an entry point, without configuration data.

* Enhanced rooting has been implemented. Within a module you are able to place controllers in this way:

    modules/demo/controllers/page/Page.php     -> address: site_url/demo/page/[index/method]  
    modules/demo/controllers/page/Other.php    -> address: site_url/demo/page/other/[index/method]

* SEO Friendly URLS in CodeIgniter, http://www.einsteinseyes.com/blog/techno-babble/seo-friendly-urls-in-codeigniter-2-0-hmvc/
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
* CodeIgniter 2.1 internationalization i18n, https://github.com/EllisLab/CodeIgniter/wiki/CodeIgniter-2.1-internationalization-i18n
* cURL library for CodeIgniter, https://github.com/philsturgeon/codeigniter-curl
* A simple Event System for CodeIgniter, https://github.com/ericbarnes/CodeIgniter-Events
* Support for database stored settings (Settings library).
* Textile, A Humane Web Text Generator, http://textile.thresholdstate.com/
* Markdown Extra - A text-to-HTML conversion tool, http://michelf.com/projects/php-markdown/
* Markdownify - A HTML-to-text conversion tool, http://milianw.de/projects/markdownify/
* PHPMailer, http://phpmailer.worxware.com/, https://github.com/Synchro/PHPMailer
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
or
```php
<i18n replacement="John,McClane">dear</i18n>
```
where $lang['dear'] = 'Dear Mr. %s %s,';

You can override the global setting 'parse_i18n' within the controller by inserting the line:
```php
$this->parse_i18n = TRUE; // or FALSE
```

Parsing of <i18n> tags is done on the final output buffer only when
the MIME-type is 'text/html'.

* KCAPTCHA Version 2.0 - A Port for CodeIgniter, https://github.com/ivantcholakov/codeigniter-kcaptcha
* Mustache, Logic-less templates, https://github.com/bobthecow/mustache.php
* Parser class: Driver support has been implemented. A Mustache driver has been added.

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

echo '<br />';

// Mustache parser.
$this->load->parser('mustache');
echo $this->mustache->parse_string('Hello, {{name}}!', array('name' => 'John'), TRUE);

echo '<br />';

// Parsing a Mustache type of view.
$email_content = $this->mustache->parse('email.mustache', array('name' => 'John'), TRUE);
echo $email_content;

echo '<br />';
```

* Method chaining on Loader class has been implemented, see https://github.com/EllisLab/CodeIgniter/issues/2165

Instead of:

```php
$this->load->library('settings');
$this->load->helper('url');
$this->load->library('template');
```

you can write:

```php
$this->load
    ->library('settings')
    ->helper('url')
    ->library('template')
;
```

* Parser class: A Textile driver has been added.

```php
$this->load->parser('textile');
echo $this->textile->parse_string('h1. Hello!', NULL, TRUE);
echo $this->textile->parse('hello.textile', NULL, TRUE);
```

License Information
-------------------

For my original code:  
Author: Ivan Tcholakov ivantcholakov@gmail.com, 2012-2013.  
License: The MIT License (MIT), http://opensource.org/licenses/MIT

CodeIgniter:  
Copyright (c) 2008 - 2013, EllisLab, Inc. (http://ellislab.com/)  
License: Open Software License (OSL 3.0), http://opensource.org/licenses/OSL-3.0

CodeIgniter configuration file:  
Copyright (c) 2008 - 2013, EllisLab, Inc. (http://ellislab.com/)  
License: Academic Free License (AFL 3.0), http://opensource.org/licenses/AFL-3.0

Third parties:  
License information is to be found directly within code and/or within additional files at corresponding folders.
