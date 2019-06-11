killbill-client-php
===================

[![build status](https://secure.travis-ci.org/killbill/killbill-client-php.png)](https://travis-ci.org/killbill/killbill-client-php)

PHP client library for [Killbill](http://killbill.io)

Configuration
-------------

In order to use the library, you need to:

1. Require the library via [composer](https://getcomposer.org): `composer require killbill\killbill-client`
2. Point the library to your Killbill instance via the `Client::$serverUrl` variable (http://127.0.0.1:8080 by default)

Example
-------

The following snippet will create an account:

```php
<?php

use \Killbill\Client\Client;
use \Killbill\Client\Tenant;
use \Killbill\Client\Account;

// Killbill server
Client::$serverUrl = 'http://localhost:8080';

// Set these values for your particular tenant
$tenant = new Tenant();
$tenant->setApiKey('bob');
$tenant->setApiSecret('lazar');

// Unique id for this account
$externalAccountId = uniqid();

// Prepare the account data
$accountData = new Account();
$accountData->setName('Killbill php test');
$accountData->setExternalKey($externalAccountId);
$accountData->setEmail('test-' . $externalAccountId . '@kill-bill.org');
$accountData->setCurrency('USD');
$accountData->setPaymentMethodId(null);
$accountData->setAddress1('12 rue des ecoles');
$accountData->setAddress2('Poitier');
$accountData->setCompany('Renault');
$accountData->setState('Poitou');
$accountData->setCountry('France');
$accountData->setPhone('81 53 26 56');
$accountData->setFirstNameLength(4);
$accountData->setBillCycleDay(12);
$accountData->setTimeZone('UTC');

// Create it
$createdAccount = $accountData->create('pierre', 'PHP_TEST', 'Test for '' . $externalAccountId, $tenant->getTenantHeaders());
```

Using the client in a non-composer environment
----------------------------------------------

If you want to use the client but are not using [Composer](https://getcomposer.org) (yet), follow these steps:

- Install composer locally: [Instruction](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx)
- Run `composer require killbill/killbill-client`. This will download the library into the `vendor/` folder and create a `composer.json` and a `composer.lock` file that define this dependency.
- Include the auto-generated `autoload.php` file from the `vendor/` folder.
- You can now use the client like above described.
- If you don't want to have an additional build step, just check the `vendor/` folder into your repository.

Testing
-------

The Killbill PHP client uses [phpunit](https://phpunit.de/) as testing framework. Tests can either be run locally using `composer test` or against
a live Killbill instance that is running on `127.0.0.1:8080` using `composer test-integration`.

Requirements
------------

The PHP library requires PHP 5.5 or greater with _libcurl_ compiled (e.g. you need the php-curl package on Ubuntu).


Support
-------

Feel free to ask questions on the [killbilling-users](https://groups.google.com/forum/?fromgroups#!forum/killbilling-users) Google Group.
