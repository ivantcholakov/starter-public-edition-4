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

    // php cli.php less compile common common-min

    array(
        'name' => 'common',
        'source' => DEFAULTFCPATH.'assets/less/lib/common/common.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/common/common.css',
        'compress' => false
    ),
    array(
        'name' => 'common-min',
        'source' => DEFAULTFCPATH.'assets/less/lib/common/common.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/common/common.min.css',
        'compress' => true
    ),

    // php cli.php less compile bootstrap-3 bootstrap-3-min

    array(
        'name' => 'bootstrap-3',
        'source' => DEFAULTFCPATH.'assets/less/lib/bootstrap-3/bootstrap.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/bootstrap-3/bootstrap.css',
        'compress' => false
    ),
    array(
        'name' => 'bootstrap-3-min',
        'source' => DEFAULTFCPATH.'assets/less/lib/bootstrap-3/bootstrap.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/bootstrap-3/bootstrap.min.css',
        'compress' => true
    ),

    // php cli.php less compile bootstrap-3 bootstrap-3-min

    array(
        'name' => 'bootstrap-3-no-font-face',
        'source' => DEFAULTFCPATH.'assets/less/lib/bootstrap-3/bootstrap-no-font-face.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/bootstrap-3/bootstrap-no-font-face.css',
        'compress' => false
    ),
    array(
        'name' => 'bootstrap-3-no-font-face-min',
        'source' => DEFAULTFCPATH.'assets/less/lib/bootstrap-3/bootstrap-no-font-face.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/bootstrap-3/bootstrap-no-font-face.min.css',
        'compress' => true
    ),

    // php cli.php less compile bootstrap-3 bootstrap-3-min

    array(
        'name' => 'bootstrap-3-font-face',
        'source' => DEFAULTFCPATH.'assets/less/lib/bootstrap-3/glyphicons-font-face.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/bootstrap-3/bootstrap-font-face.css',
        'compress' => false
    ),
    array(
        'name' => 'bootstrap-3-font-face-min',
        'source' => DEFAULTFCPATH.'assets/less/lib/bootstrap-3/glyphicons-font-face.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/bootstrap-3/bootstrap-font-face.min.css',
        'compress' => true
    ),

    // php cli.php less compile bootstrap-3-theme bootstrap-3-theme-min

    array(
        'name' => 'bootstrap-3-theme',
        'source' => DEFAULTFCPATH.'assets/less/lib/bootstrap-3/theme.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/bootstrap-3/bootstrap-theme.css',
        'compress' => false
    ),
    array(
        'name' => 'bootstrap-3-theme-min',
        'source' => DEFAULTFCPATH.'assets/less/lib/bootstrap-3/theme.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/bootstrap-3/bootstrap-theme.min.css',
        'compress' => true
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

    // php cli.php less compile bootstrap-chosen bootstrap-chosen-min

    array(
        'name' => 'bootstrap-chosen',
        'source' => DEFAULTFCPATH.'assets/less/lib/bootstrap-chosen/bootstrap-chosen.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/bootstrap-chosen/bootstrap-chosen.css',
        'compress' => false
    ),
    array(
        'name' => 'bootstrap-chosen-min',
        'source' => DEFAULTFCPATH.'assets/less/lib/bootstrap-chosen/bootstrap-chosen.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/bootstrap-chosen/bootstrap-chosen.min.css',
        'compress' => true
    ),

    // php cli.php less compile bootstrap-chosen-image bootstrap-chosen-image-min

    array(
        'name' => 'bootstrap-chosen-image',
        'source' => DEFAULTFCPATH.'assets/less/lib/chosen-image/bootstrap-chosenImage.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/chosen-image/bootstrap-chosenImage.css',
        'compress' => false
    ),
    array(
        'name' => 'bootstrap-chosen-image-min',
        'source' => DEFAULTFCPATH.'assets/less/lib/chosen-image/bootstrap-chosenImage.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/chosen-image/bootstrap-chosenImage.min.css',
        'compress' => true
    ),

    // php cli.php less compile bootstrap-select bootstrap-select-min

    array(
        'name' => 'bootstrap-select',
        'source' => DEFAULTFCPATH.'assets/less/lib/bootstrap-select/bootstrap-select.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/bootstrap-select/bootstrap-select.css',
        'compress' => false
    ),
    array(
        'name' => 'bootstrap-select-min',
        'source' => DEFAULTFCPATH.'assets/less/lib/bootstrap-select/bootstrap-select.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/bootstrap-select/bootstrap-select.min.css',
        'compress' => true
    ),

    // php cli.php less compile yamm3 yamm3-min

    array(
        'name' => 'yamm3',
        'source' => DEFAULTFCPATH.'assets/less/lib/yamm3/yamm.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/yamm3/yamm.css',
        'compress' => false
    ),
    array(
        'name' => 'yamm3-min',
        'source' => DEFAULTFCPATH.'assets/less/lib/yamm3/yamm.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/yamm3/yamm.min.css',
        'compress' => true
    ),

    // php cli.php less compile jasny-bootstrap-3 jasny-bootstrap-3-min

    array(
        'name' => 'jasny-bootstrap-3',
        'source' => DEFAULTFCPATH.'assets/less/lib/jasny-bootstrap-3/jasny-bootstrap-default.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/jasny-bootstrap-3/jasny-bootstrap.css',
        'compress' => false
    ),
    array(
        'name' => 'jasny-bootstrap-3-min',
        'source' => DEFAULTFCPATH.'assets/less/lib/jasny-bootstrap-3/jasny-bootstrap-default.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/jasny-bootstrap-3/jasny-bootstrap.min.css',
        'compress' => true
    ),

    // php cli.php less compile bootstrap-social bootstrap-social-min

    array(
        'name' => 'bootstrap-social',
        'source' => DEFAULTFCPATH.'assets/less/lib/bootstrap-social/bootstrap-social-default.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/bootstrap-social/bootstrap-social.css',
        'compress' => false
    ),
    array(
        'name' => 'bootstrap-social-min',
        'source' => DEFAULTFCPATH.'assets/less/lib/bootstrap-social/bootstrap-social-default.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/bootstrap-social/bootstrap-social.min.css',
        'compress' => true
    ),

    // php cli.php less compile datatables-bootstrap datatables-bootstrap-min

    array(
        'name' => 'datatables-bootstrap',
        'source' => DEFAULTFCPATH.'assets/less/lib/dataTables/dataTables.bootstrap.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/dataTables/dataTables.bootstrap.css',
        'compress' => false
    ),
    array(
        'name' => 'datatables-bootstrap-min',
        'source' => DEFAULTFCPATH.'assets/less/lib/dataTables/dataTables.bootstrap.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/dataTables/dataTables.bootstrap.min.css',
        'compress' => true
    ),

    // php cli.php less compile datatables-responsive datatables-responsive-min

    array(
        'name' => 'datatables-responsive',
        'source' => DEFAULTFCPATH.'assets/less/lib/dataTables/datatables.responsive.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/dataTables/datatables.responsive.css',
        'compress' => false
    ),
    array(
        'name' => 'datatables-responsive-min',
        'source' => DEFAULTFCPATH.'assets/less/lib/dataTables/datatables.responsive.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/dataTables/datatables.responsive.min.css',
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

    // php cli.php less compile bootstrap3-dialog bootstrap3-dialog-min

    array(
        'name' => 'bootstrap3-dialog',
        'source' => DEFAULTFCPATH.'assets/less/lib/bootstrap3-dialog/bootstrap-dialog.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/bootstrap3-dialog/bootstrap-dialog.css',
        'compress' => false
    ),
    array(
        'name' => 'bootstrap3-dialog-min',
        'source' => DEFAULTFCPATH.'assets/less/lib/bootstrap3-dialog/bootstrap-dialog.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/bootstrap3-dialog/bootstrap-dialog.min.css',
        'compress' => true
    ),

    // php cli.php less compile boostrap-star-rating boostrap-star-rating-min

    array(
        'name' => 'boostrap-star-rating',
        'source' => DEFAULTFCPATH.'assets/less/lib/bootstrap-star-rating/star-rating.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/bootstrap-star-rating/star-rating.css',
        'compress' => false
    ),
    array(
        'name' => 'boostrap-star-rating-min',
        'source' => DEFAULTFCPATH.'assets/less/lib/bootstrap-star-rating/star-rating.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/bootstrap-star-rating/star-rating.min.css',
        'compress' => true
    ),

    // php cli.php less compile bootstrap-3-pull bootstrap-3-pull-min

    array(
        'name' => 'bootstrap-3-pull',
        'source' => DEFAULTFCPATH.'assets/less/lib/bootstrap-3-pull/bootstrap-pull-standalone.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/bootstrap-3-pull/bootstrap-pull.css',
        'compress' => false
    ),
    array(
        'name' => 'bootstrap-3-pull-min',
        'source' => DEFAULTFCPATH.'assets/less/lib/bootstrap-3-pull/bootstrap-pull-standalone.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/bootstrap-3-pull/bootstrap-pull.min.css',
        'compress' => true
    ),

    array(
        'name' => 'snackbar',
        'source' => DEFAULTFCPATH.'assets/less/lib/snackbar/snackbar.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/snackbar/snackbar.css',
        'compress' => false
    ),
    array(
        'name' => 'snackbar-min',
        'source' => DEFAULTFCPATH.'assets/less/lib/snackbar/snackbar.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/snackbar/snackbar.min.css',
        'compress' => true
    ),

    // php cli.php less compile bootstrap-material-design bootstrap-material-design-min

    array(
        'name' => 'bootstrap-material-design',
        'source' => DEFAULTFCPATH.'assets/less/lib/bootstrap-material-design/bootstrap-material-design.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/bootstrap-material-design/bootstrap-material-design.css',
        'compress' => false
    ),
    array(
        'name' => 'bootstrap-material-design-min',
        'source' => DEFAULTFCPATH.'assets/less/lib/bootstrap-material-design/bootstrap-material-design.less',
        'destination' => DEFAULTFCPATH.'assets/css/lib/bootstrap-material-design/bootstrap-material-design.min.css',
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
