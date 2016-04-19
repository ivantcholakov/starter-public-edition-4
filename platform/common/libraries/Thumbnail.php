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
    protected $defaults;

    protected $ci;

    // Base URL for Images
    protected $image_base_url;

    // Base Path for Source Images
    protected $image_base_path;

    // Base Path for Cached Images
    protected $image_cache_path;

    // Base Path for Browser Accessible Cached Images
    protected $image_public_cache_path;

    // Base URL for Browser Accessible Cached Images
    protected $image_public_cache_url;

    // Enable Dynamic Output
    protected $enable_dynamic_output;

    // Canvas Background Color
    protected $bg_r;
    protected $bg_g;
    protected $bg_b;
    protected $bg_alpha;    // 0 - completely opaque, 127 - completely transparent.

    // Enable Watermarking
    protected $enable_watermark;
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
            'image_cache_path' => WRITABLEPATH.'thumbnails/',
            'image_public_cache_path' => PUBLIC_CACHE_PATH.'thumbnails/',
            'image_public_cache_url' => PUBLIC_CACHE_URL.'thumbnails/',

            'enable_dynamic_output' => array(),

            'bg_r' => 255,
            'bg_g' => 255,
            'bg_b' => 255,
            'bg_alpha' => 127,

            'enable_watermark' => array(),
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
            'wm_x_transp' => false,
            'wm_y_transp' => false,

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

        if (isset($config['image_base_path'])) {

            $config['image_base_path'] = (string) $config['image_base_path'];

            if ($config['image_base_path'] == '') {
                throw new RuntimeException('Thumbnail: image_base_path setting is empty.');
            }

            if (!is_dir($config['image_base_path'])) {
                throw new RuntimeException('Thumbnail: image_base_path does not exist.');
            }

            if (($test = $this->_get_absolute_dir($config['image_base_path'])) !== false) {
                $config['image_base_path'] = $test;
            } else {
                throw new RuntimeException('Thumbnail: image_base_path does not exist.');
            }
        }

        if (isset($config['image_cache_path'])) {

            $config['image_cache_path'] = (string) $config['image_cache_path'];

            if ($config['image_cache_path'] == '') {
                throw new RuntimeException('Thumbnail: image_cache_path setting is empty.');
            }

            if (!is_dir($config['image_cache_path'])) {

                @mkdir($config['image_cache_path'], 0755, TRUE);

                if (!is_dir($config['image_cache_path'])) {
                    throw new RuntimeException('Thumbnail: image_public_cache_path can not be created.');
                }
            }

            if (($test = $this->_get_absolute_dir($config['image_cache_path'])) !== false) {
                $config['image_cache_path'] = $test;
            } else {
                throw new RuntimeException('Thumbnail: image_cache_path can not be created.');
            }
        }

        if (isset($config['image_public_cache_path'])) {

            $config['image_public_cache_path'] = (string) $config['image_public_cache_path'];

            if ($config['image_public_cache_path'] == '') {
                throw new RuntimeException('Thumbnail: image_public_cache_path setting is empty.');
            }

            if (!is_dir($config['image_public_cache_path'])) {

                @mkdir($config['image_public_cache_path'], 0755, TRUE);

                if (!is_dir($config['image_public_cache_path'])) {
                    throw new RuntimeException('Thumbnail: image_public_cache_path can not be created.');
                }
            }

            if (($test = $this->_get_absolute_dir($config['image_public_cache_path'])) !== false) {
                $config['image_public_cache_path'] = $test;
            } else {
                throw new RuntimeException('Thumbnail: image_public_cache_path can not be created.');
            }
        }

        foreach ($config as $key => $value) {

            // Since most of the options will be used for hash creation
            // make them "strongly typed".
            switch ($key) {

                case 'image_base_url':
                case 'image_base_path':
                case 'image_cache_path':
                case 'image_public_cache_path':
                case 'image_public_cache_url':
                case 'wm_type':
                case 'wm_vrt_alignment':
                case 'wm_hor_alignment':
                case 'wm_text':
                case 'wm_font_color':
                case 'wm_shadow_color':
                case 'wm_overlay_path':

                    $this->{$key} = (string) $value;
                    break;

                case 'wm_font_path':

                    $value = (string) $value;

                    if ($value != '') {
                        $value = str_replace('\\', '/', realpath($value));
                    }

                    $this->{$key} = $value;
                    break;

                case 'bg_r':
                case 'bg_g':
                case 'bg_b':
                case 'bg_alpha':
                case 'wm_enabled_min_w':
                case 'wm_enabled_min_h':
                case 'wm_padding':
                case 'wm_hor_offset':
                case 'wm_vrt_offset':
                case 'wm_font_size':
                case 'wm_shadow_distance':
                case 'wm_opacity':

                    $this->{$key} = (int) $value;
                    break;

                case 'force_crop':

                    $this->{$key} = !empty($value);
                    break;

                case 'wm_x_transp':
                case 'wm_y_transp':

                    $this->{$key} = is_bool($value) ? $value : (int) $value;
                    break;

                case 'enable_watermark':
                case 'enable_dynamic_output':

                    if (is_array($value)) {

                        foreach ($value as & $v) {
                            $v = str_replace('\\', '/', $v);
                        }

                        unset($v);

                        $this->{$key} = $value;

                    } else {

                        $this->{$key} = array();
                    }

                    break;

                default:

                    $this->{$key} = $value;
                    break;
            }
        }

        return $this;
    }

    public function reset() {

        $this->initialize($this->defaults);

        return $this;
    }

    public function get_defaults() {

        return $this->defaults;
    }

    public function get($src, $width = null, $height = null, $no_crop = null, $keep_canvas_size = null) {

        return $this->create($src, $width, $height, $no_crop, $keep_canvas_size, false, true);
    }

    public function create($src, $width = null, $height = null, $no_crop = null, $keep_canvas_size = null, $public = null, $dynamic_output = null) {

        // Read the input parameters.

        if (is_array($src)) {

            $src = array_only($src, array('src', 'width', 'w', 'height', 'h', 'no_crop', 'keep_canvas_size'));

            if (isset($src['width'])) {
                $width = $src['width'];
            } elseif (isset($src['w'])) {
                $width = $src['w'];
            } else {
                $width = $width;
            }

            if (isset($src['height'])) {
                $height = $src['height'];
            } elseif (isset($src['h'])) {
                $height = $src['h'];
            } else {
                $height = $height;
            }

            $no_crop = isset($src['no_crop']) ? $src['no_crop'] : $no_crop;
            $keep_canvas_size = isset($src['keep_canvas_size']) ? $src['keep_canvas_size'] : $keep_canvas_size;
            $public = isset($src['public']) ? $src['public'] : $public;
            $dynamic_output = isset($src['dynamic_output']) ? $src['dynamic_output'] : $dynamic_output;

            // The following assignment is to be at the last place within this block.
            $src = isset($src['src']) ? $src['src'] : null;
        }

        $public = !empty($public);
        $dynamic_output = !empty($dynamic_output);

        // Sanitaze the source URL.
        if ($this->_check_path($src) === false) {

            if ($dynamic_output) {
                $this->_display_error(500);
            }

            return false;
        }

        // Calcualate the image path from the provided source URL.

        $src_path = $this->image_base_path.str_replace($this->image_base_url, '', $src);

        if (!is_file($src_path)) {

            if ($dynamic_output) {
                $this->_display_error(404);
            }

            return false;
        }

        $src_path = $this->_get_absolute_filename($src_path);

        if ($src_path === false || !is_file($src_path)) {

            if ($dynamic_output) {
                $this->_display_error(404);
            }

            return false;
        }

        // Get the name of a subdirectory that should contain the image's thumbnails.
        $image_cache_subdirectory = $this->_create_path_hash($src_path);
        $image_cache_path = ($public ? $this->image_public_cache_path : $this->image_cache_path).$image_cache_subdirectory.'/';

        // Get the image file extension.
        $src_name_parts = $this->ci->image_lib->explode_name($src_path);
        $ext = $src_name_parts['ext'];

        // Expose the image default parameters.
        extract($this->_get_image_defaults());

        // Prepare the input parameters.

        $w = (string) $width;
        $h = (string) $height;

        $no_crop = !empty($no_crop);
        $no_crop_saved = $no_crop;

        if ($force_crop) {
            $no_crop = false;
        }

        $keep_canvas_size = !empty($keep_canvas_size);

        // Determine whether dynamic input is enabled.

        if ($dynamic_output) {

            $dynamic_output_enabled = false;

            foreach ($this->enable_dynamic_output as & $d_location) {

                if (strpos($src_path, $d_location) === 0) {
                    $dynamic_output_enabled = true;
                }
            }

            unset($d_location);

            if (!$dynamic_output_enabled) {
                $this->_display_error(403);
            }
        }

        // Check whether the image is valid one.

        $prop = $this->ci->image_lib->get_image_properties($src_path, true);

        if ($prop === false) {

            if ($dynamic_output) {
                $this->_display_error(500);
            }

            return false;
        }

        $mime_type = $prop['mime_type'];
        $image_type = $prop['image_type'];
        $src_size = filesize($src_path);

        // The image seems to be valid, so create the corresponding
        // subdirectory that should contain the image's thumbnails.
        file_exists($image_cache_path) OR @mkdir($image_cache_path, 0755, TRUE);

        // Determine whether a watermark should be put.

        $has_watermark = false;

        foreach ($this->enable_watermark as & $wm_location) {

            if (strpos($src_path, $wm_location) === 0) {
                $has_watermark = true;
            }
        }

        unset($wm_location);

        // Determine kind of Image_lib's resizing operation is to be executed.

        $resize_operation = null;

        if ($w > 0) {

            $resize_operation = 'fit_width';
            $w = (int) $w;

        } else {

            $w = '';
        }

        if ($h > 0) {

            $resize_operation = $resize_operation == 'fit_width'
                ? ($no_crop ? ($keep_canvas_size ? 'fit_canvas' : 'fit_inner') : 'fit')
                : 'fit_height';

            $h = (int) $h;

        } else {

            $h = '';
        }

        if ($resize_operation == '') {

            $w = (int) $prop['width'];
            $h = (int) $prop['height'];

            $resize_operation = $keep_canvas_size ? 'fit_canvas' : 'fit_inner';
        }

        // Based on the real file name and the relevant parameters the thumbnail's
        // filename (a hash) is to be created. Let us determine these parameters.

        $parameters = compact(
            'src_path',
            'src_size',
            'resize_operation',
            'w',
            'h',
            'no_crop',
            'force_crop',
            'keep_canvas_size',
            'has_watermark'
        );

        if ($keep_canvas_size) {

            $parameters = array_merge($parameters, compact(
                'bg_r',
                'bg_g',
                'bg_b',
                'bg_alpha'
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
                    'wm_overlay_path',
                    'wm_opacity',
                    'wm_x_transp',
                    'wm_y_transp'
                ));
            }

            $parameters = array_merge($parameters, $wm_parameters);
        }

        // Determine the destination file.
        $cached_image_name = sha1(serialize($parameters)).$ext;
        $cached_image_file = $image_cache_path.$cached_image_name;

        // If the destination file does not exist - create it.

        if (!is_file($cached_image_file)) {

            // Resize the image and write it to destination file.

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

                if ($dynamic_output) {
                    $this->_display_error(500);
                }

                return false;
            }

            if ($resize_operation == 'fit_inner' || $resize_operation == 'fit_canvas') {
                $this->ci->image_lib->resize();
            } else {
                $this->ci->image_lib->fit();
            }

            $this->ci->image_lib->clear();

            // If the canvas size is to be preserved - add background with the
            // given width and height and place the image at the center.

            if ($resize_operation == 'fit_canvas') {

                $backgrund_image = @ tempnam(sys_get_temp_dir(), 'imp');

                if ($backgrund_image === false) {

                    @ unlink($cached_image_file);

                    if ($dynamic_output) {
                        $this->_display_error(500);
                    }

                    return false;
                }

                $img = imagecreatetruecolor($w, $h);
                imagesavealpha($img, true);
                $bg = imagecolorallocatealpha($img, $bg_r, $bg_g, $bg_b, $bg_alpha);
                imagefill($img, 0, 0, $bg);

                $this->ci->image_lib->image_type = $image_type;
                $this->ci->image_lib->full_dst_path = $backgrund_image;
                $this->ci->image_lib->quality = 100;

                if (!$this->ci->image_lib->image_save_gd($img)) {

                    @ unlink($backgrund_image);
                    @ unlink($cached_image_file);

                    if ($dynamic_output) {
                        $this->_display_error(500);
                    }

                    return false;
                }

                $this->ci->image_lib->clear();

                $config = array();
                $config['source_image'] = $backgrund_image;
                $config['wm_type'] = 'overlay';
                $config['wm_overlay_path'] = $cached_image_file;
                $config['wm_opacity'] = 100;
                $config['wm_hor_alignment'] = 'center';
                $config['wm_vrt_alignment'] = 'middle';
                $config['wm_x_transp'] = false;
                $config['wm_y_transp'] = false;
                $config['dynamic_output'] = false;
                $config['new_image'] = $cached_image_file;
                $config['quality'] = 100;

                if (!$this->ci->image_lib->initialize($config)) {

                    @ unlink($backgrund_image);
                    @ unlink($cached_image_file);

                    if ($dynamic_output) {
                        $this->_display_error(500);
                    }

                    return false;
                }

                if (!$this->ci->image_lib->watermark()) {

                    @ unlink($backgrund_image);
                    @ unlink($cached_image_file);

                    if ($dynamic_output) {
                        $this->_display_error(500);
                    }

                    return false;
                }

                @ unlink($backgrund_image);
                $this->ci->image_lib->clear();
            }

            // If a watermark is needed, place it.

            if ($has_watermark) {

                $prop_resized = $this->ci->image_lib->get_image_properties($cached_image_file, true);

                if ($prop_resized === false) {

                    @ unlink($cached_image_file);

                    if ($dynamic_output) {
                        $this->_display_error(500);
                    }

                    return false;
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

                        if ($dynamic_output) {
                            $this->_display_error(500);
                        }

                        return false;
                    }

                    if (!$this->ci->image_lib->watermark()) {

                        @ unlink($cached_image_file);

                        if ($dynamic_output) {
                            $this->_display_error(500);
                        }

                        return false;
                    }

                    $this->ci->image_lib->clear();
                }
            }
        }

        // Output or return the result.

        if ($dynamic_output) {
            $this->_display_graphic_file($cached_image_file, $mime_type, $cached_image_name);
        }

        if ($public) {

            return array(
                'path' => $cached_image_file,
                'url' => $this->image_public_cache_url.$image_cache_subdirectory.'/'.pathinfo($cached_image_file, PATHINFO_BASENAME),
            );
        }

        $uri = 'thumbnail';

        $url = http_build_url(default_base_url($uri), array(
                'query' => http_build_query(array(
                    'src' => $src,
                    'w' => $width,
                    'h' => $height,
                    'no_crop' => $no_crop_saved ? 0 : 1,
                    'keep_canvas_size' => $keep_canvas_size ? 0 : 1
                )
            )
        ), HTTP_URL_JOIN_QUERY);

        return array(
            'path' => $cached_image_file,
            'url' => $url,
        );
    }

    public function delete($src_path) {

        if (!is_file($src_path)) {
            return false;
        }

        $src_path = $this->_get_absolute_filename($src_path);

        if ($src_path === false || !is_file($src_path)) {
            return false;
        }

        $image_cache_subdirectory = $this->_create_path_hash($src_path);
        $image_cache_path = $this->image_cache_path.$image_cache_subdirectory.'/';
        $image_public_cache_path = $this->image_public_cache_path.$image_cache_subdirectory.'/';

        $this->ci->load->helper('file');

        delete_files($image_cache_path, true);
        delete_files($image_public_cache_path, true);

        return true;
    }

    protected function _get_absolute_dir($name) {

        $name = realpath($name);

        if ($name === false) {
            return false;
        }

        return str_replace('\\', '/', $name).'/';
    }

    protected function _get_absolute_filename($name) {

        $name = realpath($name);

        if ($name === false) {
            return false;
        }

        return str_replace('\\', '/', $name);
    }

    protected function _check_path($path) {

        $p = str_replace('\\', '/', $path);

        foreach (explode('/', $p) as $part) {

            if ($part == '..') {
                return false;
            }
        }

        return $path;
    }

    protected function _create_path_hash($path) {

        $path = str_replace('\\', '/', $path);

        if (($p = realpath($path)) !== false) {
            $path = str_replace('\\', '/', $p);
        }

        $result = sha1($path);

        return $result;
    }

    protected function _get_image_defaults() {

        return array_only(get_object_vars($this),array(
            'bg_r',
            'bg_g',
            'bg_b',
            'bg_alpha',

            'wm_enabled_min_w',
            'wm_enabled_min_h',

            'wm_type',
            'wm_padding',
            'wm_vrt_alignment',
            'wm_hor_alignment',
            'wm_hor_offset',
            'wm_vrt_offset',

            'wm_text',
            'wm_font_path',
            'wm_font_size',
            'wm_font_color',
            'wm_shadow_color',
            'wm_shadow_distance',

            'wm_overlay_path',
            'wm_opacity',
            'wm_x_transp',
            'wm_y_transp',

            'force_crop',
        ));
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

    protected function _display_error($code) {

        set_status_header($code);
        exit;
    }

}
