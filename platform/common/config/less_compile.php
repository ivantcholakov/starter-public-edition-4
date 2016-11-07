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

    // php cli.php less compile font-awesome-4-actions font-awesome-4-actions-min

    array(
        'name' => 'font-awesome-4-actions',
        'source' => DEFAULTFCPATH.'assets/less/lib/font-awesome-4-actions/font-awesome.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/font-awesome-4-actions/font-awesome.css',
        'compress' => false
    ),
    array(
        'name' => 'font-awesome-4-actions-min',
        'source' => DEFAULTFCPATH.'assets/less/lib/font-awesome-4-actions/font-awesome.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/font-awesome-4-actions/font-awesome.min.css',
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

    // php cli.php less compile semantic-ui semantic-ui-min

    array(
        'name' => 'semantic-ui',
        'source' => DEFAULTFCPATH.'assets/less/lib/semantic/semantic.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/semantic/semantic.css',
        'relativeUrls' => false,
        'implementation' => 'less.js',
        'autoprefixer' => array(),
    ),
    array(
        'name' => 'semantic-ui-min',
        'source' => DEFAULTFCPATH.'assets/less/lib/semantic/semantic.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/semantic/semantic.min.css',
        'relativeUrls' => false,
        'implementation' => 'less.js',
        'autoprefixer' => array(),
        'cssmin' => array('implementation' => 'cssnano'),
    ),

    // php cli.php less compile front-semantic-ui-default-min

    array(
        'name' => 'front-semantic-ui-default-min',
        'source' => DEFAULTFCPATH.'themes/front_semantic_ui_default/less/front/index.less',
        'destination' => DEFAULTFCPATH.'themes/front_semantic_ui_default/css/front.min.css',
        'relativeUrls' => false,
        'implementation' => 'less.js',
        'autoprefixer' => array(),
        'cssmin' => array('implementation' => 'cssnano'),
    ),

    // php cli.php less compile front-semantic-ui-amazon-min

    array(
        'name' => 'front-semantic-ui-amazon-min',
        'source' => DEFAULTFCPATH.'themes/front_semantic_ui_amazon/less/front/index.less',
        'destination' => DEFAULTFCPATH.'themes/front_semantic_ui_amazon/css/front.min.css',
        'relativeUrls' => false,
        'implementation' => 'less.js',
        'autoprefixer' => array(),
        'cssmin' => array('implementation' => 'cssnano'),
    ),

    // php cli.php less compile front-semantic-ui-basic-min

    array(
        'name' => 'front-semantic-ui-basic-min',
        'source' => DEFAULTFCPATH.'themes/front_semantic_ui_basic/less/front/index.less',
        'destination' => DEFAULTFCPATH.'themes/front_semantic_ui_basic/css/front.min.css',
        'relativeUrls' => false,
        'implementation' => 'less.js',
        'autoprefixer' => array(),
        'cssmin' => array('implementation' => 'cssnano'),
    ),

    // php cli.php less compile front-semantic-ui-chubby-min

    array(
        'name' => 'front-semantic-ui-chubby-min',
        'source' => DEFAULTFCPATH.'themes/front_semantic_ui_chubby/less/front/index.less',
        'destination' => DEFAULTFCPATH.'themes/front_semantic_ui_chubby/css/front.min.css',
        'relativeUrls' => false,
        'implementation' => 'less.js',
        'autoprefixer' => array(),
        'cssmin' => array('implementation' => 'cssnano'),
    ),

    // php cli.php less compile front-semantic-ui-classic-min

    array(
        'name' => 'front-semantic-ui-classic-min',
        'source' => DEFAULTFCPATH.'themes/front_semantic_ui_classic/less/front/index.less',
        'destination' => DEFAULTFCPATH.'themes/front_semantic_ui_classic/css/front.min.css',
        'relativeUrls' => false,
        'implementation' => 'less.js',
        'autoprefixer' => array(),
        'cssmin' => array('implementation' => 'cssnano'),
    ),

    // php cli.php less compile front-semantic-ui-flat-min

    array(
        'name' => 'front-semantic-ui-flat-min',
        'source' => DEFAULTFCPATH.'themes/front_semantic_ui_flat/less/front/index.less',
        'destination' => DEFAULTFCPATH.'themes/front_semantic_ui_flat/css/front.min.css',
        'relativeUrls' => false,
        'implementation' => 'less.js',
        'autoprefixer' => array(),
        'cssmin' => array('implementation' => 'cssnano'),
    ),

    // php cli.php less compile front-semantic-ui-github-min

    array(
        'name' => 'front-semantic-ui-github-min',
        'source' => DEFAULTFCPATH.'themes/front_semantic_ui_github/less/front/index.less',
        'destination' => DEFAULTFCPATH.'themes/front_semantic_ui_github/css/front.min.css',
        'relativeUrls' => false,
        'implementation' => 'less.js',
        'autoprefixer' => array(),
        'cssmin' => array('implementation' => 'cssnano'),
    ),

    // php cli.php less compile front-semantic-ui-material-min

    array(
        'name' => 'front-semantic-ui-material-min',
        'source' => DEFAULTFCPATH.'themes/front_semantic_ui_material/less/front/index.less',
        'destination' => DEFAULTFCPATH.'themes/front_semantic_ui_material/css/front.min.css',
        'relativeUrls' => false,
        'implementation' => 'less.js',
        'autoprefixer' => array(),
        'cssmin' => array('implementation' => 'cssnano'),
    ),

);
