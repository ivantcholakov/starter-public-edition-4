<?php

/*
 * This file is part of Mustache.php.
 *
 * (c) 2010-2026 Justin Hileman
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mustache\Loader;

use Mustache\Exception\RuntimeException;
use Mustache\Exception\UnknownTemplateException;
use Mustache\Loader;

/**
 * Mustache Template filesystem Loader implementation.
 *
 * A FilesystemLoader instance loads Mustache Template source from the filesystem by name:
 *
 *     $loader = new FilesystemLoader(__DIR__.'/views');
 *     $tpl = $loader->load('foo'); // equivalent to `file_get_contents(__DIR__.'/views/foo.mustache');
 *
 * This is probably the most useful Mustache Loader implementation. It can be used for partials and normal Templates:
 *
 *     $m = new \Mustache\Engine([
 *          'loader'          => new FilesystemLoader(__DIR__.'/views'),
 *          'partials_loader' => new FilesystemLoader(__DIR__.'/views/partials'),
 *     ]);
 */
class FilesystemLoader implements Loader
{
    private $baseDir;
    private $baseDirPrefix;
    private $checkPath;
    private $extension = '.mustache';
    private $allowUnsafeTemplateNames = false;
    private $templates = [];

    /**
     * Mustache filesystem Loader constructor.
     *
     * Passing an $options array allows overriding certain Loader options during instantiation:
     *
     *     $options = [
     *         // The filename extension used for Mustache templates. Defaults to '.mustache'
     *         'extension' => '.ms',
     *
     *         // Disable path containment checks for backwards compatibility.
     *         // This is not recommended.
     *         'allow_unsafe_template_names' => true,
     *     ];
     *
     * @throws RuntimeException if $baseDir does not exist
     *
     * @param string $baseDir Base directory containing Mustache template files
     * @param array  $options Loader options (default: [])
     */
    public function __construct($baseDir, array $options = [])
    {
        $this->baseDir = $baseDir;
        $this->checkPath = $this->shouldCheckPath();

        if ($this->checkPath) {
            $resolved = $this->resolveLocalPath($this->baseDir);

            if ($resolved === false || !is_dir($resolved)) {
                throw new RuntimeException(sprintf('FilesystemLoader baseDir must be a directory: %s', $baseDir));
            }

            if (strpos($this->baseDir, '://') === false) {
                $this->baseDir = $resolved;
            }

            $this->baseDirPrefix = rtrim($resolved, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
        }

        if (array_key_exists('extension', $options)) {
            if (empty($options['extension'])) {
                $this->extension = '';
            } else {
                $this->extension = '.' . ltrim($options['extension'], '.');
            }
        }

        if (isset($options['allow_unsafe_template_names'])) {
            $this->allowUnsafeTemplateNames = (bool) $options['allow_unsafe_template_names'];
        }
    }

    /**
     * Load a Template by name.
     *
     *     $loader = new FilesystemLoader(__DIR__.'/views');
     *     $loader->load('admin/dashboard'); // loads "./views/admin/dashboard.mustache";
     *
     * @param string $name
     *
     * @return string Mustache Template source
     */
    public function load($name)
    {
        if (!isset($this->templates[$name])) {
            $this->templates[$name] = $this->loadFile($name);
        }

        return $this->templates[$name];
    }

    /**
     * Helper function for loading a Mustache file by name.
     *
     * @throws UnknownTemplateException If a template file is not found
     *
     * @param string $name
     *
     * @return string Mustache Template source
     */
    protected function loadFile($name)
    {
        $fileName = $this->getFileName($name);

        if ($this->checkPath && !file_exists($fileName)) {
            throw new UnknownTemplateException($name);
        }

        return file_get_contents($fileName);
    }

    /**
     * Helper function for getting a Mustache template file name.
     *
     * @throws UnknownTemplateException If a template name is invalid or resolves outside the base directory
     *
     * @param string $name
     *
     * @return string Template file name, resolved for local filesystem templates
     */
    protected function getFileName($name)
    {
        $this->validateName($name);

        $fileName = $this->baseDir . '/' . $name;
        if ($this->extension !== '' && substr($fileName, 0 - strlen($this->extension)) !== $this->extension) {
            $fileName .= $this->extension;
        }

        if (!$this->allowUnsafeTemplateNames && $this->checkPath) {
            return $this->ensureContained($fileName, $name);
        }

        return $fileName;
    }

    /**
     * Validate a requested template name before appending it to the base path.
     *
     * @throws UnknownTemplateException If a template name is invalid
     *
     * @param string $name
     */
    private function validateName($name)
    {
        if ($this->allowUnsafeTemplateNames) {
            return;
        }

        if (strpos($name, "\0") !== false) {
            throw new UnknownTemplateException($name);
        }
    }

    /**
     * Resolve and assert that a requested file stays inside the base directory.
     *
     * @throws UnknownTemplateException If a template file is missing or outside the base directory
     *
     * @param string $fileName
     * @param string $name
     *
     * @return string
     */
    private function ensureContained($fileName, $name)
    {
        $real = $this->resolveLocalPath($fileName);

        if ($real === false) {
            throw new UnknownTemplateException($name);
        }

        if (strpos($real . DIRECTORY_SEPARATOR, $this->baseDirPrefix) !== 0) {
            throw new UnknownTemplateException($name);
        }

        return $real;
    }

    /**
     * Resolve a local filesystem path, including file:// URLs.
     *
     * @param string $path
     *
     * @return string|false
     */
    private function resolveLocalPath($path)
    {
        if (strpos($path, 'file://') === 0) {
            $path = substr($path, strlen('file://'));
        }

        return realpath($path);
    }

    /**
     * Only check if baseDir is a directory and requested templates are files
     * when baseDir has no scheme or uses the file:// stream wrapper.
     *
     * @return bool Whether to check `is_dir` and `file_exists`
     */
    protected function shouldCheckPath()
    {
        return strpos($this->baseDir, '://') === false || strpos($this->baseDir, 'file://') === 0;
    }
}
