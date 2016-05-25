<?php

// See https://github.com/composer/composer/issues/4340

class ComposerAutoloaderInitdc3d756b09e56e386c98d22248d033e5
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

        spl_autoload_register(array('ComposerAutoloaderInitdc3d756b09e56e386c98d22248d033e5', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader();
        spl_autoload_unregister(array('ComposerAutoloaderInitdc3d756b09e56e386c98d22248d033e5', 'loadClassLoader'));

        $useStaticLoader = PHP_VERSION_ID >= 50600 && !defined('HHVM_VERSION');
        if ($useStaticLoader) {
            require_once __DIR__ . '/autoload_static.php';

            call_user_func(\Composer\Autoload\ComposerStaticInitdc3d756b09e56e386c98d22248d033e5::getInitializer($loader));
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
            $includeFiles = Composer\Autoload\ComposerStaticInitdc3d756b09e56e386c98d22248d033e5::$files;
        } else {
            $includeFiles = require __DIR__ . '/autoload_files.php';
        }
        foreach ($includeFiles as $fileIdentifier => $file) {
            composerRequiredc3d756b09e56e386c98d22248d033e5($fileIdentifier, $file);
        }

        return $loader;
    }
}

function composerRequiredc3d756b09e56e386c98d22248d033e5($fileIdentifier, $file)
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
