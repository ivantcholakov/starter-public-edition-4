<?php

$config['tasks'] = [

    // php cli.php assets compile material-design-icons material-design-icons-min

    [
        'name' => 'material-design-icons',
        'type' => 'scss',
        'destination' => DEFAULTFCPATH.'assets/css/lib/material-design-icons/material-icons.css',
        'source' => DEFAULTFCPATH.'assets/scss/lib/material-design-icons/material-icons.scss',
        'scss' => ['formatter' => 'expanded'],
    ],
    [
        'name' => 'material-design-icons-min',
        'type' => 'scss',
        'destination' => DEFAULTFCPATH.'assets/css/lib/material-design-icons/material-icons.min.css',
        'source' => DEFAULTFCPATH.'assets/scss/lib/material-design-icons/material-icons.scss',
        'scss' => ['formatter' => 'compressed'],
    ],

    // php cli.php assets compile sweetalert sweetalert-min sweetalert-custom sweetalert-custom-min sweetalert-facebook sweetalert-facebook-min sweetalert-google sweetalert-google-min sweetalert-twitter sweetalert-twitter-min

    // php cli.php assets compile sweetalert sweetalert-min

    [
        'name' => 'sweetalert',
        'type' => 'scss',
        'destination' => DEFAULTFCPATH.'assets/css/lib/sweetalert/sweetalert.css',
        'source' => DEFAULTFCPATH.'assets/scss/lib/sweetalert/sweetalert.scss',
        'scss' => ['formatter' => 'expanded'],
    ],
    [
        'name' => 'sweetalert-min',
        'type' => 'scss',
        'destination' => DEFAULTFCPATH.'assets/css/lib/sweetalert/sweetalert.min.css',
        'source' => DEFAULTFCPATH.'assets/scss/lib/sweetalert/sweetalert.scss',
        'scss' => ['formatter' => 'compressed'],
    ],

    // php cli.php assets compile sweetalert-custom sweetalert-custom-min

    [
        'name' => 'sweetalert-custom',
        'type' => 'scss',
        'destination' => DEFAULTFCPATH.'assets/css/lib/sweetalert/sweetalert-custom.css',
        'source' => DEFAULTFCPATH.'assets/scss/lib/sweetalert/sweetalert-custom.scss',
        'scss' => ['formatter' => 'expanded'],
    ],
    [
        'name' => 'sweetalert-custom-min',
        'type' => 'scss',
        'destination' => DEFAULTFCPATH.'assets/css/lib/sweetalert/sweetalert-custom.min.css',
        'source' => DEFAULTFCPATH.'assets/scss/lib/sweetalert/sweetalert-custom.scss',
        'scss' => ['formatter' => 'compressed'],
    ],

    // php cli.php assets compile sweetalert-facebook sweetalert-facebook-min

    [
        'name' => 'sweetalert-facebook',
        'type' => 'scss',
        'destination' => DEFAULTFCPATH.'assets/css/lib/sweetalert/facebook.css',
        'source' => DEFAULTFCPATH.'assets/scss/lib/sweetalert/facebook.scss',
        'scss' => ['formatter' => 'expanded'],
    ],
    [
        'name' => 'sweetalert-facebook-min',
        'type' => 'scss',
        'destination' => DEFAULTFCPATH.'assets/css/lib/sweetalert/facebook.min.css',
        'source' => DEFAULTFCPATH.'assets/scss/lib/sweetalert/facebook.scss',
        'scss' => ['formatter' => 'compressed'],
    ],

    // php cli.php assets compile sweetalert-google sweetalert-google-min

    [
        'name' => 'sweetalert-google',
        'type' => 'scss',
        'destination' => DEFAULTFCPATH.'assets/css/lib/sweetalert/google.css',
        'source' => DEFAULTFCPATH.'assets/scss/lib/sweetalert/google.scss',
        'scss' => ['formatter' => 'expanded'],
    ],
    [
        'name' => 'sweetalert-google-min',
        'type' => 'scss',
        'destination' => DEFAULTFCPATH.'assets/css/lib/sweetalert/google.min.css',
        'source' => DEFAULTFCPATH.'assets/scss/lib/sweetalert/google.scss',
        'scss' => ['formatter' => 'compressed'],
    ],

    // php cli.php assets compile sweetalert-twitter sweetalert-twitter-min

    [
        'name' => 'sweetalert-twitter',
        'type' => 'scss',
        'destination' => DEFAULTFCPATH.'assets/css/lib/sweetalert/twitter.css',
        'source' => DEFAULTFCPATH.'assets/scss/lib/sweetalert/twitter.scss',
        'scss' => ['formatter' => 'expanded'],
    ],
    [
        'name' => 'sweetalert-twitter-min',
        'type' => 'scss',
        'destination' => DEFAULTFCPATH.'assets/css/lib/sweetalert/twitter.min.css',
        'source' => DEFAULTFCPATH.'assets/scss/lib/sweetalert/twitter.scss',
        'scss' => ['formatter' => 'compressed'],
    ],

];
