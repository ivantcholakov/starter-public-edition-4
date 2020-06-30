<?php

use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

/**
 * A PHP wrapper for cssnano.js
 *
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2016-2020.
 * @license The MIT License (MIT)
 * @link http://opensource.org/licenses/MIT
 */

class Cssnano_Parser {

    protected $options;
    protected $stdout;
    protected $stderr;
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

        $filename = tempnam($this->options['tmp_dir'], 'Cssnano_');
        file_put_contents($filename, $str);

        try {

            $this->parse($filename);

        } catch (\Exception $ex) {

            @ unlink($filename);

            throw new \RuntimeException($this->stderr);
        }

        @ unlink($filename);

        return $this->stdout;
    }

    /**
     * Parse a Less string from a given file
     *
     * @param string $filename The file to parse
     * @param string $uri_root The url of the file
     * @return string
     */
    public function parse($filename) {

        $this->stdout = '';
        $this->stderr = '';

        $cmd = $this->getCompilerPath().' --no-map --use cssnano'.$this->parseOptions().' '.escape_shell_arg($filename);

        $process = new Process($cmd);

        try {

            $process->mustRun();

            $this->stdout = $process->getOutput();

        } catch (\Exception $exception) {

            $this->stderr = '\Cssnano: Can\'t execute a command.';

            if (ENVIRONMENT !== 'production') {
                $this->stderr .= PHP_EOL.$exception->getMessage();
            }

            if (isset($this->config_file)) {

                @ unlink($this->config_file);
                $this->config_file = null;
            }

            throw new \RuntimeException($this->stderr);
        }

        if (isset($this->config_file)) {

            @ unlink($this->config_file);
            $this->config_file = null;
        }

        return $this->stdout;
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

        $result[] = '--config '.escape_shell_arg($this->config_file);

        return empty($result) ? '' : ' '.implode(' ', $result);
    }

    protected function getCompilerPath() {

        return $this->options['postcss_path'];
    }

}
