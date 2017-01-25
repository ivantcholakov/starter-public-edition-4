<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2013-2016
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
        'implementation' => 'less.js',
        'autoprefixer' => array('browsers' => array('> 1%', 'last 2 versions', 'Firefox ESR', 'Safari >= 7', 'iOS >= 7', 'ie >= 11', 'Edge >= 12', 'Android >= 4')),
    ),
    array(
        'name' => 'editor-min',
        'source' => DEFAULTFCPATH.'assets/less/lib/editor/index.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/editor/editor.min.css',
        'relativeUrls' => false,
        'implementation' => 'less.js',
        'autoprefixer' => array('browsers' => array('> 1%', 'last 2 versions', 'Firefox ESR', 'Safari >= 7', 'iOS >= 7', 'ie >= 11', 'Edge >= 12', 'Android >= 4')),
        'cssmin' => array('implementation' => 'minifycss'),
    ),

    // php cli.php less compile font-awesome-4 font-awesome-4-min

    array(
        'name' => 'font-awesome-4',
        'source' => DEFAULTFCPATH.'assets/less/lib/font-awesome-4/font-awesome.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/font-awesome-4/font-awesome.css',
        'compress' => false
    ),
    array(
        'name' => 'font-awesome-4-min',
        'source' => DEFAULTFCPATH.'assets/less/lib/font-awesome-4/font-awesome.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/font-awesome-4/font-awesome.min.css',
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

    // php cli.php less compile slick slick-min slick-font slick-font-min slick-theme slick-theme-min

    array(
        'name' => 'slick',
        'source' => DEFAULTFCPATH.'assets/less/lib/slick/slick.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/slick/slick.css',
        'relativeUrls' => false,
        'compress' => false
    ),
    array(
        'name' => 'slick-min',
        'source' => DEFAULTFCPATH.'assets/less/lib/slick/slick.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/slick/slick.min.css',
        'relativeUrls' => false,
        'compress' => true
    ),

    array(
        'name' => 'slick-font',
        'source' => DEFAULTFCPATH.'assets/less/lib/slick/slick-font.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/slick/slick-font.css',
        'relativeUrls' => false,
        'compress' => false
    ),
    array(
        'name' => 'slick-font-min',
        'source' => DEFAULTFCPATH.'assets/less/lib/slick/slick-font.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/slick/slick-font.min.css',
        'relativeUrls' => false,
        'compress' => true
    ),

    array(
        'name' => 'slick-theme',
        'source' => DEFAULTFCPATH.'assets/less/lib/slick/slick-theme.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/slick/slick-theme.css',
        'relativeUrls' => false,
        'compress' => false
    ),
    array(
        'name' => 'slick-theme-min',
        'source' => DEFAULTFCPATH.'assets/less/lib/slick/slick-theme.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/slick/slick-theme.min.css',
        'relativeUrls' => false,
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

    // php cli.php less compile semantic-ui semantic-ui-min

    array(
        'name' => 'semantic-ui',
        'source' => DEFAULTFCPATH.'assets/less/lib/semantic/semantic.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/semantic/semantic.css',
        'relativeUrls' => false,
        'implementation' => 'less.js',
        'autoprefixer' => array('browsers' => array('> 1%', 'last 2 versions', 'Firefox ESR', 'Safari >= 7', 'iOS >= 7', 'ie >= 11', 'Edge >= 12', 'Android >= 4')),
    ),
    array(
        'name' => 'semantic-ui-min',
        'source' => DEFAULTFCPATH.'assets/less/lib/semantic/semantic.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/semantic/semantic.min.css',
        'relativeUrls' => false,
        'implementation' => 'less.js',
        'autoprefixer' => array('browsers' => array('> 1%', 'last 2 versions', 'Firefox ESR', 'Safari >= 7', 'iOS >= 7', 'ie >= 11', 'Edge >= 12', 'Android >= 4')),
        'cssmin' => array('implementation' => 'minifycss'),
    ),

    // php cli.php less compile semantic-ui-custom semantic-ui-custom-min

    array(
        'name' => 'semantic-ui-custom',
        'source' => DEFAULTFCPATH.'assets/less/lib/semantic-custom/semantic-custom.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/semantic-custom/semantic-custom.css',
        'relativeUrls' => false,
        'implementation' => 'less.js',
        'autoprefixer' => array('browsers' => array('> 1%', 'last 2 versions', 'Firefox ESR', 'Safari >= 7', 'iOS >= 7', 'ie >= 11', 'Edge >= 12', 'Android >= 4')),
    ),
    array(
        'name' => 'semantic-ui-custom-min',
        'source' => DEFAULTFCPATH.'assets/less/lib/semantic-custom/semantic-custom.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/semantic-custom/semantic-custom.min.css',
        'relativeUrls' => false,
        'implementation' => 'less.js',
        'autoprefixer' => array('browsers' => array('> 1%', 'last 2 versions', 'Firefox ESR', 'Safari >= 7', 'iOS >= 7', 'ie >= 11', 'Edge >= 12', 'Android >= 4')),
        'cssmin' => array('implementation' => 'minifycss'),
    ),

    // php cli.php less compile admin-default-min admin-default-login-min admin-default-error-min

    array(
        'name' => 'admin-default-min',
        'source' => DEFAULTFCPATH.'admin/themes/admin_default/less/index.less',
        'destination' => DEFAULTFCPATH.'admin/themes/admin_default/css/admin.min.css',
        'relativeUrls' => false,
        'implementation' => 'less.js',
        'autoprefixer' => array('browsers' => array('> 1%', 'last 2 versions', 'Firefox ESR', 'Safari >= 7', 'iOS >= 7', 'ie >= 11', 'Edge >= 12', 'Android >= 4')),
        'cssmin' => array('implementation' => 'minifycss'),
    ),
    array(
        'name' => 'admin-default-login-min',
        'source' => DEFAULTFCPATH.'admin/themes/admin_default/less/login.less',
        'destination' => DEFAULTFCPATH.'admin/themes/admin_default/css/login.min.css',
        'relativeUrls' => false,
        'implementation' => 'less.js',
        'autoprefixer' => array('browsers' => array('> 1%', 'last 2 versions', 'Firefox ESR', 'Safari >= 7', 'iOS >= 7', 'ie >= 11', 'Edge >= 12', 'Android >= 4')),
        'cssmin' => array('implementation' => 'minifycss'),
    ),
    array(
        'name' => 'admin-default-error-min',
        'source' => DEFAULTFCPATH.'admin/themes/admin_default/less/error.less',
        'destination' => DEFAULTFCPATH.'admin/themes/admin_default/css/error.min.css',
        'relativeUrls' => false,
        'implementation' => 'less.js',
        'autoprefixer' => array('browsers' => array('> 1%', 'last 2 versions', 'Firefox ESR', 'Safari >= 7', 'iOS >= 7', 'ie >= 11', 'Edge >= 12', 'Android >= 4')),
        'cssmin' => array('implementation' => 'minifycss'),
    ),

    // php cli.php less compile front-semantic-ui-default-min

    array(
        'name' => 'front-semantic-ui-default-min',
        'source' => DEFAULTFCPATH.'themes/front_semantic_ui_default/less/index.less',
        'destination' => DEFAULTFCPATH.'themes/front_semantic_ui_default/css/front.min.css',
        'relativeUrls' => false,
        'implementation' => 'less.js',
        'autoprefixer' => array('browsers' => array('> 1%', 'last 2 versions', 'Firefox ESR', 'Safari >= 7', 'iOS >= 7', 'ie >= 11', 'Edge >= 12', 'Android >= 4')),
        'cssmin' => array('implementation' => 'minifycss'),
    ),

    // php cli.php less compile front-semantic-ui-amazon-min

    array(
        'name' => 'front-semantic-ui-amazon-min',
        'source' => DEFAULTFCPATH.'themes/front_semantic_ui_amazon/less/index.less',
        'destination' => DEFAULTFCPATH.'themes/front_semantic_ui_amazon/css/front.min.css',
        'relativeUrls' => false,
        'implementation' => 'less.js',
        'autoprefixer' => array('browsers' => array('> 1%', 'last 2 versions', 'Firefox ESR', 'Safari >= 7', 'iOS >= 7', 'ie >= 11', 'Edge >= 12', 'Android >= 4')),
        'cssmin' => array('implementation' => 'minifycss'),
    ),

    // php cli.php less compile front-semantic-ui-basic-min

    array(
        'name' => 'front-semantic-ui-basic-min',
        'source' => DEFAULTFCPATH.'themes/front_semantic_ui_basic/less/index.less',
        'destination' => DEFAULTFCPATH.'themes/front_semantic_ui_basic/css/front.min.css',
        'relativeUrls' => false,
        'implementation' => 'less.js',
        'autoprefixer' => array('browsers' => array('> 1%', 'last 2 versions', 'Firefox ESR', 'Safari >= 7', 'iOS >= 7', 'ie >= 11', 'Edge >= 12', 'Android >= 4')),
        'cssmin' => array('implementation' => 'minifycss'),
    ),

    // php cli.php less compile front-semantic-ui-chubby-min

    array(
        'name' => 'front-semantic-ui-chubby-min',
        'source' => DEFAULTFCPATH.'themes/front_semantic_ui_chubby/less/index.less',
        'destination' => DEFAULTFCPATH.'themes/front_semantic_ui_chubby/css/front.min.css',
        'relativeUrls' => false,
        'implementation' => 'less.js',
        'autoprefixer' => array('browsers' => array('> 1%', 'last 2 versions', 'Firefox ESR', 'Safari >= 7', 'iOS >= 7', 'ie >= 11', 'Edge >= 12', 'Android >= 4')),
        'cssmin' => array('implementation' => 'minifycss'),
    ),

    // php cli.php less compile front-semantic-ui-classic-min

    array(
        'name' => 'front-semantic-ui-classic-min',
        'source' => DEFAULTFCPATH.'themes/front_semantic_ui_classic/less/index.less',
        'destination' => DEFAULTFCPATH.'themes/front_semantic_ui_classic/css/front.min.css',
        'relativeUrls' => false,
        'implementation' => 'less.js',
        'autoprefixer' => array('browsers' => array('> 1%', 'last 2 versions', 'Firefox ESR', 'Safari >= 7', 'iOS >= 7', 'ie >= 11', 'Edge >= 12', 'Android >= 4')),
        'cssmin' => array('implementation' => 'minifycss'),
    ),

    // php cli.php less compile front-semantic-ui-flat-min

    array(
        'name' => 'front-semantic-ui-flat-min',
        'source' => DEFAULTFCPATH.'themes/front_semantic_ui_flat/less/index.less',
        'destination' => DEFAULTFCPATH.'themes/front_semantic_ui_flat/css/front.min.css',
        'relativeUrls' => false,
        'implementation' => 'less.js',
        'autoprefixer' => array('browsers' => array('> 1%', 'last 2 versions', 'Firefox ESR', 'Safari >= 7', 'iOS >= 7', 'ie >= 11', 'Edge >= 12', 'Android >= 4')),
        'cssmin' => array('implementation' => 'minifycss'),
    ),

    // php cli.php less compile front-semantic-ui-github-min

    array(
        'name' => 'front-semantic-ui-github-min',
        'source' => DEFAULTFCPATH.'themes/front_semantic_ui_github/less/index.less',
        'destination' => DEFAULTFCPATH.'themes/front_semantic_ui_github/css/front.min.css',
        'relativeUrls' => false,
        'implementation' => 'less.js',
        'autoprefixer' => array('browsers' => array('> 1%', 'last 2 versions', 'Firefox ESR', 'Safari >= 7', 'iOS >= 7', 'ie >= 11', 'Edge >= 12', 'Android >= 4')),
        'cssmin' => array('implementation' => 'minifycss'),
    ),

    // php cli.php less compile front-semantic-ui-material-min

    array(
        'name' => 'front-semantic-ui-material-min',
        'source' => DEFAULTFCPATH.'themes/front_semantic_ui_material/less/index.less',
        'destination' => DEFAULTFCPATH.'themes/front_semantic_ui_material/css/front.min.css',
        'relativeUrls' => false,
        'implementation' => 'less.js',
        'autoprefixer' => array('browsers' => array('> 1%', 'last 2 versions', 'Firefox ESR', 'Safari >= 7', 'iOS >= 7', 'ie >= 11', 'Edge >= 12', 'Android >= 4')),
        'cssmin' => array('implementation' => 'minifycss'),
    ),

    // php cli.php less compile front-default-min

    array(
        'name' => 'front-default-min',
        'source' => DEFAULTFCPATH.'themes/front_default/less/index.less',
        'destination' => DEFAULTFCPATH.'themes/front_default/css/front.min.css',
        'relativeUrls' => false,
        'implementation' => 'less.js',
        'autoprefixer' => array('browsers' => array('> 1%', 'last 2 versions', 'Firefox ESR', 'Safari >= 7', 'iOS >= 7', 'ie >= 11', 'Edge >= 12', 'Android >= 4')),
        'cssmin' => array('implementation' => 'minifycss'),
    ),

);
