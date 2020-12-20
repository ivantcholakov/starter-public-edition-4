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
        'type' => 'merge_css',
        'destination' => DEFAULTFCPATH.'themes/front_default/css/front.min.css',
        'sources' => [
            [
                'source' => DEFAULTFCPATH.'themes/front_default/less/index.less',
                'type' => 'less',
                'less' => [],
                'autoprefixer' => ['browsers' => $config['autoprefixer_browsers']],
                'cssmin' => [],
            ],
            [
                'source' => DEFAULTFCPATH.'assets/css/lib/jquery-ui-custom/jquery-ui.min.css',
                'type' => 'copy',
            ],
            [
                'source' => DEFAULTFCPATH.'assets/css/lib/sweetalert2/sweetalert2.min.css',
                'type' => 'copy',
            ],
            [
                'source' => DEFAULTFCPATH.'assets/composer-asset/components/highlightjs/styles/github.css',
                'type' => 'cssmin',
            ],
            [
                'source' => DEFAULTFCPATH.'assets/css/lib/animate/animate.min.css',
                'type' => 'copy',
            ],
        ],
        'after' => [
            '_assets_compile_create_sha384',
        ],
    ],

    // php cli.php assets compile front-default-js-min

    [
        'name' => 'front-default-js-min',
        'type' => 'merge_js',
        'destination' => DEFAULTFCPATH.'themes/front_default/js/front.min.js',
        'sources' => [
            [
                'source' => DEFAULTFCPATH.'assets/js/lib/turbolinks/turbolinks.js',
                'type' => 'copy',
            ],
            [
                'source' => DEFAULTFCPATH.'assets/js/turbolinks.js',
                'type' => 'jsmin',
            ],
            [
                'source' => DEFAULTFCPATH.'assets/js/lib/phpjs/phpjs.min.js',
                'type' => 'copy',
            ],
            [
                'source' => DEFAULTFCPATH.'assets/js/lib/promise-polyfill/polyfill.min.js',
                'type' => 'copy',
            ],
            [
                'source' => DEFAULTFCPATH.'assets/composer-asset/components/modernizr/modernizr.js',
                'type' => 'jsmin',
            ],
            [
                'source' => DEFAULTFCPATH.'assets/composer-asset/components/highlightjs/highlight.pack.min.js',
                'type' => 'copy',
            ],
            [
                'source' => DEFAULTFCPATH.'assets/js/highlight.js',
                'type' => 'jsmin',
            ],
            [
                'source' => DEFAULTFCPATH.'assets/js/lib/sweetalert2/sweetalert2.min.js',
                'type' => 'copy',
            ],
            [
                'source' => DEFAULTFCPATH.'assets/composer-asset/components/jquery/jquery.min.js',
                'type' => 'copy',
            ],
            [
                'source' => DEFAULTFCPATH.'assets/js/lib/jquery-ajax-queue/jquery-ajax-queue.js',
                'type' => 'jsmin',
            ],
            [
                'source' => DEFAULTFCPATH.'assets/js/lib/jquery-base64/jquery.base64.js',
                'type' => 'jsmin',
            ],
            [
                'source' => DEFAULTFCPATH.'assets/js/lib/jquery-json/jquery.json.js',
                'type' => 'jsmin',
            ],
            [
                'source' => DEFAULTFCPATH.'assets/js/lib/jquery-url/jquery.url.js',
                'type' => 'copy',
            ],
            [
                'source' => DEFAULTFCPATH.'assets/js/lib/gibberish-aes/gibberish-aes.min.js',
                'type' => 'copy',
            ],
            [
                'source' => DEFAULTFCPATH.'assets/js/lib/handlebars/handlebars.min.js',
                'type' => 'copy',
            ],
            [
                'source' => DEFAULTFCPATH.'assets/js/lib/mustache/mustache.min.js',
                'type' => 'copy',
            ],
            [
                'source' => DEFAULTFCPATH.'assets/js/lib/semantic/semantic.min.js',
                'type' => 'copy',
            ],
            [
                'source' => DEFAULTFCPATH.'assets/js/lib/dataTables/jquery.dataTables.min.js',
                'type' => 'copy',
            ],
            [
                'source' => DEFAULTFCPATH.'assets/js/lib/dataTables/dataTables.semanticui.min.js',
                'type' => 'copy',
            ],
            [
                'source' => DEFAULTFCPATH.'assets/js/lib/dataTables/plug-ins/api/sortNeutral.js',
                'type' => 'jsmin',
            ],
            [
                'source' => DEFAULTFCPATH.'assets/js/lib/dataTables/dataTables.responsive.min.js',
                'type' => 'copy',
            ],
            [
                'source' => DEFAULTFCPATH.'assets/js/lib/dataTables/responsive.semanticui.min.js',
                'type' => 'copy',
            ],
            [
                'source' => DEFAULTFCPATH.'assets/js/lib/dataTables/dataTables.select.min.js',
                'type' => 'copy',
            ],
            [
                'source' => DEFAULTFCPATH.'assets/js/lib/jquery-ui-custom/jquery-ui.min.js',
                'type' => 'copy',
            ],
            [
                'source' => DEFAULTFCPATH.'assets/js/lib/headroom/headroom.min.js',
                'type' => 'copy',
            ],
            [
                'source' => DEFAULTFCPATH.'assets/js/lib/headroom/jQuery.headroom.min.js',
                'type' => 'copy',
            ],
            [
                'source' => DEFAULTFCPATH.'assets/composer-asset/desandro/imagesloaded/imagesloaded.pkgd.min.js',
                'type' => 'copy',
            ],
            [
                'source' => DEFAULTFCPATH.'assets/composer-asset/desandro/masonry/dist/masonry.pkgd.min.js',
                'type' => 'copy',
            ],
            [
                'source' => DEFAULTFCPATH.'assets/js/lib/swiper/swiper.min.js',
                'type' => 'copy',
            ],
            [
                'source' => DEFAULTFCPATH.'assets/js/lib/colorbox/jquery.colorbox-min.js',
                'type' => 'copy',
            ],
        ],
        'after' => [
            '_assets_compile_create_sha384',
        ],
    ],

    // -------------------------------------------------------------------------

    // php cli.php assets compile front-semantic-ui-flat-min

    [
        'name' => 'front-semantic-ui-flat-min',
        'type' => 'merge_css',
        'destination' => DEFAULTFCPATH.'themes/front_semantic_ui_flat/css/front.min.css',
        'sources' => [
            [
                'source' => DEFAULTFCPATH.'themes/front_semantic_ui_flat/less/index.less',
                'type' => 'less',
                'less' => [],
                'autoprefixer' => ['browsers' => $config['autoprefixer_browsers']],
                'cssmin' => [],
            ],
            [
                'source' => DEFAULTFCPATH.'assets/css/lib/jquery-ui-custom/jquery-ui.min.css',
                'type' => 'copy',
            ],
            [
                'source' => DEFAULTFCPATH.'assets/css/lib/sweetalert2/sweetalert2.min.css',
                'type' => 'copy',
            ],
            [
                'source' => DEFAULTFCPATH.'assets/composer-asset/components/highlightjs/styles/github.css',
                'type' => 'cssmin',
            ],
            [
                'source' => DEFAULTFCPATH.'assets/css/lib/animate/animate.min.css',
                'type' => 'copy',
            ],
        ],
        'after' => [
            '_assets_compile_create_sha384',
        ],
    ],

    // php cli.php assets compile front-semantic-ui-flat-js-min

    [
        'name' => 'front-semantic-ui-flat-js-min',
        'type' => 'merge_js',
        'destination' => DEFAULTFCPATH.'themes/front_semantic_ui_flat/js/front.min.js',
        'sources' => [
            [
                'source' => DEFAULTFCPATH.'assets/js/lib/turbolinks/turbolinks.js',
                'type' => 'copy',
            ],
            [
                'source' => DEFAULTFCPATH.'assets/js/turbolinks.js',
                'type' => 'jsmin',
            ],
            [
                'source' => DEFAULTFCPATH.'assets/js/lib/phpjs/phpjs.min.js',
                'type' => 'copy',
            ],
            [
                'source' => DEFAULTFCPATH.'assets/js/lib/promise-polyfill/polyfill.min.js',
                'type' => 'copy',
            ],
            [
                'source' => DEFAULTFCPATH.'assets/composer-asset/components/modernizr/modernizr.js',
                'type' => 'jsmin',
            ],
            [
                'source' => DEFAULTFCPATH.'assets/composer-asset/components/highlightjs/highlight.pack.min.js',
                'type' => 'copy',
            ],
            [
                'source' => DEFAULTFCPATH.'assets/js/highlight.js',
                'type' => 'jsmin',
            ],
            [
                'source' => DEFAULTFCPATH.'assets/js/lib/sweetalert2/sweetalert2.min.js',
                'type' => 'copy',
            ],
            [
                'source' => DEFAULTFCPATH.'assets/composer-asset/components/jquery/jquery.min.js',
                'type' => 'copy',
            ],
            [
                'source' => DEFAULTFCPATH.'assets/js/lib/jquery-ajax-queue/jquery-ajax-queue.js',
                'type' => 'jsmin',
            ],
            [
                'source' => DEFAULTFCPATH.'assets/js/lib/jquery-base64/jquery.base64.js',
                'type' => 'jsmin',
            ],
            [
                'source' => DEFAULTFCPATH.'assets/js/lib/jquery-json/jquery.json.js',
                'type' => 'jsmin',
            ],
            [
                'source' => DEFAULTFCPATH.'assets/js/lib/jquery-url/jquery.url.js',
                'type' => 'copy',
            ],
            [
                'source' => DEFAULTFCPATH.'assets/js/lib/gibberish-aes/gibberish-aes.min.js',
                'type' => 'copy',
            ],
            [
                'source' => DEFAULTFCPATH.'assets/js/lib/handlebars/handlebars.min.js',
                'type' => 'copy',
            ],
            [
                'source' => DEFAULTFCPATH.'assets/js/lib/mustache/mustache.min.js',
                'type' => 'copy',
            ],
            [
                'source' => DEFAULTFCPATH.'assets/js/lib/semantic/semantic.min.js',
                'type' => 'copy',
            ],
            [
                'source' => DEFAULTFCPATH.'assets/js/lib/dataTables/jquery.dataTables.min.js',
                'type' => 'copy',
            ],
            [
                'source' => DEFAULTFCPATH.'assets/js/lib/dataTables/dataTables.semanticui.min.js',
                'type' => 'copy',
            ],
            [
                'source' => DEFAULTFCPATH.'assets/js/lib/dataTables/plug-ins/api/sortNeutral.js',
                'type' => 'jsmin',
            ],
            [
                'source' => DEFAULTFCPATH.'assets/js/lib/dataTables/dataTables.responsive.min.js',
                'type' => 'copy',
            ],
            [
                'source' => DEFAULTFCPATH.'assets/js/lib/dataTables/responsive.semanticui.min.js',
                'type' => 'copy',
            ],
            [
                'source' => DEFAULTFCPATH.'assets/js/lib/dataTables/dataTables.select.min.js',
                'type' => 'copy',
            ],
            [
                'source' => DEFAULTFCPATH.'assets/js/lib/jquery-ui-custom/jquery-ui.min.js',
                'type' => 'copy',
            ],
            [
                'source' => DEFAULTFCPATH.'assets/js/lib/headroom/headroom.min.js',
                'type' => 'copy',
            ],
            [
                'source' => DEFAULTFCPATH.'assets/js/lib/headroom/jQuery.headroom.min.js',
                'type' => 'copy',
            ],
            [
                'source' => DEFAULTFCPATH.'assets/composer-asset/desandro/imagesloaded/imagesloaded.pkgd.min.js',
                'type' => 'copy',
            ],
            [
                'source' => DEFAULTFCPATH.'assets/composer-asset/desandro/masonry/dist/masonry.pkgd.min.js',
                'type' => 'copy',
            ],
            [
                'source' => DEFAULTFCPATH.'assets/js/lib/swiper/swiper.min.js',
                'type' => 'copy',
            ],
            [
                'source' => DEFAULTFCPATH.'assets/js/lib/colorbox/jquery.colorbox-min.js',
                'type' => 'copy',
            ],
        ],
        'after' => [
            '_assets_compile_create_sha384',
        ],
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
