php-json-minify
==============

[![Packagist version](https://img.shields.io/packagist/v/t1st3/php-json-minify.svg)](https://packagist.org/packages/t1st3/php-json-minify)
[![Build Status](https://img.shields.io/travis/T1st3/php-json-minify.svg)](https://travis-ci.org/T1st3/php-json-minify)


About
--------------

URL: [https://github.com/T1st3/php-json-minify](https://github.com/T1st3/php-json-minify)

Author: [T1st3](https://github.com/T1st3)


This JSON minifier written in PHP is based on the [JSON.minify](https://github.com/getify/JSON.minify) script by [Kyle Simspon](https://github.com/getify).

This minifier also removes comments from JSON. While the authors of php-json-minify and JSON.minify do not encourage the use of comments in JSON, they are glad to provide you a way to remove those comments anyway! 
See original author's [blog post](http://blog.getify.com/json-comments/) if you want to know more.




Build dependencies
--------------

In order to build your generated Composer project from its source, you will need Grunt and PHP on the command line.

So, you must install PHP5 on your system on your command line. Test it:

```
php --help
```


To install Grunt globally on the command line (and run the above build task), run:

```
npm install -g grunt-cli
```


Then, with Grunt, you can install Composer, PhpDocumentor, PhpUnit and PhpCPD locally. Just run once:

```
grunt init
```

Then, you can install PhpDocumentor, PhpUnit and PhpCPD locally. Just run once:

```
php composer.phar install -v
```

Finally, you should also install the PHP extension named Xdebug, which will be used by PhpUnit for code coverage.

[![Dependency Status](https://www.versioneye.com/user/projects/52f145d9ec1375e9b00001ee/badge.png)](https://www.versioneye.com/php/t1st3:php-json-minify)



Build the sources
--------------

Once all your dependencies are installed, you can build your project with Grunt:

```
grunt build
```

The build process will run the following tasks:

* PhpLint: runs php -l over the "src" folder
* Runs the tests located in the "tests" folder with [PHPUnit](http://phpunit.de/)
* Generates a [PhpDocumentor](http://phpdoc.org) documentation in the "doc" folder from the files of the "src" folder
* Detects copy/paste of code in the files of the "src" folder with [PhpCPD](https://github.com/sebastianbergmann/phpcpd)

[![Built with Grunt](https://cdn.gruntjs.com/builtwith.png)](http://gruntjs.com/)


Usage
--------------

```
<?php
require_once(dirname(__FILE__) . '/src/t1st3/JSONMin/JSONMin.php');
use t1st3\JSONMin\JSONMin as jsonMin;

// Use static method
$a = jsonMin::minify('{"a": "b"}');
echo $a;

// get the minified JSON in a string
$b = new jsonMin('{"c": "d"}');
echo $b->getMin();

// prints the minifed JSON
$c = new jsonMin('{"e": "f"}');
$b->printMin();
?>
```



Credits
--------------

php-json-minify was initiated with [generator-composer](https://github.com/T1st3/generator-composer), a [Yeoman](http://yeoman.io) generator that builds a PHP Composer project.

This project is based on [JSON.minify](https://github.com/getify/JSON.minify) by [Kyle Simspon](https://github.com/getify), which is released under the MIT license.

This project uses the following as development dependencies:

* [PHPUnit](http://phpunit.de/)
* [PhpDocumentor](http://phpdoc.org)
* [Php Copy/Paste Detector](https://github.com/sebastianbergmann/phpcpd)


License
--------------

[License](https://github.com/T1st3/php-json-minify/blob/master/LICENSE)
