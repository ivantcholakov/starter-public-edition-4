<?php

// See https://github.com/composer/composer/issues/4340

class ComposerAutoloaderInit7ec88c9c84ecdbd075c7338e7e8fd784
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        spl_autoload_register(array('ComposerAutoloaderInit7ec88c9c84ecdbd075c7338e7e8fd784', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader();
        spl_autoload_unregister(array('ComposerAutoloaderInit7ec88c9c84ecdbd075c7338e7e8fd784', 'loadClassLoader'));

        $useStaticLoader = PHP_VERSION_ID >= 50600 && !defined('HHVM_VERSION');
        if ($useStaticLoader) {
            require_once __DIR__ . '/autoload_static.php';

            call_user_func(\Composer\Autoload\ComposerStaticInit7ec88c9c84ecdbd075c7338e7e8fd784::getInitializer($loader));
        } else {
            $map = require __DIR__ . '/autoload_namespaces.php';
            foreach ($map as $namespace => $path) {
                $loader->set($namespace, $path);
            }

            $map = require __DIR__ . '/autoload_psr4.php';
            foreach ($map as $namespace => $path) {
                $loader->setPsr4($namespace, $path);
            }

            $classMap = require __DIR__ . '/autoload_classmap.php';
            if ($classMap) {
                $loader->addClassMap($classMap);
            }
        }

        $loader->register(true);

        if ($useStaticLoader) {
            $includeFiles = Composer\Autoload\ComposerStaticInit7ec88c9c84ecdbd075c7338e7e8fd784::$files;
        } else {
            $includeFiles = require __DIR__ . '/autoload_files.php';
        }
        foreach ($includeFiles as $fileIdentifier => $file) {
            composerRequire7ec88c9c84ecdbd075c7338e7e8fd784($fileIdentifier, $file);
        }

        return $loader;
    }
}

function composerRequire7ec88c9c84ecdbd075c7338e7e8fd784($fileIdentifier, $file)
{
    // This tweak allowes installed Guzzle 6 (requires PHP 5.5)
    // not to cause source parsing error on lower PHP versions.
    if (!is_php('5.5'))
    {
        if (strpos($file, 'guzzlehttp/') !== false)
        {
            return;
        }
    }
    //

    if (empty($GLOBALS['__composer_autoload_files'][$fileIdentifier])) {
        require $file;

        $GLOBALS['__composer_autoload_files'][$fileIdentifier] = true;
    }
}
