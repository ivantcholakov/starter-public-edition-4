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
            return;
        }

        foreach ($tasks as $task) {

            $source = isset($task['source']) ? (string) $task['source'] : '';

            if (isset($task['source'])) {

                if ($source == '') {
                    continue;
                }

                if (!is_file($source)) {
                    continue;
                }

                $task['source'] = $source;
            }

            $destination = isset($task['destination']) ? (string) $task['destination'] : '';

            if (isset($task['destination'])) {

                if ($destination == '') {
                    continue;
                }

                $dir = pathinfo($destination, PATHINFO_DIRNAME);
                file_exists($dir) OR mkdir($dir, DIR_WRITE_MODE, TRUE);

                if (!is_dir($dir)) {

                    echo $task['name'].': '.sprintf('Failed to create the destination directory "%s".', $dir).PHP_EOL;

                    return;
                }

                $task['destination'] = $destination;
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

                try {

                    write_file($task['destination'], $task['result']);
                    @chmod($task['destination'], FILE_WRITE_MODE);

                    echo $task['name'].': '.$task['destination'].PHP_EOL;

                } catch(Exception $e) {

                    echo $task['name'].': '.$e->getMessage().PHP_EOL;

                    return;
                }
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
        }

        echo PHP_EOL;
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

                if (!in_array($subtask['type'], ['copy', 'less', 'scss', 'autoprefixer', 'cssmin'])) {
                    continue;
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

    protected function merge_js(& $task) {

        $task['result'] = '';

        $sources = [];

        if (!empty($task['sources'])) {

            $first = true;

            foreach ($task['sources'] as & $subtask) {

                if (!in_array($subtask['type'], ['copy', 'jsmin'])) {
                    continue;
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
