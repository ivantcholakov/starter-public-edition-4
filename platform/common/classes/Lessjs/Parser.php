<?php

use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

/**
 * A PHP wrapper for less.js
 *
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2016-2020.
 * @license The MIT License (MIT)
 * @link http://opensource.org/licenses/MIT
 */

class Lessjs_Parser {

    protected $options;
    protected $stdout;
    protected $stderr;

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

        $filename = tempnam($this->options['tmp_dir'], 'Lessjs_');
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
     * Parse a Less string from a given file
     *
     * @param string $filename The file to parse
     * @param string $uri_root The url of the file
     * @return string
     */
    public function parse($filename) {

        $this->stdout = '';
        $this->stderr = '';

        $cmd = $this->getCompilerPath().$this->parseOptions().' '.escape_shell_arg($filename);

        $process = new Process($cmd);

        try {

            $process->mustRun();

            $this->stdout = $process->getOutput();

        } catch (\Exception $exception) {

            $this->stderr = 'Lessjs: Can\'t execute a command.';

            if (ENVIRONMENT !== 'production') {
                $this->stderr .= PHP_EOL.$exception->getMessage();
            }

            throw new \RuntimeException($this->stderr);
        }

        return $this->stdout;
    }

    //--------------------------------------------------------------------------

    protected function resetOptions() {

        $this->options = array();

        $this->options['lessc_path'] = 'lessc';
        $this->options['tmp_dir'] = sys_get_temp_dir();
        $this->options['compress'] = false; // This option is deprecated.
        $this->options['strictUnits'] = false;
        $this->options['uri_root'] = '';
        $this->options['relativeUrls'] = true;
    }

    protected function setOption($key, $value) {

        switch ($key) {

            case 'lessc_path':
                $this->options[$key] = $value == '' ? 'lessc' : $value;
                break;

            case 'tmp_dir':
                $this->options[$key] = $value == '' ? sys_get_temp_dir() : $value;
                break;

            default:
                $this->options[$key] = $value;
                break;
        }
    }

    protected function parseOptions() {

        $result = array();

        foreach ($this->options as $key => $value) {

            switch ($key) {

                case 'compress':

                    if (!empty($value)) {
                        $result[] = '--compress';
                    }

                    break;

                case 'strictUnits':

                    if (!empty($value)) {
                        $result[] = '--strict-units=on';
                    }

                    break;

                case 'uri_root':

                    if ($value != '') {
                        $result[] = '--rootpath='.escape_shell_arg($value);
                    }

                    break;

                case 'relativeUrls':

                    if (!empty($value)) {
                        $result[] = '--relative-urls';
                    }

                    break;
            }
        }

        return empty($result) ? '' : ' '.implode(' ', $result);
    }

    protected function getCompilerPath() {

        return $this->options['lessc_path'];
    }

}
