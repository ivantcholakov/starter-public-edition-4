<?php

// Added by Ivan Tcholakov, 07-JUN-2017.

defined('BASEPATH') OR exit('No direct script access allowed');

class Core_Log extends CI_Log {

    public function __construct()
    {
        $config =& get_config();

        // Modified by Ivan Tcholakov, 27-FEB-2021.
        //isset(self::$func_overload) OR self::$func_overload = (extension_loaded('mbstring') && ini_get('mbstring.func_overload'));
        isset(self::$func_overload) OR self::$func_overload = (defined('MB_OVERLOAD_STRING') && ((int) @ini_get('mbstring.func_overload') & MB_OVERLOAD_STRING));
        //

        $this->_log_path = ($config['log_path'] !== '') ? $config['log_path'] : APPPATH.'logs/';
        file_exists($this->_log_path) OR mkdir($this->_log_path, DIR_WRITE_MODE, TRUE);
        $this->_file_permissions = FILE_WRITE_MODE;

        parent::__construct();
    }

    // --------------------------------------------------------------------

    /**
     * Write Log File
     *
     * Generally this function will be called using the global log_message() function
     *
     * @param       string      $level      The error level: 'error', 'debug' or 'info'
     * @param       string      $msg        The error message
     * @return      bool
     */
    public function write_log($level, $msg)
    {
        if ($this->_enabled === FALSE)
        {
            return FALSE;
        }

        $level = strtoupper($level);

        if (( ! isset($this->_levels[$level]) OR ($this->_levels[$level] > $this->_threshold))
            && ! isset($this->_threshold_array[$this->_levels[$level]]))
        {
            return FALSE;
        }

        $filepath = $this->_log_path.'log-'.date('Y-m-d').'.'.$this->_file_ext;
        $message = '';

        if ( ! file_exists($filepath))
        {
            $newfile = TRUE;
            // Only add protection to php files
            if ($this->_file_ext === 'php')
            {
                $message .= "<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>\n\n";
            }
        }

        if ( ! $fp = @fopen($filepath, 'ab'))
        {
            return FALSE;
        }

        flock($fp, LOCK_EX);

        // Instantiating DateTime with microseconds appended to initial date is needed for proper support of this format
        if (strpos($this->_date_fmt, 'u') !== FALSE)
        {
            $microtime_full = microtime(TRUE);
            $microtime_short = sprintf("%06d", ($microtime_full - floor($microtime_full)) * 1000000);
            $date = new DateTime(date('Y-m-d H:i:s.'.$microtime_short, $microtime_full));
            $date = $date->format($this->_date_fmt);
        }
        else
        {
            $date = date($this->_date_fmt);
        }

        $message .= $this->_format_line($level, $date, $msg);

        for ($written = 0, $length = self::strlen($message); $written < $length; $written += $result)
        {
            if (($result = fwrite($fp, self::substr($message, $written))) === FALSE)
            {
                break;
            }
        }

        flock($fp, LOCK_UN);
        fclose($fp);

        if (isset($newfile) && $newfile === TRUE)
        {
            // Modified by Ivan Tcholakov, 12-APR-2015.
            //chmod($filepath, $this->_file_permissions);
            @chmod($filepath, $this->_file_permissions);
            //
        }

        return is_int($result);
    }

    // --------------------------------------------------------------------

    /**
     * Format the log line.
     *
     * This is for extensibility of log formatting
     * If you want to change the log format, extend the CI_Log class and override this method
     *
     * @param       string      $level      The error level
     * @param       string      $date       Formatted date string
     * @param       string      $message    The log message
     * @return      string      Formatted log line with a new line character '\n' at the end
     */
    protected function _format_line($level, $date, $message)
    {
        // Modified by Ivan Tcholakov, URL recording feature, 16-FEB-2016.
        //return $level.' - '.$date.' --> '.$message."\n";
        return $level.' - '.$date.' --> '.$message.(!is_cli() ? (defined('CURRENT_URL') ? ' --> URL: '.CURRENT_URL : '') : (isset($_SERVER['argv']) && is_array($_SERVER['argv']) ? ' --> Command: '.implode(' ', $_SERVER['argv']) : ''))."\n";
        //
    }

}
