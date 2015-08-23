<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2015
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Image_process_controller extends Base_Controller {

    protected $image_base_url;
    protected $image_base_path;
    protected $image_cache_path;

    protected $bg_r;
    protected $bg_g;
    protected $bg_b;

    protected $has_watermark;
    protected $wm_enabled_min_w;
    protected $wm_enabled_min_h;

    protected $wm_type;
    protected $wm_padding;
    protected $wm_vrt_alignment;
    protected $wm_hor_alignment;
    protected $wm_hor_offset;
    protected $wm_vrt_offset;

    protected $wm_text;
    protected $wm_font_path;
    protected $wm_font_size;
    protected $wm_font_color;
    protected $wm_shadow_color;
    protected $wm_shadow_distance;

    protected $wm_overlay_path;
    protected $wm_opacity;
    protected $wm_x_transp;
    protected $wm_y_transp;

    public function __construct() {

        parent::__construct();

        $this->load
            ->library('image_lib')
            ->helper('url')
        ;

        $this->image_base_url = default_base_url();
        $this->image_base_path = DEFAULTFCPATH;

        // The following options could be taken from a configuration file.

        $this->image_cache_path = WRITABLEPATH.'image_cache/image_process/';
        file_exists($this->image_cache_path) OR @mkdir($this->image_cache_path, 0755, TRUE);

        $this->bg_r = 255;
        $this->bg_g = 255;
        $this->bg_b = 255;

        $this->has_watermark = true;
        $this->wm_enabled_min_w = 100;
        $this->wm_enabled_min_h = 50;

        // See http://www.codeigniter.com/user_guide/libraries/image_lib.html#watermarking-preferences

        // Common Watermarking Options
        $this->wm_type = 'text'; // 'text' or 'overlay'
        $this->wm_padding = 0;
        $this->wm_vrt_alignment = 'B';
        $this->wm_hor_alignment = 'C';
        $this->wm_hor_offset = 0;
        $this->wm_vrt_offset = 0;

        // Text Watermarking Options
        $this->wm_text = 'Watermark';
        $this->wm_font_path = '';
        $this->wm_font_size = 17;
        $this->wm_font_color = '#ff0000';
        $this->wm_shadow_color = '';
        $this->wm_shadow_distance = 2;

        // Overlay Watermarking Options
        $this->wm_overlay_path = '';
        $this->wm_opacity = 50;
        $this->wm_x_transp = 4;
        $this->wm_y_transp = 4;
    }

    public function index() {

        $controller = __CLASS__;

        $src_path = $this->image_base_path.str_ireplace($this->image_base_url, '', $this->input->get('src'));

        if (!is_file($src_path)) {
            exit;
        }

        $src_name_parts = $this->image_lib->explode_name($src_path);
        $ext = $src_name_parts['ext'];

        $resize_operation = null;

        $w = (string) $this->input->get('w');
        $h = (string) $this->input->get('h');

        $no_crop = $this->input->get('no_crop');
        $no_crop = !empty($no_crop);

        $keep_canvas_size = $this->input->get('keep_canvas_size');
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

        // Text Watermarking Options
        $wm_text = $this->wm_text;
        $wm_font_path = $this->wm_font_path;
        $wm_font_size = $this->wm_font_size;
        $wm_font_color = $this->wm_font_color;
        $wm_shadow_color = $this->wm_shadow_color;
        $wm_shadow_distance = $this->wm_shadow_distance;

        // Overlay Watermarking Options
        $wm_overlay_path = $this->wm_overlay_path;
        $wm_opacity = $this->wm_opacity;
        $wm_x_transp = $this->wm_x_transp;
        $wm_y_transp = $this->wm_y_transp;

        $prop = $this->image_lib->get_image_properties($src_path, true);

        if ($prop === false) {
            exit;
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
            'controller',
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
        $cached_image_file = $this->image_cache_path.$cached_image_name;

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

            if (!$this->image_lib->initialize($config)) {
                exit;
            }

            if ($resize_operation == 'fit_inner' || $resize_operation == 'fit_canvas') {
                $this->image_lib->resize();
            } else {
                $this->image_lib->fit();
            }

            $this->image_lib->clear();

            if ($resize_operation == 'fit_canvas') {

                $backgrund_image = @ tempnam(sys_get_temp_dir(), 'imp');

                if ($backgrund_image === false) {

                    @ unlink($cached_image_file);
                    exit;
                }

                $img = imagecreatetruecolor($w, $h);
                $bg = imagecolorallocate($img, $bg_r, $bg_g, $bg_b);
                imagefill($img, 0, 0, $bg);

                $this->image_lib->image_type = $image_type;
                $this->image_lib->full_dst_path = $backgrund_image;
                $this->image_lib->quality = 100;

                if (!$this->image_lib->image_save_gd($img)) {

                    @ unlink($backgrund_image);
                    @ unlink($cached_image_file);
                    exit;
                }

                $this->image_lib->clear();

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

                if (!$this->image_lib->initialize($config)) {

                    @ unlink($backgrund_image);
                    @ unlink($cached_image_file);
                    exit;
                }

                if (!$this->image_lib->watermark()) {

                    @ unlink($backgrund_image);
                    @ unlink($cached_image_file);
                    exit;
                }

                @ unlink($backgrund_image);
                $this->image_lib->clear();
            }

            if ($has_watermark) {

                $prop_resized = $this->image_lib->get_image_properties($cached_image_file, true);

                if ($prop_resized === false) {

                    @ unlink($cached_image_file);
                    exit;
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

                    if (!$this->image_lib->initialize($config)) {

                        @ unlink($cached_image_file);
                        exit;
                    }

                    if (!$this->image_lib->watermark()) {

                        @ unlink($cached_image_file);
                        exit;
                    }

                    $this->image_lib->clear();
                }
            }
        }

        $this->_display_graphic_file($cached_image_file, $mime_type, $cached_image_name);
    }

    // http://ernieleseberg.com/php-image-output-and-browser-caching/
    // http://www.controlstyle.com/articles/programming/text/if-mod-since-php/
    protected function _display_graphic_file($file, $mime_type, $new_name) {

        $last_modified = filemtime($file);

        if ($last_modified === false) {
            $last_modified = time();
        }

        $if_modified_since = $this->input->get_request_header('If-Modified-Since');

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

}
