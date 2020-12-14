<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Web Assets Compiler
 *
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2020
 * @license The MIT License, http://opensource.org/licenses/MIT
 *
 * Synopsis
 *
 * Executes all the configured tasks:
 * php cli.php assets compile
 *
 * Executes only specifyed task (interval-separates names):
 * php cli.php assets compile task_name_1 task_name_2 task_name_3 ...
 */

class Compile_controller extends Core_Controller {

    protected $tasks;

    public function __construct()
    {
        parent::__construct();

        if (!IS_CLI) {
            show_404();
        }

        $this->config->load('assets_compile', false, true);

        $this->tasks
            = !empty($this->config->config['tasks']) && is_array($this->config->config['tasks'])
            ? $this->config->config['tasks']
            : array();

        $this->load->parser();
        $this->load->helper('file');
    }

    public function index()
    {
        echo PHP_EOL;

        $params = array_slice($this->uri->rsegment_array(), 2);

        if (empty($this->tasks)) {
            return;
        }

        $tasks = [];

        if (empty($params)) {

            $tasks = $this->tasks;

        } else {

            foreach ($params as $name) {

                if (is_int($key = $this->find($name))) {
                    $tasks[] = $this->tasks[$key];
                }
            }
        }

        if (empty($tasks)) {

            echo 'No tasks has been found.'.PHP_EOL;

            return;
        }

        foreach ($tasks as $task) {

            if (!isset($task['name']) || trim($task['name']) == '') {

                echo 'No task name has been specified.'.PHP_EOL;

                return;
            }

            if (!isset($task['type']) || trim($task['type']) == '') {

                echo 'No task type has been specified.'.PHP_EOL;

                return;
            }

            echo 'Task: '.$task['name'].PHP_EOL;
            echo 'Type: '.$task['type'].PHP_EOL;

            if (isset($task['source']) && trim($task['source']) == '') {

                echo $task['name'].': Empty source file name.'.PHP_EOL;

                return;
            }

            if (isset($task['source'])) {

                $source = (string) $task['source'];

                if (!is_file($source)) {

                    echo $task['name'].': '.sprintf('Failed to find the source file "%s".', $source).PHP_EOL;

                    return;
                }

                $task['source'] = $source;

                echo 'Source: '.$task['source'].PHP_EOL;
            }

            if (isset($task['destination']) && trim($task['destination']) == '') {

                echo $task['name'].': Empty destination file name.'.PHP_EOL;

                return;
            }

            if (isset($task['destination'])) {

                $destination = (string) $task['destination'];

                $dir = pathinfo($destination, PATHINFO_DIRNAME);
                file_exists($dir) OR mkdir($dir, DIR_WRITE_MODE, TRUE);

                if (!is_dir($dir)) {

                    echo $task['name'].': '.sprintf('Failed to create the destination directory "%s".', $dir).PHP_EOL;

                    return;
                }

                $task['destination'] = $destination;

                echo 'Destination: '.$task['destination'].PHP_EOL;
            }

            if (isset($task['before'])) {

                if (is_array($task['before'])) {

                    if (is_callable($task['before'])) {

                        call_user_func_array($task['before'], [$task]);

                    } else {

                        foreach($task['before'] as $before) {

                            if (is_callable($before)) {
                                call_user_func_array($before, [$task]);
                            }
                        }
                    }

                } else {

                    if (is_callable($task['before'])) {
                        call_user_func_array($task['before'], [$task]);
                    }
                }
            }

            $this->execute($task);

            if ($task['destination'] != '') {

                if (!write_file($task['destination'], $task['result'])) {

                    echo $task['name'].': '.sprintf('Failed to write the destination file "%s".', $task['destination']).PHP_EOL;

                    return;

                } else {

                    echo $task['name'].': Destination file has been written successfully.'.PHP_EOL;
                }

                @chmod($task['destination'], FILE_WRITE_MODE);
            }

            if (isset($task['after'])) {

                if (is_array($task['after'])) {

                    if (is_callable($task['after'])) {

                        call_user_func_array($task['after'], [$task]);

                    } else {

                        foreach($task['after'] as $after) {

                            if (is_callable($after)) {
                                call_user_func_array($after, [$task]);
                            }
                        }
                    }

                } else {

                    if (is_callable($task['after'])) {
                        call_user_func_array($task['after'], [$task]);
                    }
                }
            }

            if (isset($task['result'])) {
                unset($task['result']);
            }

            echo $task['name'].': Done.'.PHP_EOL;

            echo PHP_EOL;
        }
    }

    protected function find($name)
    {
        $key = array_search($name, array_column($this->tasks, 'name'));

        if (!is_int($key)) {
            $key = false;
        }

        return $key;
    }

    protected function execute(& $task)
    {
        switch ($task['type']) {

            case 'merge_css':

                $this->merge_css($task);

                break;

            case 'merge_js':

                $this->merge_js($task);

                break;

            case 'copy':

                $this->copy($task);

                break;

            case 'less':

                $this->less($task);

                break;

            case 'scss':

                $this->scss($task);

                break;

            case 'autoprefixer':

                $this->autoprefixer($task);

                break;

            case 'cssmin':

                $this->cssmin($task);

                break;

            case 'jsmin':

                $this->jsmin($task);

                break;

            case 'jsonmin':

                $this->jsonmin($task);

                break;
        }
    }

    protected function merge_css(& $task) {

        $task['result'] = '';

        $sources = [];

        if (!empty($task['sources'])) {

            $first = true;

            foreach ($task['sources'] as & $subtask) {

                if (!isset($subtask['type']) || trim($subtask['type']) == '') {

                    echo 'No subtask type has been specified.'.PHP_EOL;

                    return;
                }

                echo 'Subtask: '.$subtask['type'].PHP_EOL;

                if (!in_array($subtask['type'], ['copy', 'less', 'scss', 'autoprefixer', 'cssmin'])) {

                    echo 'Invalid subtask type: '.$subtask['type'].PHP_EOL;

                    return;
                }

                if (isset($subtask['source']) && trim($subtask['source']) == '') {

                    echo 'Subtask: Empty source file name.'.PHP_EOL;

                    return;
                }

                if (isset($subtask['source'])) {

                    $source = (string) $subtask['source'];

                    if (!is_file($source)) {

                        echo 'Subtask: '.sprintf('Failed to find the source file "%s".', $source).PHP_EOL;

                        return;
                    }

                    $subtask['source'] = $source;

                    echo 'Source: '.$subtask['source'].PHP_EOL;
                }

                $this->execute($subtask);

                // Remove @charset "UTF-8"; , because this declaration would be invalid if it was used several times.
                $subtask['result'] = preg_replace('/\@charset\s*["\']UTF-8["\']\s*;{0,1}/i', '', $subtask['result'], 1);

                if ($first) {
                    $task['result'] = trim($subtask['result']);
                } else {
                    $task['result'] .= "\n\n".trim($subtask['result']);
                }

                unset($subtask['result']);

                $first = false;
            }
        }
    }

    protected function merge_js(& $task) {

        $task['result'] = '';

        $sources = [];

        if (!empty($task['sources'])) {

            $first = true;

            foreach ($task['sources'] as & $subtask) {

                if (!isset($subtask['type']) || trim($subtask['type']) == '') {

                    echo 'No subtask type has been specified.'.PHP_EOL;

                    return;
                }

                echo 'Subtask: '.$subtask['type'].PHP_EOL;

                if (!in_array($subtask['type'], ['copy', 'jsmin'])) {

                    echo 'Invalid subtask type: '.$subtask['type'].PHP_EOL;

                    return;
                }

                if (isset($subtask['source']) && trim($subtask['source']) == '') {

                    echo 'Subtask: Empty source file name.'.PHP_EOL;

                    return;
                }

                if (isset($subtask['source'])) {

                    $source = (string) $subtask['source'];

                    if (!is_file($source)) {

                        echo 'Subtask: '.sprintf('Failed to find the source file "%s".', $source).PHP_EOL;

                        return;
                    }

                    $subtask['source'] = $source;

                    echo 'Source: '.$subtask['source'].PHP_EOL;
                }

                $this->execute($subtask);

                if ($first) {
                    $task['result'] = trim($subtask['result']);
                } else {
                    $task['result'] .= "\n\n".trim($subtask['result']);
                }

                unset($subtask['result']);

                $first = false;
            }
        }
    }

    protected function copy(& $task)
    {
        $task['result'] = file_get_contents($task['source']);
    }

    protected function less(& $task)
    {
        $task['result'] = '';

        $renderers = [];

        $renderers['less'] = isset($task['less']) ? $task['less'] : [];
        $renderers['less']['full_path'] = true;

        if (isset($task['autoprefixer'])) {
            $renderers['autoprefixer'] = $task['autoprefixer'];
        }

        if (isset($task['cssmin'])) {
            $renderers['cssmin'] = $task['cssmin'];
        }

        $task['result'] = $this->parser->parse($task['source'], null, true, $renderers);
    }

    protected function scss(& $task)
    {
        $task['result'] = '';

        $renderers = [];

        $renderers['scss'] = isset($task['scss']) ? $task['scss'] : [];
        $renderers['scss']['full_path'] = true;

        if (isset($task['autoprefixer'])) {
            $renderers['autoprefixer'] = $task['autoprefixer'];
        }

        if (isset($task['cssmin'])) {
            $renderers['cssmin'] = $task['cssmin'];
        }

        $task['result'] = $this->parser->parse($task['source'], null, true, $renderers);
    }

    protected function autoprefixer(& $task)
    {
        $task['result'] = '';

        $renderers = [];

        $renderers['autoprefixer'] = isset($task['autoprefixer']) ? $task['autoprefixer'] : [];
        $renderers['autoprefixer']['full_path'] = true;

        if (isset($task['cssmin'])) {
            $renderers['cssmin'] = $task['cssmin'];
        }

        $task['result'] = $this->parser->parse($task['source'], null, true, $renderers);
    }

    protected function cssmin(& $task)
    {
        $task['result'] = '';

        $renderers = [];

        $renderers['cssmin'] = isset($task['cssmin']) ? $task['cssmin'] : [];
        $renderers['cssmin']['full_path'] = true;

        $task['result'] = $this->parser->parse($task['source'], null, true, $renderers);
    }

    protected function jsmin(& $task)
    {
        $task['result'] = '';

        $renderers = [];

        $renderers['jsmin'] = isset($task['jsmin']) ? $task['jsmin'] : [];
        $renderers['jsmin']['full_path'] = true;

        $task['result'] = $this->parser->parse($task['source'], null, true, $renderers);
    }

    protected function jsonmin(& $task)
    {
        $task['result'] = '';

        $renderers = [];

        $renderers['jsonmin'] = isset($task['jsonmin']) ? $task['jsonmin'] : [];
        $renderers['jsonmin']['full_path'] = true;

        $task['result'] = $this->parser->parse($task['source'], null, true, $renderers);
    }

}
