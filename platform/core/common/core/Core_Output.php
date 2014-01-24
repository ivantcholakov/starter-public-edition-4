<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * A upgrade of the Output Class
 * Output caching is to support query strings.
 * @author Modifications by Ivan Tcholakov, 2012
 * @license The MIT License, http://opensource.org/licenses/MIT for my modifications.
 */

class Core_Output extends CI_Output {

    public function __construct()
    {
        parent::__construct();
    }

    // -------------------------------------------------------------------------

    /**
     * Write Cache
     *
     * @param    string    $output    Output data to cache
     * @return    void
     */
    public function _display($output = '')
    {
        // Note:  We use globals because we can't use $CI =& get_instance()
        // since this function is sometimes called by the caching mechanism,
        // which happens before the CI super object is available.
        global $BM, $CFG, $LANG;

        // Grab the super object if we can.
        if (class_exists('CI_Controller', FALSE))
        {
            $CI =& get_instance();
        }

        // --------------------------------------------------------------------

        // Set the output data
        if ($output === '')
        {
            $output =& $this->final_output;
        }

        // --------------------------------------------------------------------

        // Parse language translation tags (<i18n>...</i18n>).

        $parse_i18n = (bool) $CFG->item('parse_i18n');

        if (isset($CI) && is_object($CI) && isset($CI->parse_i18n))
        {
            // Override the global setting.
            $parse_i18n = (bool) $CI->parse_i18n;
        }

        if ($parse_i18n && $this->mime_type == 'text/html')
        {
            $output = $LANG->parse_i18n($output);
        }

        // --------------------------------------------------------------------

        // Is minify requested?
        if ($CFG->item('minify_output') === TRUE)
        {
            $output = $this->minify($output, $this->mime_type);
        }

        // --------------------------------------------------------------------

        // Do we need to write a cache file? Only if the controller does not have its
        // own _output() method and we are not dealing with a cache file, which we
        // can determine by the existence of the $CI object above
        // A patch by Ivan Tcholakov, 11-DEC-2012. Cache only when the the core has been initialized normally.
        //if ($this->cache_expiration > 0 && isset($CI) && ! method_exists($CI, '_output'))
        if ($this->cache_expiration > 0 && isset($CI) && ! method_exists($CI, '_output')
            && (defined('NORMAL_MVC_EXECUTION') ? NORMAL_MVC_EXECUTION : true)
        )
        //
        {
            $this->_write_cache($output);
        }

        // --------------------------------------------------------------------

        // Parse out the elapsed time and memory usage,
        // then swap the pseudo-variables with the data

        $elapsed = $BM->elapsed_time('total_execution_time_start', 'total_execution_time_end');

        if ($this->parse_exec_vars === TRUE)
        {
            $memory    = round(memory_get_usage() / 1024 / 1024, 2).'MB';
            $output = str_replace(array('{elapsed_time}', '{memory_usage}'), array($elapsed, $memory), $output);
        }

        // --------------------------------------------------------------------

        // Is compression requested?
        if (isset($CI) // This means that we're not serving a cache file, if we were, it would already be compressed
            && $this->_compress_output === TRUE
            && isset($_SERVER['HTTP_ACCEPT_ENCODING']) && strpos($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip') !== FALSE)
        {
            ob_start('ob_gzhandler');
        }

        // --------------------------------------------------------------------

        // An Additional check by Ivan Tcholakov, 14-OCT-2013.
        if (NORMAL_MVC_EXECUTION) {
        //
            // Are there any server headers to send?
            if (count($this->headers) > 0)
            {
                foreach ($this->headers as $header)
                {
                    @header($header[0], $header[1]);
                }
            }
        }

        // --------------------------------------------------------------------

        // Does the $CI object exist?
        // If not we know we are dealing with a cache file so we'll
        // simply echo out the data and exit.
        if ( ! isset($CI))
        {
            if ($this->_compress_output === TRUE)
            {
                if (isset($_SERVER['HTTP_ACCEPT_ENCODING']) && strpos($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip') !== FALSE)
                {
                    header('Content-Encoding: gzip');
                    header('Content-Length: '.strlen($output));
                }
                else
                {
                    // User agent doesn't support gzip compression,
                    // so we'll have to decompress our cache
                    $output = gzinflate(substr($output, 10, -8));
                }
            }

            echo $output;
            log_message('debug', 'Final output sent to browser');
            log_message('debug', 'Total execution time: '.$elapsed);
            return;
        }

        // --------------------------------------------------------------------

        // Do we need to generate profile data?
        // If so, load the Profile class and run it.
        if ($this->enable_profiler === TRUE)
        {
            $CI->load->library('profiler');
            if ( ! empty($this->_profiler_sections))
            {
                $CI->profiler->set_sections($this->_profiler_sections);
            }

            // If the output data contains closing </body> and </html> tags
            // we will remove them and add them back after we insert the profile data
            $output = preg_replace('|</body>.*?</html>|is', '', $output, -1, $count).$CI->profiler->run();
            if ($count > 0)
            {
                $output .= '</body></html>';
            }
        }

        // Does the controller contain a function named _output()?
        // If so send the output there.  Otherwise, echo it.
        if (method_exists($CI, '_output'))
        {
            $CI->_output($output);
        }
        else
        {
            echo $output; // Send it to the browser!
        }

        log_message('debug', 'Final output sent to browser');
        log_message('debug', 'Total execution time: '.$elapsed);
    }

    // --------------------------------------------------------------------

    /**
     * Write Cache
     *
     * @param    string    $output    Output data to cache
     * @return    void
     */
    public function _write_cache($output)
    {
        $CI =& get_instance();
        $path = $CI->config->item('cache_path');
        $cache_path = ($path === '') ? APPPATH.'cache/' : $path;

        if ( ! is_dir($cache_path) OR ! is_really_writable($cache_path))
        {
            log_message('error', 'Unable to write cache file: '.$cache_path);
            return;
        }

        $uri = $CI->config->item('base_url')
            .$CI->config->item('index_page')
            .$CI->uri->uri_string();

        // A patch for supporting query strings --------------------------------
        if (strpos($uri, '?') === false) {
            $query_string = isset($_SERVER['QUERY_STRING']) ? trim($_SERVER['QUERY_STRING']) : '';
            $uri = $query_string != '' ? $uri.'?'.$query_string : $uri;
        }
        //----------------------------------------------------------------------

        $cache_path .= md5($uri);

        if ( ! $fp = @fopen($cache_path, FOPEN_WRITE_CREATE_DESTRUCTIVE))
        {
            log_message('error', 'Unable to write cache file: '.$cache_path);
            return;
        }

        if (flock($fp, LOCK_EX))
        {
            // If output compression is enabled, compress the cache
            // itself, so that we don't have to do that each time
            // we're serving it
            if ($this->_compress_output === TRUE)
            {
                $output = gzencode($output);

                if ($this->get_header('content-type') === NULL)
                {
                    $this->set_content_type($this->mime_type);
                }
            }

            $expire = time() + ($this->cache_expiration * 60);

            // Put together our serialized info.
            $cache_info = serialize(array(
                'expire' => $expire,
                'headers' => $this->headers
            ));

                $output = $cache_info.'ENDCI--->'.$output;

                for ($written = 0, $length = strlen($output); $written < $length; $written += $result)
                {
                    if (($result = fwrite($fp, substr($output, $written))) === FALSE)
                    {
                        break;
                    }
                }

                flock($fp, LOCK_UN);
            }
            else
            {
                log_message('error', 'Unable to secure a file lock for file at: '.$cache_path);
                return;
            }

            fclose($fp);

            if (is_int($result))
            {
                @chmod($cache_path, FILE_WRITE_MODE);
            log_message('debug', 'Cache file written: '.$cache_path);

            // Send HTTP cache-control headers to browser to match file cache settings.
            $this->set_cache_header($_SERVER['REQUEST_TIME'], $expire);
        }
        else
        {
            @unlink($cache_path);
            log_message('error', 'Unable to write the complete cache content at: '.$cache_path);
        }
    }

    // --------------------------------------------------------------------

    /**
     * Update/serve cached output
     *
     * @uses    CI_Config
     * @uses    CI_URI
     *
     * @param    object    &$CFG    CI_Config class instance
     * @param    object    &$URI    CI_URI class instance
     * @return    bool    TRUE on success or FALSE on failure
     */
    public function _display_cache(&$CFG, &$URI)
    {
        $cache_path = ($CFG->item('cache_path') === '') ? APPPATH.'cache/' : $CFG->item('cache_path');

        // Build the file path.  The file name is an MD5 hash of the full URI
        $uri =  $CFG->item('base_url').$CFG->item('index_page').$URI->uri_string;

        // A patch for supporting query strings --------------------------------
        if (strpos($uri, '?') === false) {
            $query_string = isset($_SERVER['QUERY_STRING']) ? trim($_SERVER['QUERY_STRING']) : '';
            $uri = $query_string != '' ? $uri.'?'.$query_string : $uri;
        }
        //----------------------------------------------------------------------

        $filepath = $cache_path.md5($uri);

        if ( ! @file_exists($filepath) OR ! $fp = @fopen($filepath, FOPEN_READ))
        {
            return FALSE;
        }

        flock($fp, LOCK_SH);

        $cache = (filesize($filepath) > 0) ? fread($fp, filesize($filepath)) : '';

        flock($fp, LOCK_UN);
        fclose($fp);

        // Look for embedded serialized file info.
        if ( ! preg_match('/^(.*)ENDCI--->/', $cache, $match))
        {
            return FALSE;
        }

        $cache_info = unserialize($match[1]);
        $expire = $cache_info['expire'];

        $last_modified = filemtime($cache_path);

        // Has the file expired?
        if ($_SERVER['REQUEST_TIME'] >= $expire && is_really_writable($cache_path))
        {
            // If so we'll delete it.
            @unlink($filepath);
            log_message('debug', 'Cache file has expired. File deleted.');
            return FALSE;
        }
        else
        {
            // Or else send the HTTP cache control headers.
            $this->set_cache_header($last_modified, $expire);
        }

        // Add headers from cache file.
        foreach ($cache_info['headers'] as $header)
        {
            $this->set_header($header[0], $header[1]);
        }

        // Display the cache
        $this->_display(substr($cache, strlen($match[0])));
        log_message('debug', 'Cache file is current. Sending it to browser.');
        return TRUE;
    }

}
