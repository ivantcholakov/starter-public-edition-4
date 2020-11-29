<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * This is an integration class for CodeIgniter.
 *
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Parser_Twig_Loader_Filesystem extends \Twig\Loader\FilesystemLoader {

    const MAIN_NAMESPACE = '__main__';

    public function __construct($paths = array()) {

        parent::__construct($paths);
    }

    /**
     * @return string|null
     */
    protected function findTemplate($name, bool $throw = true)
    {
        $name = $this->normalizeName($name);

        if (isset($this->cache[$name])) {
            return $this->cache[$name];
        }

        if (isset($this->errorCache[$name])) {

            if (!$throw) {
                return false;
            }

            throw new \Twig\Error\LoaderError($this->errorCache[$name]);
        }

        $ci = & get_instance();

        if (strpos($name, '..') === false && $ci->parser->detect($name) === 'twig' && is_file($name)) {
            // Full file name has been given.
            return $this->cache[$name] = $name;
        }

        if (isset($this->errorCache[$name])) {
            if (!$throw) {
                return null;
            }

            throw new Twig\Error\LoaderError($this->errorCache[$name]);
        }

        try {
            $this->validateName($name);

            list($namespace, $shortname) = $this->parseName($name);
        } catch (LoaderError $e) {
            if (!$throw) {
                return null;
            }

            throw $e;
        }

        if (!isset($this->paths[$namespace])) {
            $this->errorCache[$name] = sprintf('There are no registered paths for namespace "%s".', $namespace);

            if (!$throw) {
                return null;
            }

            throw new \Twig\Error\LoaderError($this->errorCache[$name]);
        }

        foreach ($this->paths[$namespace] as $path) {
            if (!$this->isAbsolutePath($path)) {
                $path = $this->rootPath.$path;
            }

            $file = $ci->parser->find_file($path.'/'.$shortname, $detected_parser, $detected_extension, $detected_filename, 'twig');

            if (is_file($file)) {

                if (false !== $realpath = realpath($file)) {
                    return $this->cache[$name] = $realpath;
                }

                return $this->cache[$name] = $file;
            }
        }

        $this->errorCache[$name] = sprintf('Unable to find template "%s" (looked into: %s).', $name, implode(', ', $this->paths[$namespace]));

        if (!$throw) {
            return null;
        }

        throw new \Twig\Error\LoaderError($this->errorCache[$name]);
    }

    protected function normalizeName(string $name): string
    {
        return preg_replace('#/{2,}#', '/', str_replace('\\', '/', $name));
    }

    protected function parseName(string $name, string $default = self::MAIN_NAMESPACE): array
    {
        if (isset($name[0]) && '@' == $name[0]) {
            if (false === $pos = strpos($name, '/')) {
                throw new LoaderError(sprintf('Malformed namespaced template name "%s" (expecting "@namespace/template_name").', $name));
            }

            $namespace = substr($name, 1, $pos - 1);
            $shortname = substr($name, $pos + 1);

            return [$namespace, $shortname];
        }

        return [$default, $name];
    }

    protected function validateName(string $name): void
    {
        if (false !== strpos($name, "\0")) {
            throw new \Twig\Error\LoaderError('A template name cannot contain NUL bytes.');
        }

        $name = ltrim($name, '/');
        $parts = explode('/', $name);
        $level = 0;
        foreach ($parts as $part) {
            if ('..' === $part) {
                --$level;
            } elseif ('.' !== $part) {
                ++$level;
            }

            if ($level < 0) {
                throw new LoaderError(sprintf('Looks like you try to load a template outside configured directories (%s).', $name));
            }
        }
    }

    protected function isAbsolutePath(string $file): bool
    {
        return strspn($file, '/\\', 0, 1)
            || (\strlen($file) > 3 && ctype_alpha($file[0])
                && ':' === $file[1]
                && strspn($file, '/\\', 2, 1)
            )
            || null !== parse_url($file, PHP_URL_SCHEME)
        ;
    }

}
