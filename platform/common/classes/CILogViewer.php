<?php

/**
 * This is an adapted piece of code from
 * https://github.com/SeunMatt/codeigniter-log-viewer
 *
 * Author: Seun Matt (https://github.com/SeunMatt)
 * Date: 09-Jan-18
 * Time: 4:30 AM
 *
 * Adapted by Ivan Tcholakov, 03-SEP-2019.
 * License: MIT.
 */

defined('BASEPATH') OR exit('No direct script access allowed.');

class CILogViewer {

    protected $CI;

    protected $LOG_LINE_START_PATTERN = '/((INFO)|(ERROR)|(DEBUG)|(ALL))[\s\-\d:\.\/]+(\-\->)/';
    protected $LOG_DATE_PATTERN = array('/^((ERROR)|(INFO)|(DEBUG)|(ALL))\s\-\s/', '/\s(\-\->)/');
    protected $LOG_LEVEL_PATTERN = '/^((ERROR)|(INFO)|(DEBUG)|(ALL))/';

    // This is the path (folder) on the system where the log files are stored
    protected $logFolderPath;

    // This is the pattern to pick all log files in the $logFilePath
    protected $logFilePattern;

    // This is a combination of the $this->logFolderPath and $this->logFilePattern
    protected $fullLogFilePath = '';

    protected $MAX_LOG_SIZE = 52428800; // 50 MB

    /**
     * These are the constants representing the
     * various API commands there are
     */
    protected $API_QUERY_PARAM = 'api';
    protected $API_FILE_QUERY_PARAM = 'f';
    protected $API_LOG_STYLE_QUERY_PARAM = 'sline';
    protected $API_CMD_LIST = 'list';
    protected $API_CMD_VIEW = 'view';
    protected $API_CMD_DELETE = 'delete';

    public function __construct() {

        $this->init();
    }

    /**
     * Bootstrap the library
     * Sets the configuration variables
     */
    protected function init() {

        // Initiate Code Igniter Instance
        $this->CI = &get_instance();

        // Configure the log folder path and the file pattern for all the logs in the folder
        $this->logFolderPath = $this->CI->config->item('log_path') != '' ? $this->add_slash($this->CI->config->item('log_path')) : APPPATH.'logs/';
        $this->logFilePattern = $this->CI->config->item('logs_file_name_pattern') != '' ? $this->CI->config->item('logs_file_name_pattern') : 'log-*.php';

        // Concatenate to form Full Log Path
        $this->fullLogFilePath = $this->logFolderPath.$this->logFilePattern;
    }

    /*
     * This function will return the processed HTML page
     * and return it's content that can then be echoed
     *
     * @param $fileName optional base64_encoded filename of the log file to process.
     * @returns the parse view file content as a string that can be echoed
     * */

    public function showLogs() {

        if ($this->CI->input->get('del') != '') {

            $fileName = base64_decode($this->CI->input->get('del'));
            $this->deleteFiles($fileName);

            header('Content-Type: application/json');

            return json_encode(array(
                'success' => true,
                'feedback_message' => $fileName == 'all' ? 'All log files have been deleted.' : 'The file '.$fileName.' has been deleted.',
            ));
        }

        // Process download of log file command
        // if the supplied file exists, then perform download
        // Otherwise, just ignore which will resolve to page reloading
        $dlFile = $this->CI->input->get('dl');

        if ($dlFile != '' && file_exists($this->logFolderPath.basename(base64_decode($dlFile)))) {

            $file = $this->logFolderPath.basename(base64_decode($dlFile));
            $this->downloadFile($file);
        }

        if ($this->CI->input->get($this->API_QUERY_PARAM) != '') {

            return $this->processAPIRequests($this->CI->input->get($this->API_QUERY_PARAM));
        }

        // It will either get the value of f or return null
        $fileName = $this->CI->input->get('f');

        // Get the log files from the log directory
        $files = $this->getFiles();

        // Let's determine what the current log file is
        if ($fileName != '') {
            $currentFile = $this->logFolderPath.basename(base64_decode($fileName));
        } elseif ($fileName == '' && !empty($files)) {
            $currentFile = $this->logFolderPath.$files[0];
        } else {
            $currentFile = null;
        }

        // If the resolved current file is too big
        // just trigger a download of the file
        // Otherwise process its content as log

        if ($currentFile != '' && file_exists($currentFile)) {

            $fileSize = filesize($currentFile);

            if (is_int($fileSize) && $fileSize > $this->MAX_LOG_SIZE) {

                // Download the current file instead.

                $logs = array(
                    array(
                        'level' => 'INFO',
                        'date' => date('Y-m-d h:i:s'),
                        'content' => 'The requested file is too large, prease, download it and view it locally.',
                    ),
                );

            } else {

                $logs = $this->processLogs($this->getLogs($currentFile));
            }

        } else {

            $logs = array();
        }

        $data['logs'] = $logs;
        $data['files'] = !empty($files) ? $files : array();
        $data['currentFile'] = $currentFile != '' ? basename($currentFile) : '';

        header('Content-Type: application/json');

        return json_encode($data);
    }

    protected function processAPIRequests($command) {

        if ($command === $this->API_CMD_LIST) {

            // Respond with a list of all the files
            $response['status'] = true;
            $response['log_files'] = $this->getFilesBase64Encoded();

        } elseif ($command === $this->API_CMD_VIEW) {

            // Respond to view the logs of a particular file
            $file = $this->CI->input->get($this->API_FILE_QUERY_PARAM);
            $response['log_files'] = $this->getFilesBase64Encoded();

            if ($file == '') {

                $response['status'] = false;
                $response['error']['message'] = 'Invalid File Name Supplied: ['.json_encode($file).']';
                $response['error']['code'] = 400;

            } else {

                $singleLine = $this->CI->input->get($this->API_LOG_STYLE_QUERY_PARAM);
                $singleLine = $singleLine != '' && ($singleLine === true || $singleLine === 'true' || $singleLine === '1') ? true : false;
                $logs = $this->processLogsForAPI($file, $singleLine);
                $response['status'] = true;
                $response['logs'] = $logs;
            }

        } elseif ($command === $this->API_CMD_DELETE) {

            $file = $this->CI->input->get($this->API_FILE_QUERY_PARAM);

            if ($file == '') {

                $response['status'] = false;
                $response['error']['message'] = 'NULL value is not allowed for file param';
                $response['error']['code'] = 400;

            } else {

                // Decode file if necessary
                $fileExists = false;

                if ($file !== 'all') {

                    $file = basename(base64_decode($file));
                    $fileExists = file_exists($this->logFolderPath.$file);

                } else {

                    // Check if the directory exists
                    $fileExists = file_exists($this->logFolderPath);
                }

                if ($fileExists) {

                    $this->deleteFiles($file);
                    $response['status'] = true;
                    $response['message'] = 'File ['.html_escape($file).'] deleted';

                } else {

                    $response['status'] = false;
                    $response['error']['message'] = 'File does not exist';
                    $response['error']['code'] = 404;
                }
            }

        } else {

            $response['status'] = false;
            $response['error']['message'] = 'Unsupported Query Command ['.html_escape($command).']';
            $response['error']['code'] = 400;
        }

        // Convert response to json and respond
        header('Content-Type: application/json');

        if (!$response['status']) {
            // Set a generic bad request code
            http_response_code(400);
        } else {
            http_response_code(200);
        }

        return json_encode($response);
    }

    /*
     * This function will process the logs. Extract the log level, icon class and other information
     * from each line of log and then arrange them in another array that is returned to the view for processing
     *
     * @params logs. The raw logs as read from the log file
     * @return array. An [[], [], [] ...] where each element is a processed log line
     * */

    protected function processLogs($logs) {

        if (is_null($logs)) {
            return null;
        }

        $superLog = array();

        foreach ($logs as $log) {

            // Get the logLine Start
            $logLineStart = $this->getLogLineStart($log);

            if (!empty($logLineStart)) {

                // This is actually the start of a new log and not just another line from previous log
                $level = $this->getLogLevel($logLineStart);

                $data = array(
                    'level' => $level,
                    'date' => $this->getLogDate($logLineStart),
                );

                $logMessage = preg_replace($this->LOG_LINE_START_PATTERN, '', $log);

                $data['content'] = $logMessage;

                array_push($superLog, $data);

            } else {

                // This means the file has content that are not logged
                // using log_message()
                // They may be sensitive! so we are just skipping this
                // other we could have just insert them like this
//               array_push($superLog, [
//                   'level' => 'INFO',
//                   'date' => '',
//                   'content' => $log
//               ]);
            }
        }

        return $superLog;
    }

    /**
     * This function will extract the logs in the supplied
     * fileName
     * @param      $fileNameInBase64
     * @param bool $singleLine
     * @return array|null
     * @internal param $logs
     */
    protected function processLogsForAPI($fileNameInBase64, $singleLine = false) {

        $logs = null;

        // Let's prepare the log file name sent from the client
        $currentFile = $this->prepareRawFileName($fileNameInBase64);

        // If the resolved current file is too big
        // just return null
        // Otherwise process its content as log
        if (!is_null($currentFile)) {

            $fileSize = filesize($currentFile);

            if (is_int($fileSize) && $fileSize > $this->MAX_LOG_SIZE) {
                // Trigger a download of the current file instead
                $logs = null;
            } else {
                $logs = $this->getLogsForAPI($currentFile, $singleLine);
            }
        }

        return $logs;
    }

    /*
     * Extract the log level from the logLine
     * @param $logLineStart - The single line that is the start of log line.
     * Extracted by getLogLineStart()
     *
     * @return log level e.g. ERROR, DEBUG, INFO
     * */

    protected function getLogLevel($logLineStart) {

        preg_match($this->LOG_LEVEL_PATTERN, $logLineStart, $matches);

        return $matches[0];
    }

    protected function getLogDate($logLineStart) {

        return preg_replace($this->LOG_DATE_PATTERN, '', $logLineStart);
    }

    protected function getLogLineStart($logLine) {

        preg_match($this->LOG_LINE_START_PATTERN, $logLine, $matches);

        if (!empty($matches)) {

            return $matches[0];
        }

        return '';
    }

    /*
     * Returns an array of the file contents
     * each element in the array is a line
     * in the underlying log file
     * @returns array | each line of file contents is an entry in the returned array.
     * @params complete fileName
     * */

    protected function getLogs($fileName) {

        $size = filesize($fileName);

        if (!$size || $size > $this->MAX_LOG_SIZE) {

            return null;
        }

        return file($fileName, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    }

    /**
     * This function will get the contents of the log
     * file as a string. It will first check for the
     * size of the file before attempting to get the contents.
     *
     * By default it will return all the log contents as an array where the
     * elements of the array is the individual lines of the files
     * otherwise, it will return all file content as a single string with each line ending
     * in line break character "\n"
     * @param      $fileName
     * @param bool $singleLine
     * @return bool|string
     */
    protected function getLogsForAPI($fileName, $singleLine = false) {

        $size = filesize($fileName);

        if (!$size || $size > $this->MAX_LOG_SIZE) {

            return 'File Size too Large. Please donwload it locally';
        }

        return (!$singleLine) ? file($fileName, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) : file_get_contents($fileName);
    }

    /*
     * This will get all the files in the logs folder
     * It will reverse the files fetched and
     * make sure the latest log file is in the first index
     *
     * @param boolean. If true returns the basename of the files otherwise full path
     * @returns array of file
     * */

    protected function getFiles($basename = true) {

        $files = glob($this->fullLogFilePath);

        $files = array_reverse($files);
        $files = array_filter($files, 'is_file');

        if ($basename && is_array($files)) {

            foreach ($files as $k => $file) {
                $files[$k] = basename($file);
            }
        }

        return array_values($files);
    }

    /**
     * This function will return an array of available log
     * files
     * The array will containt the base64encoded name
     * as well as the real name of the fiile
     * @return array
     * @internal param bool $appendURL
     * @internal param bool $basename
     */
    protected function getFilesBase64Encoded() {

        $files = glob($this->fullLogFilePath);

        $files = array_reverse($files);
        $files = array_filter($files, 'is_file');

        $finalFiles = array();

        // If we're to return the base name of the files
        // let's do that here
        foreach ($files as $file) {
            array_push($finalFiles, array('file_b64' => base64_encode(basename($file)), 'file_name' => basename($file)));
        }

        return $finalFiles;
    }

    /*
     * Delete one or more log file in the logs directory
     * @param filename. It can be all - to delete all log files - or specific for a file
     * */

    protected function deleteFiles($fileName) {

        if ($fileName == 'all') {
            @ array_map('unlink', glob($this->fullLogFilePath));
        } else {
            @ unlink($this->logFolderPath.basename($fileName));
        }
    }

    /*
     * Download a particular file to local disk
     * This should only be called if the file exists
     * hence, the file exist check has ot be done by the caller
     * @param $fileName the complete file path
     * */

    protected function downloadFile($file) {

        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.basename($file).'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: '.filesize($file));
        readfile($file);

        exit;
    }

    /**
     * This function will take in the raw file
     * name as sent from the browser/client
     * and append the LOG_FOLDER_PREFIX and decode it from base64
     * @param $fileNameInBase64
     * @return null|string
     * @internal param $fileName
     */
    protected function prepareRawFileName($fileNameInBase64) {

        // Let's determine what the current log file is
        if (!is_null($fileNameInBase64) && !empty($fileNameInBase64)) {
            $currentFile = $this->logFolderPath.basename(base64_decode($fileNameInBase64));
        } else {
            $currentFile = null;
        }

        return $currentFile;
    }

    // Added by Ivan Tcholakov, 03-SEP-2019.
    protected function add_slash($string) {

        $string = (string) $string;

        if ($string != '') {
            $string = rtrim($string, '/').'/';
        }

        return $string;
    }

}
