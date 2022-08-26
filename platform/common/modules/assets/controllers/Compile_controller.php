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
        $this->line('');

        $params = array_slice($this->uri->rsegment_array(), 2);

        if (empty($this->tasks)) {

            $this->terminate('There are no configured tasks.');
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

            $this->terminate('No task has been found.');
        }

        foreach ($tasks as $task) {

            if (!isset($task['name']) || trim((string) $task['name']) == '') {

                $this->terminate('No task name has been specified.');
            }

            if (!isset($task['type']) || trim((string) $task['type']) == '') {

                $this->terminate('No task type has been specified.');
            }

            $this->line('Task: '.$task['name']);
            $this->line('Type: '.$task['type']);

            if (isset($task['source']) && trim((string) $task['source']) == '') {

                $this->terminate($task['name'].': Empty source file name.');
            }

            if (isset($task['source'])) {

                $source = (string) $task['source'];

                if (!is_file($source)) {

                    $this->terminate($task['name'].': '.sprintf('Failed to find the source file "%s".', $source));
                }

                $task['source'] = $source;

                $this->line('Source: '.$task['source']);

                $task['source_dir'] = rtrim(str_replace('\\', '/', realpath(dirname($task['source']))), '/').'/';
            }

            if (isset($task['destination']) && trim((string) $task['destination']) == '') {

                $this->terminate($task['name'].': Empty destination file name.');
            }

            if (isset($task['destination'])) {

                $destination = (string) $task['destination'];

                $dir = pathinfo($destination, PATHINFO_DIRNAME);
                file_exists($dir) OR mkdir($dir, DIR_WRITE_MODE, TRUE);

                if (!is_dir($dir)) {

                    $this->terminate($task['name'].': '.sprintf('Failed to create the destination directory "%s".', $dir));
                }

                $task['destination'] = $destination;

                $this->line('Destination: '.$task['destination']);

                $task['destination_dir'] = rtrim(str_replace('\\', '/', realpath(dirname($task['destination']))), '/').'/';
            }

            if (isset($task['before'])) {

                if (is_array($task['before'])) {

                    if (is_callable($task['before'])) {

                        if (call_user_func_array($task['before'], [$task]) === false) {
                            $this->terminate($task['name'].': "before" routine has failed.');
                        }

                    } else {

                        foreach($task['before'] as $before) {

                            if (is_callable($before)) {

                                if (call_user_func_array($before, [$task]) === false) {
                                    $this->terminate($task['name'].': "before" routine has failed.');
                                }
                            }
                        }
                    }

                } else {

                    if (is_callable($task['before'])) {

                        if (call_user_func_array($task['before'], [$task]) === false) {
                            $this->terminate($task['name'].': "before" routine has failed.');
                        }
                    }
                }
            }

            $this->execute($task);

            if ($task['destination'] != '') {

                if (!write_file($task['destination'], $task['result'])) {

                    $this->terminate($task['name'].': '.sprintf('Failed to write the destination file "%s".', $task['destination']));

                } else {

                    $this->line($task['name'].': Destination file has been written successfully.');
                }

                @chmod($task['destination'], FILE_WRITE_MODE);
            }

            if (isset($task['after'])) {

                if (is_array($task['after'])) {

                    if (is_callable($task['after'])) {

                        if (call_user_func_array($task['after'], [$task]) === false) {
                            $this->terminate($task['name'].': "after" routine has failed.');
                        }

                    } else {

                        foreach($task['after'] as $after) {

                            if (is_callable($after)) {

                                if (call_user_func_array($after, [$task]) === false) {
                                    $this->terminate($task['name'].': "after" routine has failed.');
                                }
                            }
                        }
                    }

                } else {

                    if (is_callable($task['after'])) {

                        if (call_user_func_array($task['after'], [$task]) === false) {
                            $this->terminate($task['name'].': "after" routine has failed.');
                        }
                    }
                }
            }

            if (isset($task['result'])) {
                unset($task['result']);
            }

            $this->line($task['name'].': Done.');

            $this->line('');
        }
    }

    protected function line($message)
    {
        echo $message.PHP_EOL;
    }

    protected function terminate($message)
    {
        echo $message.PHP_EOL;
        echo PHP_EOL;
        exit(1);
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

                $subtask['name'] = $task['name'];

                if (!isset($subtask['type']) || trim((string) $subtask['type']) == '') {

                    $this->terminate('No subtask type has been specified.');
                }

                $this->line('Subtask: '.$subtask['type']);

                if (!in_array($subtask['type'], ['copy', 'less', 'scss', 'autoprefixer', 'cssmin'])) {

                    $this->terminate('Invalid subtask type: '.$subtask['type']);
                }

                if (isset($subtask['source']) && trim((string) $subtask['source']) == '') {

                    $this->terminate('Subtask: Empty source file name.');
                }

                if (isset($subtask['source'])) {

                    $source = (string) $subtask['source'];

                    if (!is_file($source)) {

                        $this->terminate('Subtask: '.sprintf('Failed to find the source file "%s".', $source));
                    }

                    $subtask['source'] = $source;

                    $this->line('Source: '.$subtask['source']);

                    $subtask['source_dir'] = rtrim(str_replace('\\', '/', realpath(dirname($subtask['source']))), '/').'/';
                }

                if (isset($task['destination_dir'])) {
                    $subtask['destination_dir'] = $task['destination_dir'];
                }

                if (isset($subtask['before'])) {

                    if (is_array($subtask['before'])) {

                        if (is_callable($subtask['before'])) {

                            if (call_user_func_array($subtask['before'], [$subtask]) === false) {
                                $this->terminate($subtask['name'].': "before" routine has failed.');
                            }

                        } else {

                            foreach($subtask['before'] as $before) {

                                if (is_callable($before)) {

                                    if (call_user_func_array($before, [$subtask]) === false) {
                                        $this->terminate($subtask['name'].': "before" routine has failed.');
                                    }
                                }
                            }
                        }

                    } else {

                        if (is_callable($subtask['before'])) {

                            if (call_user_func_array($subtask['before'], [$subtask]) === false) {
                                $this->terminate($subtask['name'].': "before" routine has failed.');
                            }
                        }
                    }
                }

                $this->execute($subtask);

                // Remove @charset "UTF-8"; , because this declaration would be invalid if it was used several times.
                $subtask['result'] = preg_replace('/\@charset\s*["\']UTF-8["\']\s*;{0,1}/i', '', $subtask['result'], 1);

                if (isset($subtask['after'])) {

                    if (is_array($subtask['after'])) {

                        if (is_callable($subtask['after'])) {

                            if (call_user_func_array($subtask['after'], [$subtask]) === false) {
                                $this->terminate($subtask['name'].': "after" routine has failed.');
                            }

                        } else {

                            foreach($subtask['after'] as $after) {

                                if (is_callable($after)) {

                                    if (call_user_func_array($after, [$subtask]) === false) {
                                        $this->terminate($subtask['name'].': "after" routine has failed.');
                                    }
                                }
                            }
                        }

                    } else {

                        if (is_callable($subtask['after'])) {

                            if (call_user_func_array($subtask['after'], [$subtask]) === false) {
                                $this->terminate($subtask['name'].': "after" routine has failed.');
                            }
                        }
                    }
                }

                if ($first) {
                    $task['result'] = trim((string) $subtask['result']);
                } else {
                    $task['result'] .= "\n\n".trim((string) $subtask['result']);
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

                $subtask['name'] = $task['name'];

                if (!isset($subtask['type']) || trim((string) $subtask['type']) == '') {

                    $this->terminate('No subtask type has been specified.');
                }

                $this->line('Subtask: '.$subtask['type']);

                if (!in_array($subtask['type'], ['copy', 'jsmin'])) {

                    $this->terminate('Invalid subtask type: '.$subtask['type']);
                }

                if (isset($subtask['source']) && trim((string) $subtask['source']) == '') {

                    $this->terminate('Subtask: Empty source file name.');
                }

                if (isset($subtask['source'])) {

                    $source = (string) $subtask['source'];

                    if (!is_file($source)) {

                        $this->terminate('Subtask: '.sprintf('Failed to find the source file "%s".', $source));
                    }

                    $subtask['source'] = $source;

                    $this->line('Source: '.$subtask['source']);

                    $subtask['source_dir'] = rtrim(str_replace('\\', '/', realpath(dirname($subtask['source']))), '/').'/';
                }

                if (isset($task['destination_dir'])) {
                    $subtask['destination_dir'] = $task['destination_dir'];
                }

                if (isset($subtask['before'])) {

                    if (is_array($subtask['before'])) {

                        if (is_callable($subtask['before'])) {

                            if (call_user_func_array($subtask['before'], [$subtask]) === false) {
                                $this->terminate($subtask['name'].': "before" routine has failed.');
                            }

                        } else {

                            foreach($subtask['before'] as $before) {

                                if (is_callable($before)) {

                                    if (call_user_func_array($before, [$subtask]) === false) {
                                        $this->terminate($subtask['name'].': "before" routine has failed.');
                                    }
                                }
                            }
                        }

                    } else {

                        if (is_callable($subtask['before'])) {

                            if (call_user_func_array($subtask['before'], [$subtask]) === false) {
                                $this->terminate($subtask['name'].': "before" routine has failed.');
                            }
                        }
                    }
                }

                $this->execute($subtask);

                if (isset($subtask['after'])) {

                    if (is_array($subtask['after'])) {

                        if (is_callable($subtask['after'])) {

                            if (call_user_func_array($subtask['after'], [$subtask]) === false) {
                                $this->terminate($subtask['name'].': "after" routine has failed.');
                            }

                        } else {

                            foreach($subtask['after'] as $after) {

                                if (is_callable($after)) {

                                    if (call_user_func_array($after, [$subtask]) === false) {
                                        $this->terminate($subtask['name'].': "after" routine has failed.');
                                    }
                                }
                            }
                        }

                    } else {

                        if (is_callable($subtask['after'])) {

                            if (call_user_func_array($subtask['after'], [$subtask]) === false) {
                                $this->terminate($subtask['name'].': "after" routine has failed.');
                            }
                        }
                    }
                }

                if ($first) {
                    $task['result'] = trim((string) $subtask['result']);
                } else {
                    $task['result'] .= "\n\n".trim((string) $subtask['result']);
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
