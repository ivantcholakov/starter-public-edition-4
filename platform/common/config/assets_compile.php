<?php

// Compiling visual themes with Semantic/Fomantic UI might require a lot
// of memory for node.js. In such case try from a command line this (Linux):
// export NODE_OPTIONS=--max-old-space-size=8192

// An autoprefixer option: Supported browsers.

$config['autoprefixer_browsers'] = [
    '>= 0.1%',
    'last 2 versions',
    'Firefox ESR',
    'Safari >= 7',
    'iOS >= 7',
    'ie >= 10',
    'Edge >= 12',
    'Android >= 4',
];

// The following command-line runs all the tasks:
// php cli.php assets compile

$config['tasks'] = [

    // php cli.php assets compile editor-min

    [
        'name' => 'editor-min',
        'type' => 'less',
        'source' => DEFAULTFCPATH.'assets/less/lib/editor/index.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/editor/editor.min.css',
        'autoprefixer' => ['browsers' => $config['autoprefixer_browsers']],
        'cssmin' => [],
    ],

    // php cli.php assets compile semantic-ui-min

    [
        'name' => 'semantic-ui-min',
        'type' => 'less',
        'source' => DEFAULTFCPATH.'assets/less/lib/semantic/semantic.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/semantic/semantic.min.css',
        'autoprefixer' => ['browsers' => $config['autoprefixer_browsers']],
        'cssmin' => [],
    ],

    // php cli.php assets compile semantic-ui-custom-min

    [
        'name' => 'semantic-ui-custom-min',
        'type' => 'less',
        'source' => DEFAULTFCPATH.'assets/less/lib/semantic-custom/semantic-custom.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/semantic-custom/semantic-custom.min.css',
        'autoprefixer' => ['browsers' => $config['autoprefixer_browsers']],
        'cssmin' => [],
    ],

    // php cli.php assets compile admin-default-18-min admin-default-18-login-min admin-default-18-error-min

    [
        'name' => 'admin-default-18-min',
        'type' => 'less',
        'source' => DEFAULTFCPATH.'admin/themes/admin_default_18/less/index.less',
        'destination' => DEFAULTFCPATH.'admin/themes/admin_default_18/css/admin.min.css',
        'autoprefixer' => ['browsers' => $config['autoprefixer_browsers']],
        'cssmin' => [],
    ],
    [
        'name' => 'admin-default-18-login-min',
        'type' => 'less',
        'source' => DEFAULTFCPATH.'admin/themes/admin_default_18/less/login.less',
        'destination' => DEFAULTFCPATH.'admin/themes/admin_default_18/css/login.min.css',
        'autoprefixer' => ['browsers' => $config['autoprefixer_browsers']],
        'cssmin' => [],
    ],
    [
        'name' => 'admin-default-18-error-min',
        'type' => 'less',
        'source' => DEFAULTFCPATH.'admin/themes/admin_default_18/less/error.less',
        'destination' => DEFAULTFCPATH.'admin/themes/admin_default_18/css/error.min.css',
        'autoprefixer' => ['browsers' => $config['autoprefixer_browsers']],
        'cssmin' => [],
    ],

    // php cli.php assets compile admin-default-17-min admin-default-17-login-min admin-default-17-error-min

    [
        'name' => 'admin-default-17-min',
        'type' => 'less',
        'source' => DEFAULTFCPATH.'admin/themes/admin_default_17/less/index.less',
        'destination' => DEFAULTFCPATH.'admin/themes/admin_default_17/css/admin.min.css',
        'autoprefixer' => ['browsers' => $config['autoprefixer_browsers']],
        'cssmin' => [],
    ],
    [
        'name' => 'admin-default-17-login-min',
        'type' => 'less',
        'source' => DEFAULTFCPATH.'admin/themes/admin_default_17/less/login.less',
        'destination' => DEFAULTFCPATH.'admin/themes/admin_default_17/css/login.min.css',
        'autoprefixer' => ['browsers' => $config['autoprefixer_browsers']],
        'cssmin' => [],
    ],
    [
        'name' => 'admin-default-17-error-min',
        'type' => 'less',
        'source' => DEFAULTFCPATH.'admin/themes/admin_default_17/less/error.less',
        'destination' => DEFAULTFCPATH.'admin/themes/admin_default_17/css/error.min.css',
        'autoprefixer' => ['browsers' => $config['autoprefixer_browsers']],
        'cssmin' => [],
    ],

    // php cli.php assets compile admin-default-min admin-default-login-min admin-default-error-min

    [
        'name' => 'admin-default-min',
        'type' => 'less',
        'source' => DEFAULTFCPATH.'admin/themes/admin_default/less/index.less',
        'destination' => DEFAULTFCPATH.'admin/themes/admin_default/css/admin.min.css',
        'autoprefixer' => ['browsers' => $config['autoprefixer_browsers']],
        'cssmin' => [],
    ],
    [
        'name' => 'admin-default-login-min',
        'type' => 'less',
        'source' => DEFAULTFCPATH.'admin/themes/admin_default/less/login.less',
        'destination' => DEFAULTFCPATH.'admin/themes/admin_default/css/login.min.css',
        'autoprefixer' => ['browsers' => $config['autoprefixer_browsers']],
        'cssmin' => [],
    ],
    [
        'name' => 'admin-default-error-min',
        'type' => 'less',
        'source' => DEFAULTFCPATH.'admin/themes/admin_default/less/error.less',
        'destination' => DEFAULTFCPATH.'admin/themes/admin_default/css/error.min.css',
        'autoprefixer' => ['browsers' => $config['autoprefixer_browsers']],
        'cssmin' => [],
    ],

    // php cli.php assets compile admin-default-15-min admin-default-15-login-min admin-default-15-error-min

    [
        'name' => 'admin-default-15-min',
        'type' => 'less',
        'source' => DEFAULTFCPATH.'admin/themes/admin_default_15/less/index.less',
        'destination' => DEFAULTFCPATH.'admin/themes/admin_default_15/css/admin.min.css',
        'autoprefixer' => ['browsers' => $config['autoprefixer_browsers']],
        'cssmin' => [],
    ],
    [
        'name' => 'admin-default-15-login-min',
        'type' => 'less',
        'source' => DEFAULTFCPATH.'admin/themes/admin_default_15/less/login.less',
        'destination' => DEFAULTFCPATH.'admin/themes/admin_default_15/css/login.min.css',
        'autoprefixer' => ['browsers' => $config['autoprefixer_browsers']],
        'cssmin' => [],
    ],
    [
        'name' => 'admin-default-15-error-min',
        'type' => 'less',
        'source' => DEFAULTFCPATH.'admin/themes/admin_default_15/less/error.less',
        'destination' => DEFAULTFCPATH.'admin/themes/admin_default_15/css/error.min.css',
        'autoprefixer' => ['browsers' => $config['autoprefixer_browsers']],
        'cssmin' => [],
    ],

    // php cli.php assets compile admin-default-14-min admin-default-14-login-min admin-default-14-error-min

    [
        'name' => 'admin-default-14-min',
        'type' => 'less',
        'source' => DEFAULTFCPATH.'admin/themes/admin_default_14/less/index.less',
        'destination' => DEFAULTFCPATH.'admin/themes/admin_default_14/css/admin.min.css',
        'autoprefixer' => ['browsers' => $config['autoprefixer_browsers']],
        'cssmin' => [],
    ],
    [
        'name' => 'admin-default-14-login-min',
        'type' => 'less',
        'source' => DEFAULTFCPATH.'admin/themes/admin_default_14/less/login.less',
        'destination' => DEFAULTFCPATH.'admin/themes/admin_default_14/css/login.min.css',
        'autoprefixer' => ['browsers' => $config['autoprefixer_browsers']],
        'cssmin' => [],
    ],
    [
        'name' => 'admin-default-14-error-min',
        'type' => 'less',
        'source' => DEFAULTFCPATH.'admin/themes/admin_default_14/less/error.less',
        'destination' => DEFAULTFCPATH.'admin/themes/admin_default_14/css/error.min.css',
        'autoprefixer' => ['browsers' => $config['autoprefixer_browsers']],
        'cssmin' => [],
    ],

    // -------------------------------------------------------------------------

    // php cli.php assets compile front-default-min

    [
        'name' => 'front-default-min',
        'type' => 'less',
        'source' => DEFAULTFCPATH.'themes/front_default/less/index.less',
        'destination' => DEFAULTFCPATH.'themes/front_default/css/front.min.css',
        'autoprefixer' => ['browsers' => $config['autoprefixer_browsers']],
        'cssmin' => [],
    ],

    // php cli.php assets compile front-semantic-ui-flat-min

    [
        'name' => 'front-semantic-ui-flat-min',
        'type' => 'less',
        'source' => DEFAULTFCPATH.'hemes/front_semantic_ui_flat/less/index.less',
        'destination' => DEFAULTFCPATH.'themes/front_semantic_ui_flat/css/front.min.css',
        'autoprefixer' => ['browsers' => $config['autoprefixer_browsers']],
        'cssmin' => [],
    ],

    // -------------------------------------------------------------------------
];

if (!function_exists('_assets_compile_create_md5')) {

    function _assets_compile_create_md5($task) {

        $destination_hash = $task['destination'].'.md5';
        $hash = md5($task['result']);

        if (!write_file($destination_hash, $hash)) {
            return false;
        }

        @chmod($destination_hash, FILE_WRITE_MODE);
    }
}

if (!function_exists('_assets_compile_create_sha384')) {

    function _assets_compile_create_sha384($task) {

        $destination_hash = $task['destination'].'.sha384';
        $hash = hash('sha384', $task['result']);

        if (!write_file($destination_hash, $hash)) {
            return false;
        }

        @chmod($destination_hash, FILE_WRITE_MODE);
    }
}

if (!function_exists('_assets_compile_create_sha384_base64')) {

    function _assets_compile_create_sha384_base64($task) {

        $destination_hash = $task['destination'].'.sha384.base64';
        $hash = base64_encode(hash('sha384', $task['result']));

        if (!write_file($destination_hash, $hash)) {
            return false;
        }

        @chmod($destination_hash, FILE_WRITE_MODE);
    }
}
