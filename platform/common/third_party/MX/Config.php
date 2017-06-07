<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Modular Extensions - HMVC
 *
 * Adapted from the CodeIgniter Core Classes
 * @link        https://codeigniter.com
 *
 * Description:
 * This library extends the CodeIgniter CI_Config class
 * and adds features allowing use of modules and the HMVC design pattern.
 *
 * Install this file as application/third_party/MX/Config.php
 *
 * @copyright   Copyright (c) 2011 Wiredesignz
 * @version     5.4
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 **/
class MX_Config extends CI_Config
{
    /**
     * List of paths to search when trying to load a config file.
     *
     * @used-by    CI_Loader
     * @var        array
     */
    // Modified by Ivan Tcholakov, 24-DEC-2014.
    //public $_config_paths = array(APPPATH);
    public $_config_paths = array(COMMONPATH, APPPATH);
    //

    public function load($file = 'config', $use_sections = FALSE, $fail_gracefully = FALSE, $_module = '') {

        if (in_array($file, $this->is_loaded, TRUE)) {
            return $this->item($file);
        }

        $_module OR (class_exists('CI') && $_module = CI::$APP->router->fetch_module());
        list($path, $file) = Modules::find($file, $_module, 'config/');

        if ($path === FALSE) {

            $this->_ci_config_load($file, $use_sections, $fail_gracefully);
            return $this->item($file);
        }

        if ($config = Modules::load_file($file, $path, 'config')) {

            /* reference to the config array */
            $current_config =& $this->config;

            if ($use_sections === TRUE) {

                if (isset($current_config[$file])) {
                    $current_config[$file] = array_merge($current_config[$file], $config);
                } else {
                    $current_config[$file] = $config;
                }

            } else {

                $current_config = array_merge($current_config, $config);
            }

            $this->is_loaded[] = $file;
            unset($config);

            return $this->item($file);
        }
    }

    // This is a customized version of the method CI_Config::load().
    protected function _ci_config_load($file = '', $use_sections = FALSE, $fail_gracefully = FALSE)
    {
        $file = ($file === '') ? 'config' : str_replace('.php', '', $file);
        $loaded = FALSE;

        foreach ($this->_config_paths as $path)
        {
            foreach (array($file, ENVIRONMENT.DIRECTORY_SEPARATOR.$file) as $location)
            {
                $file_path = $path.'config/'.$location.'.php';
                if (in_array($file_path, $this->is_loaded, TRUE))
                {
                    // Modified by Ivan Tcholakov, 24-DEC-2014.
                    //return TRUE;
                    $loaded = TRUE;
                    continue 2;
                    //
                }

                if ( ! file_exists($file_path))
                {
                    continue;
                }

                include($file_path);

                if ( ! isset($config) OR ! is_array($config))
                {
                    if ($fail_gracefully === TRUE)
                    {
                        return FALSE;
                    }

                    show_error('Your '.$file_path.' file does not appear to contain a valid configuration array.');
                }

                if ($use_sections === TRUE)
                {
                    $this->config[$file] = isset($this->config[$file])
                        ? array_merge($this->config[$file], $config)
                        : $config;
                }
                else
                {
                    $this->config = array_merge($this->config, $config);
                }

                $this->is_loaded[] = $file_path;
                $config = NULL;
                $loaded = TRUE;
                log_message('info', 'Config file loaded: '.$file_path);
            }
        }

        if ($loaded === TRUE)
        {
            return TRUE;
        }
        elseif ($fail_gracefully === TRUE)
        {
            return FALSE;
        }

        show_error('The configuration file '.$file.'.php does not exist.');
    }

}
