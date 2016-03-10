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

        // Added by Ivan Tcholakov, 24-JAN-2016.
        $this->parse_exec_vars = ENVIRONMENT !== 'production';
        //
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
            $memory = round(memory_get_usage() / 1024 / 1024, 2).'MB';
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
            log_message('info', 'Final output sent to browser');
            log_message('info', 'Total execution time: '.$elapsed);
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

        log_message('info', 'Final output sent to browser');
        log_message('info', 'Total execution time: '.$elapsed);
    }

}
