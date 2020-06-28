<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2013-2020
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

/**
 * How to recompile these LESS-sources:
 *
 * Open a terminal at the folder platform/www/ and write the following command:
 *
 * php cli.php less compile
 *
 * If you want to compile only chosen sources, then write a command like this:
 *
 * php cli.php less compile bootstrap-3 bootstrap-3-min
 *
 * For all of the LESS parser options ('compress', etc.) see https://github.com/oyejorge/less.php
 */

$config['less_compile'] = array(

    // php cli.php less compile editor editor-min

    array(
        'name' => 'editor',
        'source' => DEFAULTFCPATH.'assets/less/lib/editor/index.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/editor/editor.css',
        'relativeUrls' => false,
        'autoprefixer' => array('browsers' => array('> 1%', 'last 2 versions', 'Firefox ESR', 'Safari >= 7', 'iOS >= 7', 'ie >= 10', 'Edge >= 12', 'Android >= 4')),
    ),
    array(
        'name' => 'editor-min',
        'source' => DEFAULTFCPATH.'assets/less/lib/editor/index.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/editor/editor.min.css',
        'relativeUrls' => false,
        'autoprefixer' => array('browsers' => array('> 1%', 'last 2 versions', 'Firefox ESR', 'Safari >= 7', 'iOS >= 7', 'ie >= 10', 'Edge >= 12', 'Android >= 4')),
        'cssmin' => array('implementation' => 'cssnano'),
    ),

    // php cli.php less compile font-awesome-5 font-awesome-5-min

    array(
        'name' => 'font-awesome-5',
        'source' => DEFAULTFCPATH.'assets/less/lib/font-awesome-5/fontawesome-all.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/font-awesome-5/fontawesome-all.css',
        'compress' => false
    ),
    array(
        'name' => 'font-awesome-5-min',
        'source' => DEFAULTFCPATH.'assets/less/lib/font-awesome-5/fontawesome-all.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/font-awesome-5/fontawesome-all.min.css',
        'compress' => true
    ),

    // php cli.php less compile material-icons material-icons-min

    array(
        'name' => 'material-icons',
        'source' => DEFAULTFCPATH.'assets/less/lib/material-icons/material-icons.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/material-icons/material-icons.css',
        'compress' => false
    ),
    array(
        'name' => 'material-icons-min',
        'source' => DEFAULTFCPATH.'assets/less/lib/material-icons/material-icons.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/material-icons/material-icons.min.css',
        'compress' => true
    ),

    // php cli.php less compile datatables-semantic-ui datatables-semantic-ui-min

    array(
        'name' => 'datatables-semantic-ui',
        'source' => DEFAULTFCPATH.'assets/less/lib/dataTables/dataTables.semanticui.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/dataTables/dataTables.semanticui.css',
        'compress' => false
    ),
    array(
        'name' => 'datatables-semantic-ui-min',
        'source' => DEFAULTFCPATH.'assets/less/lib/dataTables/dataTables.semanticui.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/dataTables/dataTables.semanticui.min.css',
        'compress' => true
    ),

    // php cli.php less compile datatables-responsive-semantic-ui datatables-responsive-semantic-ui-min

    array(
        'name' => 'datatables-responsive-semantic-ui',
        'source' => DEFAULTFCPATH.'assets/less/lib/dataTables/responsive.semanticui.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/dataTables/responsive.semanticui.css',
        'compress' => false
    ),
    array(
        'name' => 'datatables-responsive-semantic-ui-min',
        'source' => DEFAULTFCPATH.'assets/less/lib/dataTables/responsive.semanticui.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/dataTables/responsive.semanticui.min.css',
        'compress' => true
    ),

    // php cli.php less compile datatables-select-semantic-ui datatables-select-semantic-ui-min

    array(
        'name' => 'datatables-select-semantic-ui',
        'source' => DEFAULTFCPATH.'assets/less/lib/dataTables/select.semanticui.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/dataTables/select.semanticui.css',
        'compress' => false
    ),
    array(
        'name' => 'datatables-select-semantic-ui-min',
        'source' => DEFAULTFCPATH.'assets/less/lib/dataTables/select.semanticui.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/dataTables/select.semanticui.min.css',
        'compress' => true
    ),

    // php cli.php less compile semantic-ui semantic-ui-min

    array(
        'name' => 'semantic-ui',
        'source' => DEFAULTFCPATH.'assets/less/lib/semantic/semantic.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/semantic/semantic.css',
        'relativeUrls' => false,
        'autoprefixer' => array('browsers' => array('> 1%', 'last 2 versions', 'Firefox ESR', 'Safari >= 7', 'iOS >= 7', 'ie >= 10', 'Edge >= 12', 'Android >= 4')),
    ),
    array(
        'name' => 'semantic-ui-min',
        'source' => DEFAULTFCPATH.'assets/less/lib/semantic/semantic.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/semantic/semantic.min.css',
        'relativeUrls' => false,
        'autoprefixer' => array('browsers' => array('> 1%', 'last 2 versions', 'Firefox ESR', 'Safari >= 7', 'iOS >= 7', 'ie >= 10', 'Edge >= 12', 'Android >= 4')),
        'cssmin' => array('implementation' => 'cssnano'),
    ),

    // php cli.php less compile semantic-ui-custom semantic-ui-custom-min

    array(
        'name' => 'semantic-ui-custom',
        'source' => DEFAULTFCPATH.'assets/less/lib/semantic-custom/semantic-custom.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/semantic-custom/semantic-custom.css',
        'relativeUrls' => false,
        'autoprefixer' => array('browsers' => array('> 1%', 'last 2 versions', 'Firefox ESR', 'Safari >= 7', 'iOS >= 7', 'ie >= 10', 'Edge >= 12', 'Android >= 4')),
    ),
    array(
        'name' => 'semantic-ui-custom-min',
        'source' => DEFAULTFCPATH.'assets/less/lib/semantic-custom/semantic-custom.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/semantic-custom/semantic-custom.min.css',
        'relativeUrls' => false,
        'autoprefixer' => array('browsers' => array('> 1%', 'last 2 versions', 'Firefox ESR', 'Safari >= 7', 'iOS >= 7', 'ie >= 10', 'Edge >= 12', 'Android >= 4')),
        'cssmin' => array('implementation' => 'cssnano'),
    ),

    // php cli.php less compile admin-default-18-min admin-default-18-login-min admin-default-18-error-min

    array(
        'name' => 'admin-default-18-min',
        'source' => DEFAULTFCPATH.'admin/themes/admin_default_18/less/index.less',
        'destination' => DEFAULTFCPATH.'admin/themes/admin_default_18/css/admin.min.css',
        'relativeUrls' => false,
        'autoprefixer' => array('browsers' => array('> 1%', 'last 2 versions', 'Firefox ESR', 'Safari >= 7', 'iOS >= 7', 'ie >= 10', 'Edge >= 12', 'Android >= 4')),
        'cssmin' => array('implementation' => 'cssnano'),
    ),
    array(
        'name' => 'admin-default-18-login-min',
        'source' => DEFAULTFCPATH.'admin/themes/admin_default_18/less/login.less',
        'destination' => DEFAULTFCPATH.'admin/themes/admin_default_18/css/login.min.css',
        'relativeUrls' => false,
        'autoprefixer' => array('browsers' => array('> 1%', 'last 2 versions', 'Firefox ESR', 'Safari >= 7', 'iOS >= 7', 'ie >= 10', 'Edge >= 12', 'Android >= 4')),
        'cssmin' => array('implementation' => 'cssnano'),
    ),
    array(
        'name' => 'admin-default-18-error-min',
        'source' => DEFAULTFCPATH.'admin/themes/admin_default_18/less/error.less',
        'destination' => DEFAULTFCPATH.'admin/themes/admin_default_18/css/error.min.css',
        'relativeUrls' => false,
        'autoprefixer' => array('browsers' => array('> 1%', 'last 2 versions', 'Firefox ESR', 'Safari >= 7', 'iOS >= 7', 'ie >= 10', 'Edge >= 12', 'Android >= 4')),
        'cssmin' => array('implementation' => 'cssnano'),
    ),

    // php cli.php less compile admin-default-17-min admin-default-17-login-min admin-default-17-error-min

    array(
        'name' => 'admin-default-17-min',
        'source' => DEFAULTFCPATH.'admin/themes/admin_default_17/less/index.less',
        'destination' => DEFAULTFCPATH.'admin/themes/admin_default_17/css/admin.min.css',
        'relativeUrls' => false,
        'autoprefixer' => array('browsers' => array('> 1%', 'last 2 versions', 'Firefox ESR', 'Safari >= 7', 'iOS >= 7', 'ie >= 10', 'Edge >= 12', 'Android >= 4')),
        'cssmin' => array('implementation' => 'cssnano'),
    ),
    array(
        'name' => 'admin-default-17-login-min',
        'source' => DEFAULTFCPATH.'admin/themes/admin_default_17/less/login.less',
        'destination' => DEFAULTFCPATH.'admin/themes/admin_default_17/css/login.min.css',
        'relativeUrls' => false,
        'autoprefixer' => array('browsers' => array('> 1%', 'last 2 versions', 'Firefox ESR', 'Safari >= 7', 'iOS >= 7', 'ie >= 10', 'Edge >= 12', 'Android >= 4')),
        'cssmin' => array('implementation' => 'cssnano'),
    ),
    array(
        'name' => 'admin-default-17-error-min',
        'source' => DEFAULTFCPATH.'admin/themes/admin_default_17/less/error.less',
        'destination' => DEFAULTFCPATH.'admin/themes/admin_default_17/css/error.min.css',
        'relativeUrls' => false,
        'autoprefixer' => array('browsers' => array('> 1%', 'last 2 versions', 'Firefox ESR', 'Safari >= 7', 'iOS >= 7', 'ie >= 10', 'Edge >= 12', 'Android >= 4')),
        'cssmin' => array('implementation' => 'cssnano'),
    ),

    // php cli.php less compile admin-default-min admin-default-login-min admin-default-error-min

    array(
        'name' => 'admin-default-min',
        'source' => DEFAULTFCPATH.'admin/themes/admin_default/less/index.less',
        'destination' => DEFAULTFCPATH.'admin/themes/admin_default/css/admin.min.css',
        'relativeUrls' => false,
        'autoprefixer' => array('browsers' => array('> 1%', 'last 2 versions', 'Firefox ESR', 'Safari >= 7', 'iOS >= 7', 'ie >= 10', 'Edge >= 12', 'Android >= 4')),
        'cssmin' => array('implementation' => 'cssnano'),
    ),
    array(
        'name' => 'admin-default-login-min',
        'source' => DEFAULTFCPATH.'admin/themes/admin_default/less/login.less',
        'destination' => DEFAULTFCPATH.'admin/themes/admin_default/css/login.min.css',
        'relativeUrls' => false,
        'autoprefixer' => array('browsers' => array('> 1%', 'last 2 versions', 'Firefox ESR', 'Safari >= 7', 'iOS >= 7', 'ie >= 10', 'Edge >= 12', 'Android >= 4')),
        'cssmin' => array('implementation' => 'cssnano'),
    ),
    array(
        'name' => 'admin-default-error-min',
        'source' => DEFAULTFCPATH.'admin/themes/admin_default/less/error.less',
        'destination' => DEFAULTFCPATH.'admin/themes/admin_default/css/error.min.css',
        'relativeUrls' => false,
        'autoprefixer' => array('browsers' => array('> 1%', 'last 2 versions', 'Firefox ESR', 'Safari >= 7', 'iOS >= 7', 'ie >= 10', 'Edge >= 12', 'Android >= 4')),
        'cssmin' => array('implementation' => 'cssnano'),
    ),

    // php cli.php less compile admin-default-15-min admin-default-15-login-min admin-default-15-error-min

    array(
        'name' => 'admin-default-15-min',
        'source' => DEFAULTFCPATH.'admin/themes/admin_default_15/less/index.less',
        'destination' => DEFAULTFCPATH.'admin/themes/admin_default_15/css/admin.min.css',
        'relativeUrls' => false,
        'autoprefixer' => array('browsers' => array('> 1%', 'last 2 versions', 'Firefox ESR', 'Safari >= 7', 'iOS >= 7', 'ie >= 10', 'Edge >= 12', 'Android >= 4')),
        'cssmin' => array('implementation' => 'cssnano'),
    ),
    array(
        'name' => 'admin-default-15-login-min',
        'source' => DEFAULTFCPATH.'admin/themes/admin_default_15/less/login.less',
        'destination' => DEFAULTFCPATH.'admin/themes/admin_default_15/css/login.min.css',
        'relativeUrls' => false,
        'autoprefixer' => array('browsers' => array('> 1%', 'last 2 versions', 'Firefox ESR', 'Safari >= 7', 'iOS >= 7', 'ie >= 10', 'Edge >= 12', 'Android >= 4')),
        'cssmin' => array('implementation' => 'cssnano'),
    ),
    array(
        'name' => 'admin-default-15-error-min',
        'source' => DEFAULTFCPATH.'admin/themes/admin_default_15/less/error.less',
        'destination' => DEFAULTFCPATH.'admin/themes/admin_default_15/css/error.min.css',
        'relativeUrls' => false,
        'autoprefixer' => array('browsers' => array('> 1%', 'last 2 versions', 'Firefox ESR', 'Safari >= 7', 'iOS >= 7', 'ie >= 10', 'Edge >= 12', 'Android >= 4')),
        'cssmin' => array('implementation' => 'cssnano'),
    ),

    // php cli.php less compile admin-default-14-min admin-default-14-login-min admin-default-14-error-min

    array(
        'name' => 'admin-default-14-min',
        'source' => DEFAULTFCPATH.'admin/themes/admin_default_14/less/index.less',
        'destination' => DEFAULTFCPATH.'admin/themes/admin_default_14/css/admin.min.css',
        'relativeUrls' => false,
        'autoprefixer' => array('browsers' => array('> 1%', 'last 2 versions', 'Firefox ESR', 'Safari >= 7', 'iOS >= 7', 'ie >= 10', 'Edge >= 12', 'Android >= 4')),
        'cssmin' => array('implementation' => 'cssnano'),
    ),
    array(
        'name' => 'admin-default-14-login-min',
        'source' => DEFAULTFCPATH.'admin/themes/admin_default_14/less/login.less',
        'destination' => DEFAULTFCPATH.'admin/themes/admin_default_14/css/login.min.css',
        'relativeUrls' => false,
        'autoprefixer' => array('browsers' => array('> 1%', 'last 2 versions', 'Firefox ESR', 'Safari >= 7', 'iOS >= 7', 'ie >= 10', 'Edge >= 12', 'Android >= 4')),
        'cssmin' => array('implementation' => 'cssnano'),
    ),
    array(
        'name' => 'admin-default-14-error-min',
        'source' => DEFAULTFCPATH.'admin/themes/admin_default_14/less/error.less',
        'destination' => DEFAULTFCPATH.'admin/themes/admin_default_14/css/error.min.css',
        'relativeUrls' => false,
        'autoprefixer' => array('browsers' => array('> 1%', 'last 2 versions', 'Firefox ESR', 'Safari >= 7', 'iOS >= 7', 'ie >= 10', 'Edge >= 12', 'Android >= 4')),
        'cssmin' => array('implementation' => 'cssnano'),
    ),

    // php cli.php less compile front-semantic-ui-default-min

    array(
        'name' => 'front-semantic-ui-default-min',
        'source' => DEFAULTFCPATH.'themes/front_semantic_ui_default/less/index.less',
        'destination' => DEFAULTFCPATH.'themes/front_semantic_ui_default/css/front.min.css',
        'relativeUrls' => false,
        'autoprefixer' => array('browsers' => array('> 1%', 'last 2 versions', 'Firefox ESR', 'Safari >= 7', 'iOS >= 7', 'ie >= 10', 'Edge >= 12', 'Android >= 4')),
        'cssmin' => array('implementation' => 'cssnano'),
    ),

    // php cli.php less compile front-semantic-ui-amazon-min

    array(
        'name' => 'front-semantic-ui-amazon-min',
        'source' => DEFAULTFCPATH.'themes/front_semantic_ui_amazon/less/index.less',
        'destination' => DEFAULTFCPATH.'themes/front_semantic_ui_amazon/css/front.min.css',
        'relativeUrls' => false,
        'autoprefixer' => array('browsers' => array('> 1%', 'last 2 versions', 'Firefox ESR', 'Safari >= 7', 'iOS >= 7', 'ie >= 10', 'Edge >= 12', 'Android >= 4')),
        'cssmin' => array('implementation' => 'cssnano'),
    ),

    // php cli.php less compile front-semantic-ui-basic-min

    array(
        'name' => 'front-semantic-ui-basic-min',
        'source' => DEFAULTFCPATH.'themes/front_semantic_ui_basic/less/index.less',
        'destination' => DEFAULTFCPATH.'themes/front_semantic_ui_basic/css/front.min.css',
        'relativeUrls' => false,
        'autoprefixer' => array('browsers' => array('> 1%', 'last 2 versions', 'Firefox ESR', 'Safari >= 7', 'iOS >= 7', 'ie >= 10', 'Edge >= 12', 'Android >= 4')),
        'cssmin' => array('implementation' => 'cssnano'),
    ),

    // php cli.php less compile front-semantic-ui-chubby-min

    array(
        'name' => 'front-semantic-ui-chubby-min',
        'source' => DEFAULTFCPATH.'themes/front_semantic_ui_chubby/less/index.less',
        'destination' => DEFAULTFCPATH.'themes/front_semantic_ui_chubby/css/front.min.css',
        'relativeUrls' => false,
        'autoprefixer' => array('browsers' => array('> 1%', 'last 2 versions', 'Firefox ESR', 'Safari >= 7', 'iOS >= 7', 'ie >= 10', 'Edge >= 12', 'Android >= 4')),
        'cssmin' => array('implementation' => 'cssnano'),
    ),

    // php cli.php less compile front-semantic-ui-classic-min

    array(
        'name' => 'front-semantic-ui-classic-min',
        'source' => DEFAULTFCPATH.'themes/front_semantic_ui_classic/less/index.less',
        'destination' => DEFAULTFCPATH.'themes/front_semantic_ui_classic/css/front.min.css',
        'relativeUrls' => false,
        'autoprefixer' => array('browsers' => array('> 1%', 'last 2 versions', 'Firefox ESR', 'Safari >= 7', 'iOS >= 7', 'ie >= 10', 'Edge >= 12', 'Android >= 4')),
        'cssmin' => array('implementation' => 'cssnano'),
    ),

    // php cli.php less compile front-semantic-ui-flat-min

    array(
        'name' => 'front-semantic-ui-flat-min',
        'source' => DEFAULTFCPATH.'themes/front_semantic_ui_flat/less/index.less',
        'destination' => DEFAULTFCPATH.'themes/front_semantic_ui_flat/css/front.min.css',
        'relativeUrls' => false,
        'autoprefixer' => array('browsers' => array('> 1%', 'last 2 versions', 'Firefox ESR', 'Safari >= 7', 'iOS >= 7', 'ie >= 10', 'Edge >= 12', 'Android >= 4')),
        'cssmin' => array('implementation' => 'cssnano'),
    ),

    // php cli.php less compile front-semantic-ui-github-min

    array(
        'name' => 'front-semantic-ui-github-min',
        'source' => DEFAULTFCPATH.'themes/front_semantic_ui_github/less/index.less',
        'destination' => DEFAULTFCPATH.'themes/front_semantic_ui_github/css/front.min.css',
        'relativeUrls' => false,
        'autoprefixer' => array('browsers' => array('> 1%', 'last 2 versions', 'Firefox ESR', 'Safari >= 7', 'iOS >= 7', 'ie >= 10', 'Edge >= 12', 'Android >= 4')),
        'cssmin' => array('implementation' => 'cssnano'),
    ),

    // php cli.php less compile front-semantic-ui-material-min

    array(
        'name' => 'front-semantic-ui-material-min',
        'source' => DEFAULTFCPATH.'themes/front_semantic_ui_material/less/index.less',
        'destination' => DEFAULTFCPATH.'themes/front_semantic_ui_material/css/front.min.css',
        'relativeUrls' => false,
        'autoprefixer' => array('browsers' => array('> 1%', 'last 2 versions', 'Firefox ESR', 'Safari >= 7', 'iOS >= 7', 'ie >= 10', 'Edge >= 12', 'Android >= 4')),
        'cssmin' => array('implementation' => 'cssnano'),
    ),

    // php cli.php less compile front-default-min

    array(
        'name' => 'front-default-min',
        'source' => DEFAULTFCPATH.'themes/front_default/less/index.less',
        'destination' => DEFAULTFCPATH.'themes/front_default/css/front.min.css',
        'relativeUrls' => false,
        'autoprefixer' => array('browsers' => array('> 1%', 'last 2 versions', 'Firefox ESR', 'Safari >= 7', 'iOS >= 7', 'ie >= 10', 'Edge >= 12', 'Android >= 4')),
        'cssmin' => array('implementation' => 'cssnano'),
    ),

);
