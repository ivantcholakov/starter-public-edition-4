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
     * Parse a CSS string
     *
     * @param string $str The string to convert
     * @return string
     */
    public function parseString($str) {

        $filename = tempnam($this->options['tmp_dir'], 'Cssnano_');
        file_put_contents($filename, $str);
        @chmod($filename, FILE_WRITE_MODE);

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
     * Parse a CSS string from a given file
     *
     * @param string $filename The file to parse
     * @return string
     */
    public function parse($filename) {

        $this->stdout = '';
        $this->stderr = '';

        $cmd = $this->getCompilerPath().' --no-map --use cssnano'.$this->parseOptions().' '.escape_shell_arg($filename);

        $process = Process::fromShellCommandline($cmd);
        $process->setTimeout(3600);

        try {

            $process->mustRun();

            $this->stdout = $process->getOutput();

        } catch (\Exception $exception) {

            $this->stderr = '\Cssnano: Can\'t execute a command.';

            if (IS_CLI || ENVIRONMENT !== 'production') {
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

        $config_file = tempnam($this->options['tmp_dir'], 'Cssnano_config_');
        @chmod($config_file, FILE_WRITE_MODE);
        $this->config_file = $config_file.'.json';

        $config = '{
    "cssnano": {
        "safe": '.json_encode(!empty($this->options['safe'])).'
    }
}';
        file_put_contents($this->config_file, $config);
        @chmod($this->config_file, FILE_WRITE_MODE);
        @unlink($config_file);

        $result[] = '--config '.escape_shell_arg($this->config_file);

        return empty($result) ? '' : ' '.implode(' ', $result);
    }

    protected function getCompilerPath() {

        return $this->options['postcss_path'];
    }

}
