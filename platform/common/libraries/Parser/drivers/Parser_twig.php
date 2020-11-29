<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class CI_Parser_twig extends CI_Parser_driver {

    protected $config;
    protected $environment_options;
    private $ci;
    protected $renderer;

    public function initialize()
    {
        $this->ci = get_instance();

        // Default configuration options.

        $this->environment_options = array(
            'debug' => false,
            'charset' => 'UTF-8',
            'strict_variables' => false,
            'autoescape' => 'html',
            'cache' => false,
            'auto_reload' => null,
            'optimizations' => -1,
        );

        $this->config = array(
            'debug' => false,
            'charset' => null,
            'cache' => false,
            'full_path' => false,
        );

        $this->config = array_merge($this->environment_options, $this->config);

        if ($this->ci->config->load('parser_twig', TRUE, TRUE))
        {
            $defaults = $this->ci->config->item('parser_twig');

            $this->config = array_merge($this->config, $defaults);
        }

        // Injecting configuration options directly.

        if (isset($this->_parent) && !empty($this->_parent->params) && is_array($this->_parent->params))
        {
            $this->config = array_merge($this->config, $this->_parent->params);

            if (array_key_exists('parser_driver', $this->config))
            {
                unset($this->config['parser_driver']);
            }
        }

        log_message('info', 'CI_Parser_twig Class Initialized');
    }

    public function parse($template, $data = array(), $return = FALSE, $options = array())
    {
        if (!is_array($options))
        {
            $options = array();
        }

        $options = array_merge($this->config, $options);

        if (!isset($options['charset']) || trim($options['charset']) == '')
        {
            $options['charset'] = $this->ci->config->item('charset');
        }

        $options['charset'] = strtoupper($options['charset']);

        if (is_object($data))
        {
            $data = get_object_vars($data);
        }

        if (!is_array($data))
        {
            if (empty($data))
            {
                $data = array();
            }
            else
            {
                $data = (array) $data;
            }
        }

        $ci = $this->ci;
        $is_mx = false;

        if (!$return || !$options['full_path'])
        {
            list($ci, $is_mx) = $this->detect_mx();
        }

        if (!$options['full_path'])
        {
            $template = $ci->load->path($template);
        }

        $options['paths'] = $options['paths'] ?? [];
        $options['paths'] = array_merge($options['paths'], $ci->load->locations('views'));
        $filesystemLoader = $this->createFilesystemLoader(array_only($options, 'paths'));

        $directory = pathinfo($template, PATHINFO_DIRNAME);
        $basename = pathinfo($template, PATHINFO_BASENAME);

        $filesystemLoader->prependPath($directory);

        $this->renderer = new \Twig\Environment($filesystemLoader, array_only(
            $options, [
                'debug',
                'charset',
                'strict_variables',
                'autoescape',
                'cache',
                'auto_reload',
                'optimizations',
            ]
        ));

        $this->loadHelpers($options);
        $this->loadExtensions($options);
        $this->loadFunctions($options);
        $this->loadFilters($options);
        $this->loadTests($options);
        $this->loadGlobals($options);

        $result =$this->renderer->render($basename, $data);

        return $this->output($result, $return, $ci, $is_mx);
    }

    public function parse_string($template, $data = array(), $return = FALSE, $options = array())
    {
        if (!is_array($options))
        {
            $options = array();
        }

        $options = array_merge($this->config, $options);

        if (!isset($options['charset']) || trim($options['charset']) == '')
        {
            $options['charset'] = $this->ci->config->item('charset');
        }

        $options['charset'] = strtoupper($options['charset']);

        if (is_object($data))
        {
            $data = get_object_vars($data);
        }

        if (!is_array($data))
        {
            if (empty($data))
            {
                $data = array();
            }
            else
            {
                $data = (array) $data;
            }
        }

        $ci = $this->ci;
        $is_mx = false;

        if (!$return)
        {
            list($ci, $is_mx) = $this->detect_mx();
        }

        // Don't use the cache on string parsing, otherwise
        // the cache would be overloaded with too much files
        // that should be cleaned periodically.
        $options['cache'] = false;

        $options['paths'] = $options['paths'] ?? [];
        $options['paths'] = array_merge($options['paths'], $ci->load->locations('views'));
        $filesystemLoader = $this->createFilesystemLoader(array_only($options, 'paths'));

        $this->renderer = new \Twig\Environment($filesystemLoader, array_only(
            $options, [
                'debug',
                'charset',
                'strict_variables',
                'autoescape',
                'cache',
                'auto_reload',
                'optimizations',
            ]
        ));

        $this->loadHelpers($options);
        $this->loadExtensions($options);
        $this->loadFunctions($options);
        $this->loadFilters($options);
        $this->loadTests($options);
        $this->loadGlobals($options);

        $template = $this->renderer->createTemplate($template);

        $result = $template->render($data);

        return $this->output($result, $return, $ci, $is_mx);
    }

    protected function createFilesystemLoader(array $options = null)
    {
        if (empty($options)) {
            $options = [];
        }

        $loader = new \Parser_Twig_Loader_Filesystem([]);

        $options = $options['paths'] ?? [];

        if (!is_array($options)) {
            $options = [];
        }

        foreach ($options as $path) {

            if (is_array($path)) {

                $count = count($path);

                if ($count > 1 && $path[1] == 'prepend') {
                    $loader->prependPath($path[0]);
                } elseif ($count > 0) {
                    $loader->addPath($path[0]);
                }

            } else {

                $loader->addPath($path);
            }
        }

        return $loader;
    }

    protected function loadHelpers(array $options = null)
    {
        if (empty($options)) {
            $options = [];
        }

        $helpers = $options['helpers'] ?? [];

        if (!is_array($helpers)) {
            $helpers = [];
        }

        foreach ($helpers as $item) {

            if (is_array($item)) {

                if (empty($item)) {
                    continue;
                }

            } else {

                $item = (string) $item;

                if ($item == '') {
                    continue;
                }
            }

            $this->ci->load->helper($item);
        }
    }

    protected function loadExtensions(array $options = null)
    {
        if (empty($options)) {
            $options = [];
        }

        $ext_options = $options['extensions'] ?? [];

        if (!is_array($ext_options)) {
            $ext_options = [];
        }

        $extensions = [];

        foreach ($ext_options as $item) {

            if (is_array($item)) {

                $extensions = array_merge($extensions, $item);

            } else {

                $extensions[$item] = true;
            }
        }

        if (!empty($options['debug'])) {
            $extensions['\Twig\Extension\DebugExtension'] = true;
        }

        foreach ($extensions as $extension => $enabled) {

            if (!is_string($extension)) {
                continue;
            }

            if (!empty($enabled)) {
                $this->renderer->addExtension(new $extension);
            }
        }

        $this->renderer->addExtension(new \Twig\Extension\SandboxExtension(new \Twig\Sandbox\SecurityPolicy(
            !empty($options['sandbox_tags']) && is_array($options['sandbox_tags']) ? $options['sandbox_tags'] : [],
            !empty($options['sandbox_filters']) && is_array($options['sandbox_filters']) ? $options['sandbox_filters'] : [],
            !empty($options['sandbox_methods']) && is_array($options['sandbox_methods']) ? $options['sandbox_methods'] : [],
            !empty($options['sandbox_properties']) && is_array($options['sandbox_properties']) ? $options['sandbox_properties'] : [],
            !empty($options['sandbox_functions']) && is_array($options['sandbox_functions']) ? $options['sandbox_functions'] : []
        )));
    }

    protected function loadFunctions(array $options = null)
    {
        if (empty($options)) {
            $options = [];
        }

        $functions = $options['functions'] ?? [];

        if (!is_array($functions)) {
            $functions = [];
        }

        $loadedFunctions = [];

        foreach ($functions as $item) {

            if (!is_array($item)) {
                $item = array((string) $item);
            }

            $count = count($item);

            if (empty($count)) {
                continue;
            }

            switch ($count) {

                case 1:

                    $this->renderer->addFunction(new \Twig\TwigFunction($item[0], $item[0]));
                    $loadedFunctions[] = $item[0];
                    break;

                case 2:

                    $this->renderer->addFunction(new \Twig\TwigFunction($item[0], $item[1]));
                    $loadedFunctions[] = $item[0];
                    break;

                case 3:

                    $this->renderer->addFunction(new \Twig\TwigFunction($item[0], $item[1], $item[2]));
                    $loadedFunctions[] = $item[0];
                    break;

                default:

                    if ($item[3] !== false) {
                        $this->renderer->addFunction(new \Twig\TwigFunction($item[0], $item[1], $item[2]));
                        $loadedFunctions[] = $item[0];
                    }

                    break;
            }
        }

        if (!empty($options['debug'])) {

            if (!in_array('print_d', $loadedFunctions)) {
                $this->renderer->addFunction(new \Twig\TwigFunction('print_d', 'print_d', ['is_safe' => ['html']]));
            }
        }
    }

    protected function loadFilters(array $options = null)
    {
        if (empty($options)) {
            $options = [];
        }

        $filters = $options['filters'] ?? [];

        if (!is_array($filters)) {
            $filters = [];
        }

        foreach ($filters as $item) {

            if (!is_array($item)) {
                $item = array((string) $item);
            }

            $count = count($item);

            if (empty($count)) {
                continue;
            }

            switch ($count) {

                case 1:

                    $this->renderer->addFilter(new \Twig\TwigFilter($item[0], $item[0]));
                    break;

                case 2:

                    $this->renderer->addFilter(new \Twig\TwigFilter($item[0], $item[1]));
                    break;

                case 3:

                    $this->renderer->addFilter(new \Twig\TwigFilter($item[0], $item[1], $item[2]));
                    break;

                default:

                    if ($item[3] !== false) {
                        $this->renderer->addFilter(new \Twig\TwigFilter($item[0], $item[1], $item[2]));
                    }

                    break;
            }
        }
    }

    protected function loadTests(array $options = null)
    {
        if (empty($options)) {
            $options = [];
        }

        $tests = $options['tests'] ?? [];

        if (!is_array($tests)) {
            $tests = [];
        }

        foreach ($tests as $item) {

            if (!is_array($item)) {
                $item = array((string) $item);
            }

            $count = count($item);

            if ($count == 0) {
                continue;
            }

            switch ($count) {

                case 1:

                    $this->renderer->addTest(new \Twig\TwigTest($item[0], $item[0]));
                    break;

                case 2:

                    $this->renderer->addTest(new \Twig\TwigTest($item[0], $item[1]));
                    break;

                case 3:

                    $this->renderer->addTest(new \Twig\TwigTest($item[0], $item[1], $item[2]));
                    break;

                default:

                    if ($item[3] !== false) {
                        $this->renderer->addTest(new \Twig\TwigTest($item[0], $item[1], $item[2]));
                    }

                    break;
            }
        }
    }

    protected function loadGlobals(array $options = null)
    {
        if (empty($options)) {
            $options = [];
        }

        $globals = $options['globals'] ?? [];

        if (!is_array($globals)) {
            $globals = [];
        }

        foreach ($globals as $item) {

            if (!is_array($item)) {
                continue;
            }

            $count = count($item);

            if ($count < 2) {
                continue;
            }

            if (!is_string($item[0]) || $item[0] == '') {
                continue;
            }

            $this->renderer->addGlobal($item[0], $item[1]);
        }
    }

    //--------------------------------------------------------------------------

    protected function _extend_parser(& $parser, & $options)
    {
        if (isset($options['timezone']) && $options['timezone'] != '')
        {
            $parser->getExtension('core')->setTimezone($options['timezone']);
        }

        if (!empty($options['helpers']) && is_array($options['helpers']))
        {
            foreach ($options['helpers'] as & $item)
            {
                $item = trim(@ (string) $item);

                if ($item != '')
                {
                    $this->ci->load->helper($item);
                }
            }

            unset($item);
        }

        $loaded_extensions = array();

        if (!empty($options['extensions']) && is_array($options['extensions']))
        {
            foreach ($options['extensions'] as & $item)
            {
                if (!is_array($item))
                {
                    $item = array((string) $item);
                }

                switch (count($item))
                {
                    case 1:

                        $parser->addExtension(new $item[0]);
                        $loaded_extensions[] = $item[0];
                        break;

                    default:

                        if ($item[1] !== false)
                        {
                            $parser->addExtension(new $item[0]);
                            $loaded_extensions[] = $item[0];
                        }

                        break;
                }
            }

            unset($item);
        }

        if (!empty($options['debug']))
        {
            if (!in_array('Twig_Extension_Debug', $loaded_extensions))
            {
                $parser->addExtension(new Twig_Extension_Debug);
            }
        }

        $loaded_functions = array();

        if (!empty($options['functions']) && is_array($options['functions']))
        {
            foreach ($options['functions'] as & $item)
            {
                if (!is_array($item))
                {
                    $item = array((string) $item);
                }

                switch (count($item))
                {
                    case 1:

                        $parser->addFunction(new Twig_SimpleFunction($item[0], $item[0]));
                        $loaded_functions[] = $item[0];
                        break;

                    case 2:

                        $parser->addFunction(new Twig_SimpleFunction($item[0], $item[1]));
                        $loaded_functions[] = $item[0];
                        break;

                    case 3:

                        $parser->addFunction(new Twig_SimpleFunction($item[0], $item[1], $item[2]));
                        $loaded_functions[] = $item[0];
                        break;

                    default:

                        if ($item[3] !== false)
                        {
                            $parser->addFunction(new Twig_SimpleFunction($item[0], $item[1], $item[2]));
                            $loaded_functions[] = $item[0];
                        }

                        break;
                }
            }

            unset($item);
        }

        if (!empty($options['debug']))
        {
            if (!in_array('print_d', $loaded_functions))
            {
                $parser->addFunction(new Twig_SimpleFunction('print_d', 'print_d', array('is_safe' => array('html'))));
            }

            if (!in_array('print_r', $loaded_functions))
            {
                $parser->addFunction(new Twig_SimpleFunction('print_r', array('Parser_Twig_Extension_Debug', 'print_r'), array('is_safe' => array('html'))));
            }

            if (!in_array('var_export', $loaded_functions))
            {
                $parser->addFunction(new Twig_SimpleFunction('var_export', array('Parser_Twig_Extension_Debug', 'var_export'), array('is_safe' => array('html'))));
            }
        }

        if (!empty($options['filters']) && is_array($options['filters']))
        {
            foreach ($options['filters'] as & $item)
            {
                if (!is_array($item))
                {
                    $item = array((string) $item);
                }

                switch (count($item))
                {
                    case 1:

                        $parser->addFilter(new Twig_SimpleFilter($item[0], $item[0]));
                        break;

                    case 2:

                        $parser->addFilter(new Twig_SimpleFilter($item[0], $item[1]));
                        break;

                    case 3:

                        $parser->addFilter(new Twig_SimpleFilter($item[0], $item[1], $item[2]));
                        break;

                    default:

                        if ($item[3] !== false)
                        {
                            $parser->addFilter(new Twig_SimpleFilter($item[0], $item[1], $item[2]));
                        }

                        break;
                }
            }

            unset($item);
        }

        if (!empty($options['tests']) && is_array($options['tests']))
        {
            foreach ($options['tests'] as & $item)
            {
                if (!is_array($item))
                {
                    $item = array((string) $item);
                }

                switch (count($item))
                {
                    case 1:

                        $parser->addTest(new Twig_SimpleTest($item[0], $item[0]));
                        break;

                    case 2:

                        $parser->addTest(new Twig_SimpleTest($item[0], $item[1]));
                        break;

                    case 3:

                        $parser->addTest(new Twig_SimpleTest($item[0], $item[1], $item[2]));
                        break;

                    default:

                        if ($item[3] !== false)
                        {
                            $parser->addTest(new Twig_SimpleTest($item[0], $item[1], $item[2]));
                        }

                        break;
                }
            }

            unset($item);
        }

        $parser->addExtension(new Twig_Extension_Sandbox(new Twig_Sandbox_SecurityPolicy(
            !empty($options['sandbox_tags']) && is_array($options['sandbox_tags']) ? $options['sandbox_tags'] : array(),
            !empty($options['sandbox_filters']) && is_array($options['sandbox_filters']) ? $options['sandbox_filters'] : array(),
            !empty($options['sandbox_methods']) && is_array($options['sandbox_methods']) ? $options['sandbox_methods'] : array(),
            !empty($options['sandbox_properties']) && is_array($options['sandbox_properties']) ? $options['sandbox_properties'] : array(),
            !empty($options['sandbox_functions']) && is_array($options['sandbox_functions']) ? $options['sandbox_functions'] : array()
        )));
    }

}
