<?php defined('BASEPATH') OR exit('No direct script access allowed.');

/**
 * Thumbnail Library
 *
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2016
 * @license The MIT License (MIT)
 * @link http://opensource.org/licenses/MIT
 */

class Thumbnail {

    // Default Configuration Values
    public $defaults;

    protected $ci;

    // Base URL for Images
    protected $image_base_url;

    // Base Path for Source Images
    protected $image_base_path;

    // Base Path for Cached Images
    protected $image_cache_path;

    // Canvas Background Color
    protected $bg_r;
    protected $bg_g;
    protected $bg_b;

    // Enable/Disable Watermarking
    protected $has_watermark;
    protected $wm_enabled_min_w;
    protected $wm_enabled_min_h;

    // See https://www.codeigniter.com/user_guide/libraries/image_lib.html#watermarking-preferences

    // Common Watermarking Options
    protected $wm_type; // 'text' or 'overlay'
    protected $wm_padding;
    protected $wm_vrt_alignment;
    protected $wm_hor_alignment;
    protected $wm_hor_offset;
    protected $wm_vrt_offset;

    // Text Watermarking Options
    protected $wm_text;
    protected $wm_font_path;
    protected $wm_font_size;
    protected $wm_font_color;
    protected $wm_shadow_color;
    protected $wm_shadow_distance;

    // Overlay Watermarking Options
    protected $wm_overlay_path;
    protected $wm_opacity;
    protected $wm_x_transp;
    protected $wm_y_transp;

    // Overrides no_crop property.
    protected $force_crop;

    public function __construct($config = array()) {

        $this->ci = & get_instance();

        $this->ci->load
            ->library('image_lib')
            ->helper('url')
        ;

        $this->defaults = array(

            'image_base_url' => default_base_url(),
            'image_base_path' => DEFAULTFCPATH,
            'image_cache_path' => WRITABLEPATH.'image_cache/thumbnails/',

            'bg_r' => 255,
            'bg_g' => 255,
            'bg_b' => 255,

            'has_watermark' => false,
            'wm_enabled_min_w' => 100,
            'wm_enabled_min_h' => 50,

            'wm_type' => 'text',
            'wm_padding' => 0,
            'wm_vrt_alignment' => 'B',
            'wm_hor_alignment' => 'C',
            'wm_hor_offset' => 0,
            'wm_vrt_offset' => 0,

            'wm_text' => 'Watermark',
            'wm_font_path' => '',
            'wm_font_size' => 17,
            'wm_font_color' => '#ff0000',
            'wm_shadow_color' => '',
            'wm_shadow_distance' => 2,

            'wm_overlay_path' => '',
            'wm_opacity' => 50,
            'wm_x_transp' => 4,
            'wm_y_transp' => 4,

            'force_crop' => false,
        );

        if (!is_array($config)) {
            $config = array();
        }

        $this->defaults = array_merge($this->defaults, $config);

        $this->initialize($this->defaults);
    }

    public function initialize($config = array()) {

        if (!is_array($config)) {
            $config = array();
        }

        foreach ($config as $key => $value) {
            $this->{$key} = $value;
        }

        file_exists($this->image_cache_path) OR @mkdir($this->image_cache_path, 0755, TRUE);

        return $this;
    }

    public function get($src, $width = null, $height = null, $no_crop = null, $keep_canvas_size = null) {

        $this->ci = & get_instance();

        if (is_array($src)) {

            $src = array_only($src, array('src', 'width', 'w', 'height', 'h', 'no_crop', 'keep_canvas_size'));

            if (isset($src['width'])) {
                $width = $src['width'];
            } elseif (isset($src['w'])) {
                $width = $src['w'];
            } else {
                $width = null;
            }

            if (isset($src['height'])) {
                $height = $src['height'];
            } elseif (isset($src['h'])) {
                $height = $src['h'];
            } else {
                $height = null;
            }

            $no_crop = isset($src['no_crop']) ? $src['no_crop'] : null;
            $keep_canvas_size = isset($src['keep_canvas_size']) ? $src['keep_canvas_size'] : null;

            // The followin assignment is to be at the last place within this block.
            $src = isset($src['src']) ? $src['src'] : null;
        }

        // Separate all the image thumbnails within a subdirectory.
        // When the source image is to be deleted, all its thumbnails
        // will be removed by deletion of the corresponding subdirectory.
        // On deletion generate the directory path in the exactly the same way.
        $src_path = str_replace('\\', '/', realpath($this->image_base_path.str_ireplace($this->image_base_url, '', $src)));

        if (!is_file($src_path)) {
            $this->_display_error_404();
        }

        $image_cache_subdirectory = sha1($src_path);
        $image_cache_path = $this->image_cache_path.$image_cache_subdirectory.'/';
        file_exists($image_cache_path) OR @mkdir($image_cache_path, 0755, TRUE);
        //

        $src_name_parts = $this->ci->image_lib->explode_name($src_path);
        $ext = $src_name_parts['ext'];

        $resize_operation = null;

        $w = (string) $width;
        $h = (string) $height;

        $no_crop = !empty($no_crop);

        if (!empty($this->force_crop)) {
            $no_crop = false;
        }

        $keep_canvas_size = !empty($keep_canvas_size);

        $bg_r = $this->bg_r;
        $bg_g = $this->bg_g;
        $bg_b = $this->bg_b;

        $has_watermark = !empty($this->has_watermark);
        $wm_enabled_min_w = $this->wm_enabled_min_w;
        $wm_enabled_min_h = $this->wm_enabled_min_h;

        $wm_type = $this->wm_type;
        $wm_padding = $this->wm_padding;
        $wm_vrt_alignment = $this->wm_vrt_alignment;
        $wm_hor_alignment = $this->wm_hor_alignment;
        $wm_hor_offset = $this->wm_hor_offset;
        $wm_vrt_offset = $this->wm_vrt_offset;

        $wm_text = $this->wm_text;
        $wm_font_path = $this->wm_font_path;
        $wm_font_size = $this->wm_font_size;
        $wm_font_color = $this->wm_font_color;
        $wm_shadow_color = $this->wm_shadow_color;
        $wm_shadow_distance = $this->wm_shadow_distance;

        $wm_overlay_path = $this->wm_overlay_path;
        $wm_opacity = $this->wm_opacity;
        $wm_x_transp = $this->wm_x_transp;
        $wm_y_transp = $this->wm_y_transp;

        $prop = $this->ci->image_lib->get_image_properties($src_path, true);

        if ($prop === false) {
            $this->_display_error_500();
        }

        $mime_type = $prop['mime_type'];
        $image_type = $prop['image_type'];
        $src_size = filesize($src_path);

        if ($w > 0) {

            $resize_operation = 'fit_width';
            $w = (int) $w;

        } else {

            $w = '';
        }

        if ($h > 0) {

            $resize_operation = $resize_operation == 'fit_width' ? ($no_crop ? ($keep_canvas_size ? 'fit_canvas' : 'fit_inner') : 'fit') : 'fit_height';
            $h = (int) $h;

        } else {

            $h = '';
        }

        if ($resize_operation == '') {

            $w = (int) $prop['width'];
            $h = (int) $prop['height'];

            $resize_operation = $keep_canvas_size ? 'fit_canvas' : 'fit_inner';
        }

        $parameters = compact(
            'src_path',
            'src_size',
            'resize_operation',
            'w',
            'h',
            'no_crop',
            'keep_canvas_size',
            'has_watermark'
        );

        if ($keep_canvas_size) {

            $parameters = array_merge($parameters, compact(
                'bg_r',
                'bg_g',
                'bg_b'
            ));
        }

        if ($has_watermark) {

            $wm_parameters = compact(
                'wm_enabled_min_w',
                'wm_enabled_min_h',
                'wm_type',
                'wm_padding',
                'wm_vrt_alignment',
                'wm_hor_alignment',
                'wm_hor_offset',
                'wm_vrt_offset'
            );

            if ($wm_type == 'text') {

                $wm_parameters = array_merge($wm_parameters, compact(
                    'wm_text',
                    'wm_font_path',
                    'wm_font_size',
                    'wm_font_color',
                    'wm_shadow_color',
                    'wm_shadow_distance'
                ));

            } elseif ($wm_type == 'overlay') {

                $wm_parameters = array_merge($wm_parameters, compact(
                    'wm_text',
                    'wm_font_path',
                    'wm_font_size',
                    'wm_font_color',
                    'wm_shadow_color',
                    'wm_shadow_distance'
                ));
            }

            $parameters = array_merge($parameters, $wm_parameters);
        }

        $cached_image_name = sha1(serialize($parameters)).$ext;
        $cached_image_file = $image_cache_path.$cached_image_name;

        if (!is_file($cached_image_file)) {

            $config = array();
            $config['source_image'] = $src_path;
            $config['dynamic_output'] = false;
            $config['new_image'] = $cached_image_file;
            $config['maintain_ratio'] = true;
            $config['create_thumb'] = false;
            $config['width'] = $w;
            $config['height'] = $h;
            $config['quality'] = 100;

            if (!$this->ci->image_lib->initialize($config)) {
                $this->_display_error_500();
            }

            if ($resize_operation == 'fit_inner' || $resize_operation == 'fit_canvas') {
                $this->ci->image_lib->resize();
            } else {
                $this->ci->image_lib->fit();
            }

            $this->ci->image_lib->clear();

            if ($resize_operation == 'fit_canvas') {

                $backgrund_image = @ tempnam(sys_get_temp_dir(), 'imp');

                if ($backgrund_image === false) {

                    @ unlink($cached_image_file);
                    $this->_display_error_500();
                }

                $img = imagecreatetruecolor($w, $h);
                $bg = imagecolorallocate($img, $bg_r, $bg_g, $bg_b);
                imagefill($img, 0, 0, $bg);

                $this->ci->image_lib->image_type = $image_type;
                $this->ci->image_lib->full_dst_path = $backgrund_image;
                $this->ci->image_lib->quality = 100;

                if (!$this->ci->image_lib->image_save_gd($img)) {

                    @ unlink($backgrund_image);
                    @ unlink($cached_image_file);
                    $this->_display_error_500();
                }

                $this->ci->image_lib->clear();

                $config = array();
                $config['source_image'] = $backgrund_image;
                $config['wm_type'] = 'overlay';
                $config['wm_overlay_path'] = $cached_image_file;
                $config['wm_opacity'] = 100;
                $config['wm_hor_alignment'] = 'center';
                $config['wm_vrt_alignment'] = 'middle';
                $config['dynamic_output'] = false;
                $config['new_image'] = $cached_image_file;
                $config['quality'] = 100;

                if (!$this->ci->image_lib->initialize($config)) {

                    @ unlink($backgrund_image);
                    @ unlink($cached_image_file);
                    $this->_display_error_500();
                }

                if (!$this->ci->image_lib->watermark()) {

                    @ unlink($backgrund_image);
                    @ unlink($cached_image_file);
                    $this->_display_error_500();
                }

                @ unlink($backgrund_image);
                $this->ci->image_lib->clear();
            }

            if ($has_watermark) {

                $prop_resized = $this->ci->image_lib->get_image_properties($cached_image_file, true);

                if ($prop_resized === false) {

                    @ unlink($cached_image_file);
                    $this->_display_error_500();
                }

                if ($prop_resized['width'] < $wm_enabled_min_w || $prop_resized['height'] < $wm_enabled_min_h) {
                    $has_watermark = false;
                }

                if ($has_watermark) {

                    $config = array();
                    $config['source_image'] = $cached_image_file;
                    $config['dynamic_output'] = false;
                    $config['new_image'] = $cached_image_file;
                    $config['quality'] = 100;
                    $config = array_merge($config, $wm_parameters);

                    if (!$this->ci->image_lib->initialize($config)) {

                        @ unlink($cached_image_file);
                        $this->_display_error_500();
                    }

                    if (!$this->ci->image_lib->watermark()) {

                        @ unlink($cached_image_file);
                        $this->_display_error_500();
                    }

                    $this->ci->image_lib->clear();
                }
            }
        }

        $this->_display_graphic_file($cached_image_file, $mime_type, $cached_image_name);

    }

    // http://ernieleseberg.com/php-image-output-and-browser-caching/
    // http://www.controlstyle.com/articles/programming/text/if-mod-since-php/
    protected function _display_graphic_file($file, $mime_type, $new_name) {

        $last_modified = @ filemtime($file);

        if ($last_modified === false) {
            $last_modified = time();
        }

        $if_modified_since = $this->ci->input->get_request_header('If-Modified-Since');

        if ($if_modified_since != '' && strtotime($if_modified_since) == $last_modified) {

            header('Last-Modified: '.gmdate('D, d M Y H:i:s', $last_modified).' GMT', true, 304);

        } else {

            header('Last-Modified: '.gmdate('D, d M Y H:i:s', $last_modified).' GMT', true, 200);
            header('Content-Disposition: filename='.$new_name.';');
            header('Content-Type: '.$mime_type);
            header('Content-Transfer-Encoding: binary');

            @ob_end_clean();
            @ob_end_flush();

            @ readfile($file);
        }

        exit;
    }

    protected function _display_error_404() {

        set_status_header(404);
        exit;
    }

    protected function _display_error_500() {

        set_status_header(500);
        exit;
    }

}
