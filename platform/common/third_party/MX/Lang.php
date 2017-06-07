<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Modular Extensions - HMVC
 *
 * Adapted from the CodeIgniter Core Classes
 * @link        https://codeigniter.com
 *
 * Description:
 * This library extends the CodeIgniter CI_Language class
 * and adds features allowing use of modules and the HMVC design pattern.
 *
 * Install this file as application/third_party/MX/Lang.php
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
class MX_Lang extends CI_Lang
{
    public function load($langfile = array(), $lang = '', $return = FALSE, $add_suffix = TRUE, $alt_path = '', $_module = '') {

        if (!class_exists('CI')) {
            // This happens before the whole core has been loaded.
            $alt_path = COMMONPATH;
            // Modified by Ivan Tcholakov, 07-JUN-2017.
            //return parent::load($langfile, $lang, $return, $add_suffix, $alt_path);
            return $this->_ci_lang_load($langfile, $lang, $return, $add_suffix, $alt_path);
            //
        }

        if (is_array($langfile)) {

            foreach($langfile as $_lang) {
                $this->load($_lang);
            }

            return $this->language;
        }

        $deft_lang = CI::$APP->config->item('language');
        $idiom = ($lang == '') ? $deft_lang : $lang;

        if (in_array($langfile.'_lang.php', $this->is_loaded, TRUE)) {
            return $this->language;
        }

        $_module OR $_module = CI::$APP->router->fetch_module();
        list($path, $_langfile) = Modules::find($langfile.'_lang', $_module, 'language/'.$idiom.'/');

        if ($path === FALSE) {

            // Modified by Ivan Tcholakov, 07-JUN-2017.
            //if ($lang = parent::load($langfile, $lang, $return, $add_suffix, $alt_path)) {
            if ($lang = $this->_ci_lang_load($langfile, $lang, $return, $add_suffix, $alt_path)) {
            //
                return $lang;
            }

        } else {

            if ($lang = Modules::load_file($_langfile, $path, 'lang')) {

                if ($return) {
                    return $lang;
                }

                $this->language = array_merge($this->language, $lang);
                $this->is_loaded[] = $langfile.'_lang.php';
                unset($lang);
            }
        }

        return $this->language;
    }

    // This is a customized version of the method CI_Lang::load().
    protected function _ci_lang_load($langfile, $idiom = '', $return = FALSE, $add_suffix = TRUE, $alt_path = '')
    {
        if (is_array($langfile))
        {
            foreach ($langfile as $value)
            {
                $this->load($value, $idiom, $return, $add_suffix, $alt_path);
            }

            return;
        }

        $langfile = str_replace('.php', '', $langfile);

        if ($add_suffix === TRUE)
        {
            $langfile = preg_replace('/_lang$/', '', $langfile).'_lang';
        }

        $langfile .= '.php';

        if (empty($idiom) OR ! preg_match('/^[a-z_-]+$/i', $idiom))
        {
            $config =& get_config();
            $idiom = empty($config['language']) ? 'english' : $config['language'];
        }

        if ($return === FALSE && isset($this->is_loaded[$langfile]) && $this->is_loaded[$langfile] === $idiom)
        {
            return;
        }

        // Load the base file, so any others found can override it
        $basepath = BASEPATH.'language/'.$idiom.'/'.$langfile;
        if (($found = file_exists($basepath)) === TRUE)
        {
            include($basepath);
        }

        // Do we have an alternative path to look in?
        if ($alt_path !== '')
        {
            $alt_path .= 'language/'.$idiom.'/'.$langfile;
            if (file_exists($alt_path))
            {
                include($alt_path);
                $found = TRUE;
            }
        }
        else
        {
            // Added by Ivan Tcholakov, 18-APR-2013.
            if (is_object(get_instance()))
            {
            //
            foreach (get_instance()->load->get_package_paths(TRUE) as $package_path)
            {
                $package_path .= 'language/'.$idiom.'/'.$langfile;
                if ($basepath !== $package_path && file_exists($package_path))
                {
                    include($package_path);
                    $found = TRUE;
                    break;
                }
            }
            //
            }
            //
        }

        if ($found !== TRUE)
        {
            show_error('Unable to load the requested language file: language/'.$idiom.'/'.$langfile);
        }

        if ( ! isset($lang) OR ! is_array($lang))
        {
            log_message('error', 'Language file contains no data: language/'.$idiom.'/'.$langfile);

            if ($return === TRUE)
            {
                return array();
            }
            return;
        }

        if ($return === TRUE)
        {
            return $lang;
        }

        $this->is_loaded[$langfile] = $idiom;
        $this->language = array_merge($this->language, $lang);

        log_message('info', 'Language file loaded: language/'.$idiom.'/'.$langfile);
        return TRUE;
    }

}
