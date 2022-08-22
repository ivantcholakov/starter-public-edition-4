<?php defined('BASEPATH') OR exit('No direct script access allowed.');

/**
 * A library that supports letter avatars.
 *
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2017
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Letter_avatar {

    protected $ci;

    protected $base_url;
    protected $image_size = 80;
    protected $default_image = '';
    protected $force_default_image = false;

    public function __construct() {

        $this->ci = get_instance();

        $this->ci->load->helper('url');
        $this->ci->load->config('custom_user_photo');

        $config = array(
            'custom_user_photo_base_url' => $this->ci->config->item('custom_user_photo_base_url'),
            'custom_user_photo_image_size' => $this->ci->config->item('custom_user_photo_image_size'),
            'custom_user_photo_default_image' => $this->ci->config->item('custom_user_photo_default_image'),
            'custom_user_photo_force_default_image' => $this->ci->config->item('custom_user_photo_force_default_image'),
        );

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
     * Creates a URL for requesting a letter avatar.
     */
    public function get($name, $size = null, $default_image = null, $force_default_image = null) {

        $url = $this->base_url.'letter-avatar';

        $query = array();

        $name = preg_replace('/[^\p{L}\s]/u', '', UTF8::strtoupper(url_title($name, ' ', false, false)));
        $name = preg_split('/\s/m', $name, -1, PREG_SPLIT_NO_EMPTY);

        if (!empty($name)) {

            if (count($name) == 1) {

                $name = UTF8::str_split($name[0]);
                $name = array_slice($name, 0, 2);

            } else {

                $name0 = UTF8::str_split($name[0]);
                $name1 = UTF8::str_split($name[1]);

                $name = array($name0[0], $name1[0]);
            }
        }

        $name = implode(' ', $name);

        if (!empty($name)) {
            $query['n'] = $name;
        }

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
