<?php

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

    // SCSS --------------------------------------------------------------------

    // php cli.php assets compile material-design-icons material-design-icons-min

    [
        'name' => 'material-design-icons',
        'type' => 'scss',
        'destination' => DEFAULTFCPATH.'assets/css/lib/material-design-icons/material-icons.css',
        'source' => DEFAULTFCPATH.'assets/scss/lib/material-design-icons/material-icons.scss',
        'autoprefixer' => ['browsers' => $config['autoprefixer_browsers']],
    ],
    [
        'name' => 'material-design-icons-min',
        'type' => 'scss',
        'destination' => DEFAULTFCPATH.'assets/css/lib/material-design-icons/material-icons.min.css',
        'source' => DEFAULTFCPATH.'assets/scss/lib/material-design-icons/material-icons.scss',
        'autoprefixer' => ['browsers' => $config['autoprefixer_browsers']],
        'cssmin' => [],
    ],

    // php cli.php assets compile sweetalert sweetalert-min sweetalert-custom sweetalert-custom-min sweetalert-facebook sweetalert-facebook-min sweetalert-google sweetalert-google-min sweetalert-twitter sweetalert-twitter-min

    // php cli.php assets compile sweetalert sweetalert-min

    [
        'name' => 'sweetalert',
        'type' => 'scss',
        'destination' => DEFAULTFCPATH.'assets/css/lib/sweetalert/sweetalert.css',
        'source' => DEFAULTFCPATH.'assets/scss/lib/sweetalert/sweetalert.scss',
        'autoprefixer' => ['browsers' => $config['autoprefixer_browsers']],
    ],
    [
        'name' => 'sweetalert-min',
        'type' => 'scss',
        'destination' => DEFAULTFCPATH.'assets/css/lib/sweetalert/sweetalert.min.css',
        'source' => DEFAULTFCPATH.'assets/scss/lib/sweetalert/sweetalert.scss',
        'autoprefixer' => ['browsers' => $config['autoprefixer_browsers']],
        'cssmin' => [],
    ],

    // php cli.php assets compile sweetalert-custom sweetalert-custom-min

    [
        'name' => 'sweetalert-custom',
        'type' => 'scss',
        'destination' => DEFAULTFCPATH.'assets/css/lib/sweetalert/sweetalert-custom.css',
        'source' => DEFAULTFCPATH.'assets/scss/lib/sweetalert/sweetalert-custom.scss',
        'autoprefixer' => ['browsers' => $config['autoprefixer_browsers']],
    ],
    [
        'name' => 'sweetalert-custom-min',
        'type' => 'scss',
        'destination' => DEFAULTFCPATH.'assets/css/lib/sweetalert/sweetalert-custom.min.css',
        'source' => DEFAULTFCPATH.'assets/scss/lib/sweetalert/sweetalert-custom.scss',
        'autoprefixer' => ['browsers' => $config['autoprefixer_browsers']],
        'cssmin' => [],
    ],

    // php cli.php assets compile sweetalert-facebook sweetalert-facebook-min

    [
        'name' => 'sweetalert-facebook',
        'type' => 'scss',
        'destination' => DEFAULTFCPATH.'assets/css/lib/sweetalert/facebook.css',
        'source' => DEFAULTFCPATH.'assets/scss/lib/sweetalert/facebook.scss',
        'autoprefixer' => ['browsers' => $config['autoprefixer_browsers']],
    ],
    [
        'name' => 'sweetalert-facebook-min',
        'type' => 'scss',
        'destination' => DEFAULTFCPATH.'assets/css/lib/sweetalert/facebook.min.css',
        'source' => DEFAULTFCPATH.'assets/scss/lib/sweetalert/facebook.scss',
        'autoprefixer' => ['browsers' => $config['autoprefixer_browsers']],
        'cssmin' => [],
    ],

    // php cli.php assets compile sweetalert-google sweetalert-google-min

    [
        'name' => 'sweetalert-google',
        'type' => 'scss',
        'destination' => DEFAULTFCPATH.'assets/css/lib/sweetalert/google.css',
        'source' => DEFAULTFCPATH.'assets/scss/lib/sweetalert/google.scss',
        'autoprefixer' => ['browsers' => $config['autoprefixer_browsers']],
    ],
    [
        'name' => 'sweetalert-google-min',
        'type' => 'scss',
        'destination' => DEFAULTFCPATH.'assets/css/lib/sweetalert/google.min.css',
        'source' => DEFAULTFCPATH.'assets/scss/lib/sweetalert/google.scss',
        'autoprefixer' => ['browsers' => $config['autoprefixer_browsers']],
        'cssmin' => [],
    ],

    // php cli.php assets compile sweetalert-twitter sweetalert-twitter-min

    [
        'name' => 'sweetalert-twitter',
        'type' => 'scss',
        'destination' => DEFAULTFCPATH.'assets/css/lib/sweetalert/twitter.css',
        'source' => DEFAULTFCPATH.'assets/scss/lib/sweetalert/twitter.scss',
        'autoprefixer' => ['browsers' => $config['autoprefixer_browsers']],
    ],
    [
        'name' => 'sweetalert-twitter-min',
        'type' => 'scss',
        'destination' => DEFAULTFCPATH.'assets/css/lib/sweetalert/twitter.min.css',
        'source' => DEFAULTFCPATH.'assets/scss/lib/sweetalert/twitter.scss',
        'autoprefixer' => ['browsers' => $config['autoprefixer_browsers']],
        'cssmin' => [],
    ],

    // LESS --------------------------------------------------------------------

    // php cli.php less compile editor editor-min

    [
        'name' => 'editor',
        'type' => 'less',
        'source' => DEFAULTFCPATH.'assets/less/lib/editor/index.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/editor/editor.css',
        'autoprefixer' => ['browsers' => $config['autoprefixer_browsers']],
    ],
    [
        'name' => 'editor-min',
        'type' => 'less',
        'source' => DEFAULTFCPATH.'assets/less/lib/editor/index.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/editor/editor.min.css',
        'autoprefixer' => ['browsers' => $config['autoprefixer_browsers']],
        'cssmin' => [],
    ],

    // php cli.php less compile font-awesome-5 font-awesome-5-min

    [
        'name' => 'font-awesome-5',
        'type' => 'less',
        'source' => DEFAULTFCPATH.'assets/less/lib/font-awesome-5/fontawesome-all.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/font-awesome-5/fontawesome-all.css',
        'autoprefixer' => ['browsers' => $config['autoprefixer_browsers']],
    ],
    [
        'name' => 'font-awesome-5-min',
        'type' => 'less',
        'source' => DEFAULTFCPATH.'assets/less/lib/font-awesome-5/fontawesome-all.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/font-awesome-5/fontawesome-all.min.css',
        'autoprefixer' => ['browsers' => $config['autoprefixer_browsers']],
        'cssmin' => [],
    ],

    // php cli.php less compile material-icons material-icons-min

    [
        'name' => 'material-icons',
        'type' => 'less',
        'source' => DEFAULTFCPATH.'assets/less/lib/material-icons/material-icons.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/material-icons/material-icons.css',
        'autoprefixer' => ['browsers' => $config['autoprefixer_browsers']],
    ],
    [
        'name' => 'material-icons-min',
        'type' => 'less',
        'source' => DEFAULTFCPATH.'assets/less/lib/material-icons/material-icons.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/material-icons/material-icons.min.css',
        'autoprefixer' => ['browsers' => $config['autoprefixer_browsers']],
        'cssmin' => [],
    ],

    // php cli.php less compile datatables-semantic-ui datatables-semantic-ui-min

    [
        'name' => 'datatables-semantic-ui',
        'type' => 'less',
        'source' => DEFAULTFCPATH.'assets/less/lib/dataTables/dataTables.semanticui.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/dataTables/dataTables.semanticui.css',
        'autoprefixer' => ['browsers' => $config['autoprefixer_browsers']],
    ],
    [
        'name' => 'datatables-semantic-ui-min',
        'type' => 'less',
        'source' => DEFAULTFCPATH.'assets/less/lib/dataTables/dataTables.semanticui.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/dataTables/dataTables.semanticui.min.css',
        'autoprefixer' => ['browsers' => $config['autoprefixer_browsers']],
        'cssmin' => [],
    ],

    // php cli.php less compile datatables-responsive-semantic-ui datatables-responsive-semantic-ui-min

    [
        'name' => 'datatables-responsive-semantic-ui',
        'type' => 'less',
        'source' => DEFAULTFCPATH.'assets/less/lib/dataTables/responsive.semanticui.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/dataTables/responsive.semanticui.css',
        'autoprefixer' => ['browsers' => $config['autoprefixer_browsers']],
    ],
    [
        'name' => 'datatables-responsive-semantic-ui-min',
        'type' => 'less',
        'source' => DEFAULTFCPATH.'assets/less/lib/dataTables/responsive.semanticui.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/dataTables/responsive.semanticui.min.css',
        'autoprefixer' => ['browsers' => $config['autoprefixer_browsers']],
        'cssmin' => [],
    ],

    // php cli.php less compile datatables-select-semantic-ui datatables-select-semantic-ui-min

    [
        'name' => 'datatables-select-semantic-ui',
        'type' => 'less',
        'source' => DEFAULTFCPATH.'assets/less/lib/dataTables/select.semanticui.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/dataTables/select.semanticui.css',
        'autoprefixer' => ['browsers' => $config['autoprefixer_browsers']],
    ],
    [
        'name' => 'datatables-select-semantic-ui-min',
        'type' => 'less',
        'source' => DEFAULTFCPATH.'assets/less/lib/dataTables/select.semanticui.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/dataTables/select.semanticui.min.css',
        'autoprefixer' => ['browsers' => $config['autoprefixer_browsers']],
        'cssmin' => [],
    ],

    // php cli.php less compile semantic-ui semantic-ui-min

    [
        'name' => 'semantic-ui',
        'type' => 'less',
        'source' => DEFAULTFCPATH.'assets/less/lib/semantic/semantic.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/semantic/semantic.css',
        'autoprefixer' => ['browsers' => $config['autoprefixer_browsers']],
    ],
    [
        'name' => 'semantic-ui-min',
        'type' => 'less',
        'source' => DEFAULTFCPATH.'assets/less/lib/semantic/semantic.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/semantic/semantic.min.css',
        'autoprefixer' => ['browsers' => $config['autoprefixer_browsers']],
        'cssmin' => [],
    ],

    // php cli.php less compile semantic-ui-custom semantic-ui-custom-min

    [
        'name' => 'semantic-ui-custom',
        'type' => 'less',
        'source' => DEFAULTFCPATH.'assets/less/lib/semantic-custom/semantic-custom.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/semantic-custom/semantic-custom.css',
        'autoprefixer' => ['browsers' => $config['autoprefixer_browsers']],
    ],
    [
        'name' => 'semantic-ui-custom-min',
        'type' => 'less',
        'source' => DEFAULTFCPATH.'assets/less/lib/semantic-custom/semantic-custom.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/semantic-custom/semantic-custom.min.css',
        'autoprefixer' => ['browsers' => $config['autoprefixer_browsers']],
        'cssmin' => [],
    ],

    // php cli.php less compile admin-default-18-min admin-default-18-login-min admin-default-18-error-min

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

    // php cli.php less compile admin-default-17-min admin-default-17-login-min admin-default-17-error-min

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

    // php cli.php less compile admin-default-min admin-default-login-min admin-default-error-min

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

    // php cli.php less compile admin-default-15-min admin-default-15-login-min admin-default-15-error-min

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

    // php cli.php less compile admin-default-14-min admin-default-14-login-min admin-default-14-error-min

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

    // php cli.php less compile front-semantic-ui-default-min

    [
        'name' => 'front-semantic-ui-default-min',
        'type' => 'less',
        'source' => DEFAULTFCPATH.'themes/front_semantic_ui_default/less/index.less',
        'destination' => DEFAULTFCPATH.'themes/front_semantic_ui_default/css/front.min.css',
        'autoprefixer' => ['browsers' => $config['autoprefixer_browsers']],
        'cssmin' => [],
    ],

    // php cli.php less compile front-semantic-ui-amazon-min

    [
        'name' => 'front-semantic-ui-amazon-min',
        'type' => 'less',
        'source' => DEFAULTFCPATH.'themes/front_semantic_ui_amazon/less/index.less',
        'destination' => DEFAULTFCPATH.'themes/front_semantic_ui_amazon/css/front.min.css',
        'autoprefixer' => ['browsers' => $config['autoprefixer_browsers']],
        'cssmin' => [],
    ],

    // php cli.php less compile front-semantic-ui-basic-min

    [
        'name' => 'front-semantic-ui-basic-min',
        'type' => 'less',
        'source' => DEFAULTFCPATH.'themes/front_semantic_ui_basic/less/index.less',
        'destination' => DEFAULTFCPATH.'themes/front_semantic_ui_basic/css/front.min.css',
        'autoprefixer' => ['browsers' => $config['autoprefixer_browsers']],
        'cssmin' => [],
    ],

    // php cli.php less compile front-semantic-ui-chubby-min

    [
        'name' => 'front-semantic-ui-chubby-min',
        'type' => 'less',
        'source' => DEFAULTFCPATH.'themes/front_semantic_ui_chubby/less/index.less',
        'destination' => DEFAULTFCPATH.'themes/front_semantic_ui_chubby/css/front.min.css',
        'autoprefixer' => ['browsers' => $config['autoprefixer_browsers']],
        'cssmin' => [],
    ],

    // php cli.php less compile front-semantic-ui-classic-min

    [
        'name' => 'front-semantic-ui-classic-min',
        'type' => 'less',
        'source' => DEFAULTFCPATH.'themes/front_semantic_ui_classic/less/index.less',
        'destination' => DEFAULTFCPATH.'themes/front_semantic_ui_classic/css/front.min.css',
        'autoprefixer' => ['browsers' => $config['autoprefixer_browsers']],
        'cssmin' => [],
    ],

    // php cli.php less compile front-semantic-ui-flat-min

    [
        'name' => 'front-semantic-ui-flat-min',
        'type' => 'less',
        'source' => DEFAULTFCPATH.'themes/front_semantic_ui_flat/less/index.less',
        'destination' => DEFAULTFCPATH.'themes/front_semantic_ui_flat/css/front.min.css',
        'autoprefixer' => ['browsers' => $config['autoprefixer_browsers']],
        'cssmin' => [],
    ],

    // php cli.php less compile front-semantic-ui-github-min

    [
        'name' => 'front-semantic-ui-github-min',
        'type' => 'less',
        'source' => DEFAULTFCPATH.'themes/front_semantic_ui_github/less/index.less',
        'destination' => DEFAULTFCPATH.'themes/front_semantic_ui_github/css/front.min.css',
        'autoprefixer' => ['browsers' => $config['autoprefixer_browsers']],
        'cssmin' => [],
    ],

    // php cli.php less compile front-semantic-ui-material-min

    [
        'name' => 'front-semantic-ui-material-min',
        'type' => 'less',
        'source' => DEFAULTFCPATH.'themes/front_semantic_ui_material/less/index.less',
        'destination' => DEFAULTFCPATH.'themes/front_semantic_ui_material/css/front.min.css',
        'autoprefixer' => ['browsers' => $config['autoprefixer_browsers']],
        'cssmin' => [],
    ],

    // php cli.php less compile front-default-min

    [
        'name' => 'front-default-min',
        'type' => 'less',
        'source' => DEFAULTFCPATH.'themes/front_default/less/index.less',
        'destination' => DEFAULTFCPATH.'themes/front_default/css/front.min.css',
        'autoprefixer' => ['browsers' => $config['autoprefixer_browsers']],
        'cssmin' => [],
    ],

    // -------------------------------------------------------------------------
];
