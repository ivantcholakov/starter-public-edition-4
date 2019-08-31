<?php defined('BASEPATH') OR exit('No direct script access allowed');

$config['twig'] = array(
    array(
        'name' => default_base_url(),
        'directory' => WRITABLEPATH.'twig/'.'front'.'/',
    ),
    array(
        'name' => default_base_url('admin'),
        'directory' => WRITABLEPATH.'twig/'.'admin'.'/',
    ),
    /*
     * An example on how to use this feature on a remote site.
     * Set name an URL accordingly and within the file common/config/twig.php
     * add (allow) the IP of your server on which your administrator panel runs.
     * Also, place the serving controller on the remote site as follows:
     * applications/your_app_name/modules/twig/controllers/Refresh_controller.php
     * See applications/admin/modules/twig/controllers/Refresh_controller.php
     */
    array(
        'name' => default_base_url('admin'), // or hard-code directly: 'https://example.com/'.
        'url' => default_base_url('admin/twig/refresh'), // or hard-code directly: 'https://example.com/twig/refresh'.
    ),
);
