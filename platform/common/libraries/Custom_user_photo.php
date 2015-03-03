<?php defined('BASEPATH') OR exit('No direct script access allowed.');

/**
 * A library that supports custom (loaclly uploaded) user photos.
 *
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2014
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Custom_user_photo {

    protected $ci;

    protected $base_url;
    protected $image_size = 80;
    protected $default_image = '';
    protected $force_default_image = false;

    public function __construct($config = array()) {

        $this->ci = get_instance();

        if (!is_array($config)) {
            $config = array();
        }

        $this->base_url = DEFAULT_BASE_URL.'userphotos/';

        if (isset($config['custom_user_photo_base_url'])) {
            $this->base_url = (string) $config['custom_user_photo_base_url'];
        }

        if (isset($config['custom_user_photo_image_size'])) {

            $image_size = (int) $config['custom_user_photo_image_size'];

            if ($image_size > 0) {
                $this->image_size = $image_size;
            }
        }

        if (isset($config['custom_user_photo_default_image'])) {
            $this->default_image = (string) $config['custom_user_photo_default_image'];
        }

        if (isset($config['custom_user_photo_force_default_image'])) {
            $this->force_default_image = !empty($config['custom_user_photo_force_default_image']);
        }
    }

    /**
     * Creates a URL for requesting a custom user photo.
     */
    public function get($photo, $size = null, $default_image = null, $force_default_image = null) {

        $url = $this->base_url.'avatar/'.$photo;

        $query = array();

        $size = (int) $size;

        if ($size <= 0) {
            $size = $this->image_size;
        }

        if ($size > 0) {
            $query['s'] = $size;
        }

        if (isset($default_image)) {
            $default_image = (string) $default_image;
        } else {
            $default_image = $this->default_image;
        }

        if ($default_image != '') {
            $query['d'] = $default_image;
        }

        if (isset($force_default_image)) {
            $force_default_image = !empty($force_default_image);
        } else {
            $force_default_image = $this->force_default_image;
        }

        if ($force_default_image) {
            $query['f'] = 'y';
        }

        if (!empty($query)) {
            $url = http_build_url($url, array('query' => http_build_query($query)));
        }

        return $url;
    }

}
