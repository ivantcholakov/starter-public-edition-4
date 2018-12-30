<?php

/**
 * A PHP wrapper for cssnano.js
 *
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2016.
 * @license The MIT License (MIT)
 * @link http://opensource.org/licenses/MIT
 */

class Cssnano_Parser {

    protected $options;
    protected $config_file;

    public function __construct($options = null) {

        $this->initialize($options);
    }

    public function initialize($options = null) {

        $this->resetOptions();

        if (is_array($options)) {

            foreach ($options as $key => $value) {
                $this->setOption($key, $value);
            }
        }

        return $this;
    }

    /**
     * Parse a Less string into css
     *
     * @param string $str The string to convert
     * @param string $uri_root The url of the file
     * @return string
     */
    public function parseString($str) {

        $result = null;

        $filename = tempnam($this->options['tmp_dir'], 'Cssnano_');
        file_put_contents($filename, $str);

        try {

            $result = $this->parse($filename);

        } catch (Exception $ex) {
            // Intentionally left empty.
        }

        @ unlink($filename);

       if (!empty($ex)) {
            throw $ex;
        }

        return $result;
    }

    /**
     * Parse a Less string from a given file
     *
     * @param string $filename The file to parse
     * @param string $uri_root The url of the file
     * @return string
     */
    public function parse($filename) {

        $cmd = $this->getCompilerPath().' --no-map --use cssnano'.$this->parseOptions().' '.$this->escapeShellArg($filename);

        $descriptorspec = array(
            0 => array('pipe', 'r'), // stdin
            1 => array('pipe', 'w'), // stdout
            2 => array('pipe', 'w')  // stderr
        );

        $process = proc_open($cmd, $descriptorspec, $pipes);

        if (is_resource($process)) {

            $stdout = stream_get_contents($pipes[1]);
            fclose($pipes[1]);

            $stderr = stream_get_contents($pipes[2]);
            fclose($pipes[2]);

            $return = proc_close($process);

        } else {

            $return = 1;
            $stderr = "Cssnano_Parser: Can't execute a command.\n";
        }

        if (isset($this->config_file)) {

            @ unlink($this->config_file);
            $this->config_file = null;
        }

        if ($return === 0) {
            return $stdout;
        }

        throw new RuntimeException($stderr);
    }

    //--------------------------------------------------------------------------

    protected function resetOptions() {

        $this->options = array();

        $this->options['postcss_path'] = 'postcss';
        $this->options['tmp_dir'] = sys_get_temp_dir();
        $this->options['safe'] = true;
    }

    protected function setOption($key, $value) {

        switch ($key) {

            case 'postcss_path':
                $this->options[$key] = $value == '' ? 'postcss' : $value;
                break;

            case 'tmp_dir':
                $this->options[$key] = $value == '' ? sys_get_temp_dir() : $value;
                break;

            case 'safe':
                $this->options[$key] = !empty($value);
                break;

            default:
                $this->options[$key] = $value;
                break;
        }
    }

    protected function parseOptions() {

        $result = array();

        $this->config_file = tempnam($this->options['tmp_dir'], 'Cssnano_config_');

        // The external script requires .json extension,
        // otherwise the file is not accepted as valid.
        rename($this->config_file, $this->config_file .= '.json');

        $config = '{
    "cssnano": {
        "safe": '.json_encode(!empty($this->options['safe'])).'
    }
}';
        file_put_contents($this->config_file, $config);

        $result[] = '--config '.$this->escapeShellArg($this->config_file);

        return empty($result) ? '' : ' '.implode(' ', $result);
    }

    protected function getCompilerPath() {

        return $this->options['postcss_path'];
    }

    protected function isWindows() {

        // Beware about 'Darwin'.
        return 0 === stripos(PHP_OS, 'win');
    }

    protected function escapeShellArg($arg) {

        if ($this->isWindows()) {

            // See http://stackoverflow.com/questions/6427732/how-can-i-escape-an-arbitrary-string-for-use-as-a-command-line-argument-in-windo

            // Sequence of backslashes followed by a double quote:
            // double up all the backslashes and escape the double quote
            $arg = preg_replace('/(\\*)"/', '$1$1\\"', $arg);

            // Sequence of backslashes followed by the end of the arg,
            // which will become a double quote later:
            // double up all the backslashes
            $arg = preg_replace('/(\\*)$/', '$1$1', $arg);

            // All other backslashes do not need modifying

            // Double-quote the whole thing
            $arg = '"'.$arg.'"';

            // Escape shell metacharacters.
            $arg = preg_replace('/([\(\)%!^"<>&|;, ])/', '^$1', $arg);

            return $arg;
        }

        // See http://markushedlund.com/dev-tech/php-escapeshellarg-with-unicodeutf-8-support
        return "'" . str_replace("'", "'\\''", $arg) . "'";
    }

}
