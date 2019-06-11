<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*
 *---------------------------------------------------------------
 * PHP ini settings
 *---------------------------------------------------------------
 */

@date_default_timezone_set('Europe/Sofia');

ini_set('memory_limit', '512M');
ini_set('post_max_size', '16M');

ini_set('upload_max_filesize', '16M');
ini_set('max_file_uploads', 20);

ini_set('max_input_time', 60);

ini_set('auto_detect_line_endings', true);

if (IS_CLI) {

    ini_set('max_execution_time', 0);

    ini_set('html_errors', 0);
    ini_set('error_prepend_string', '');
    ini_set('error_append_string', '');

    ignore_user_abort(true);

} else {

    ini_set('max_execution_time', 300);

    // http://www.controlstyle.com/articles/programming/text/if-mod-since-php/
    session_cache_limiter('private_no_expire');

    // https://stackoverflow.com/questions/22221807/session-cookies-http-secure-flag-how-do-you-set-these

    // **PREVENTING SESSION HIJACKING**
    // Prevents javascript XSS attacks aimed to steal the session ID
    ini_set('session.cookie_httponly', 1);

    // **PREVENTING SESSION FIXATION**
    // Session ID cannot be passed through URLs
    ini_set('session.use_only_cookies', 1);

    // Uses a secure connection (HTTPS) if possible
    ini_set('session.cookie_secure', 1);
}

ini_set('pcre.backtrack_limit', 10000000);

// https://stackoverflow.com/questions/34849485/regex-not-working-for-long-pattern-pcres-jit-compiler-stack-limit-php7
ini_set('pcre.jit', false);
