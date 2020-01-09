<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * KCAPTCHA PROJECT VERSION 2.0
 *
 * Automatic test to tell computers and humans apart
 *
 * Copyright by Kruglov Sergei, 2006, 2007, 2008, 2011
 * www.captcha.ru, www.kruglov.ru
 *
 * System requirements: PHP 4.0.6+ w/ GD
 *
 * KCAPTCHA is a free software. You can freely use it for developing own site or software.
 * If you use this software as a part of own sofware, you must leave copyright notices intact or add KCAPTCHA copyright notices to own.
 * As a default configuration, KCAPTCHA has a small credits text at bottom of CAPTCHA image.
 * You can remove it, but I would be pleased if you left it. ;)
 *
 * -----------------------------------------------------------------------------
 *
 * Ported for CodeIgniter by Ivan Tcholakov, 2013-2020.
 * Code repository: https://github.com/ivantcholakov/codeigniter-kcaptcha
 *
 * Important note: This feature requires Session library/driver to be loaded.
 */

class Kcaptcha {

    public $width;
    public $height;
    public $length;
    public $allowed_symbols;
    public $src;

    protected $config;

    protected $ci;

    /**
     * The constructor.
     */
    public function __construct($config = array()) {

        $this->ci = get_instance();
        $this->ci->load->helper('url');

        // KCAPTCHA configuration settings

        $alphabet = '0123456789abcdefghijklmnopqrstuvwxyz'; // Do not change without changing font files!

        // Symbols used to draw CAPTCHA
        //$allowed_symbols = '0123456789';  // digits
        //$allowed_symbols = '23456789abcdegkmnpqsuvxyz';   // alphabet without similar symbols (o=0, 1=l, i=j, t=f)
        $allowed_symbols = '23456789abcdegikpqsvxyz';       // alphabet without similar symbols (o=0, 1=l, i=j, t=f)

        // folder with fonts
        $fontsdir = 'kcaptcha_fonts';

        // CAPTCHA string length
        $length = mt_rand(5, 7);    // random 5 or 6 or 7
        //$length = 6;

        // CAPTCHA image size (you do not need to change it, this parameters is optimal)
        $width = 160;
        $height = 80;

        // symbol's vertical fluctuation amplitude
        $fluctuation_amplitude = 8;

        // noise
        //$white_noise_density = 0; // no white noise
        $white_noise_density = 1/6;
        //$black_noise_density = 0; // no black noise
        $black_noise_density = 1/30;

        // increase safety by prevention of spaces between symbols
        $no_spaces = true;

        // show credits
        $show_credits = true; // set to false to remove credits line. Credits adds 12 pixels to image height
        $credits = 'www.captcha.ru'; // if empty, HTTP_HOST will be shown

        // CAPTCHA image colors (RGB, 0-255)
        //$foreground_color = array(0, 0, 0);
        //$background_color = array(220, 230, 255);
        $foreground_color = array(mt_rand(0, 80), mt_rand(0, 80), mt_rand(0, 80));
        $background_color = array(mt_rand(220, 255), mt_rand(220, 255), mt_rand(220, 255));

        $foreground_color_saved = $foreground_color;
        $background_color_saved = $background_color;

        // JPEG quality of CAPTCHA image (0 - 100, bigger is better quality, but larger file size)
        $jpeg_quality = 100;

        // PNG quality of CAPTCHA image (0 - 9, smaller is better quality)
        $png_quality = 0;

        // Captha image source (URI).
        $src = site_url('captcha');

        extract($config, EXTR_IF_EXISTS);

        if (empty($foreground_color)) {
            $foreground_color = $foreground_color_saved;
        }

        if (empty($background_color)) {
            $background_color = $background_color_saved;
        }

        $this->width = (int) $width;
        $this->height = (int) ($show_credits ? $height + 12 : $height);
        $this->length = (int) $length;
        $this->allowed_symbols = $allowed_symbols;
        $this->src = $src;

        $this->config = compact(
            'alphabet',
            'allowed_symbols',
            'fontsdir',
            'length',
            'width',
            'height',
            'fluctuation_amplitude',
            'white_noise_density',
            'black_noise_density',
            'no_spaces',
            'show_credits',
            'credits',
            'foreground_color',
            'background_color',
            'jpeg_quality',
            'png_quality',
            'src'
        );
    }

    /**
     * Creates and outputs to the browser a captcha image.
     * Also stores correponding keystring within a session variable
     * for later user input validance check.
     */
    public function create() {

        extract($this->config);

        $fonts = array();

        $fontsdir_absolute = dirname(__FILE__).'/'.$fontsdir;

        if ($handle = opendir($fontsdir_absolute)) {

            while (false !== ($file = readdir($handle))) {

                if (preg_match('/\.png$/i', $file)) {
                    $fonts[] = $fontsdir_absolute.'/'.$file;
                }
            }

            closedir($handle);
        }

        $alphabet_length = strlen($alphabet);

        do {

            // Generate random keystring.
            $keystring = $this->generate_keystring();

            // Store the generated keystring within session.
            $this->ci->session->set_userdata('kcaptcha_keystring', $keystring);

            $font_file = $fonts[mt_rand(0, count($fonts) - 1)];
            $font = imagecreatefrompng($font_file);
            imagealphablending($font, true);

            $fontfile_width = imagesx($font);
            $fontfile_height = imagesy($font) - 1;

            $font_metrics = array();
            $symbol = 0;
            $reading_symbol = false;

            // loading font
            for ($i = 0; $i < $fontfile_width && $symbol < $alphabet_length; $i++) {

                $transparent = (imagecolorat($font, $i, 0) >> 24) == 127;

                if (!$reading_symbol && !$transparent) {

                    $font_metrics[$alphabet[$symbol]] = array('start' => $i);
                    $reading_symbol = true;
                    continue;
                }

                if ($reading_symbol && $transparent) {

                    $font_metrics[$alphabet[$symbol]]['end'] = $i;
                    $reading_symbol = false;
                    $symbol++;
                    continue;
                }
            }

            $img = imagecreatetruecolor($width, $height);
            imagealphablending($img, true);
            $white = imagecolorallocate($img, 255, 255, 255);
            $black = imagecolorallocate($img, 0, 0, 0);

            imagefilledrectangle($img, 0, 0, $width - 1, $height - 1, $white);

            // draw text
            $x = 1;
            $odd = mt_rand(0, 1);

            if ($odd == 0) {
                $odd = -1;
            }

            for ($i = 0; $i < $length; $i++) {

                $m = $font_metrics[$keystring[$i]];

                $y = (($i%2)*$fluctuation_amplitude - $fluctuation_amplitude/2)*$odd
                    + mt_rand(-round($fluctuation_amplitude/3), round($fluctuation_amplitude/3))
                    + ($height-$fontfile_height)/2;

                if ($no_spaces) {

                    $shift = 0;

                    if ($i > 0) {

                        $shift = 10000;

                        for ($sy = 3; $sy < $fontfile_height - 10; $sy += 1) {

                            for ($sx = $m['start'] - 1; $sx < $m['end']; $sx += 1) {

                                $rgb = imagecolorat($font, $sx, $sy);
                                $opacity = $rgb>>24;

                                if ($opacity < 127) {

                                    $left = $sx - $m['start'] + $x;
                                    $py = $sy + $y;

                                    if ($py > $height) {
                                        break;
                                    }

                                    for ($px = min($left, $width - 1); $px > $left - 200 && $px >= 0; $px -= 1) {

                                        $color = imagecolorat($img, $px, $py) & 0xff;

                                        if ($color + $opacity < 170) { // 170 - threshold

                                            if ($shift > $left - $px) {
                                                $shift = $left - $px;
                                            }

                                            break;
                                        }
                                    }

                                    break;
                                }
                            }
                        }

                        if ($shift == 10000) {
                            $shift = mt_rand(4, 6);
                        }
                    }

                } else {

                    $shift = 1;
                }

                imagecopy($img, $font, $x-$shift, $y, $m['start'], 1, $m['end'] - $m['start'], $fontfile_height);
                $x += $m['end'] - $m['start'] - $shift;
            }

        } while ($x >= $width - 10); // while not fit in canvas

        // noise
        $white = imagecolorallocate($font, 255, 255, 255);
        $black = imagecolorallocate($font, 0, 0, 0);

        for ($i = 0; $i < (($height - 30)*$x)*$white_noise_density; $i++) {
            imagesetpixel($img, mt_rand(0, $x - 1), mt_rand(10, $height - 15), $white);
        }

        for ($i = 0; $i < (($height - 30)*$x)*$black_noise_density; $i++) {
            imagesetpixel($img, mt_rand(0, $x - 1), mt_rand(10, $height - 15), $black);
        }


        $center = $x/2;

        // credits. To remove, see configuration file

        $img2 = imagecreatetruecolor($width, $height + ($show_credits ? 12 : 0));
        $foreground = imagecolorallocate($img2, $foreground_color[0], $foreground_color[1], $foreground_color[2]);
        $background = imagecolorallocate($img2, $background_color[0], $background_color[1], $background_color[2]);
        imagefilledrectangle($img2, 0, 0, $width - 1, $height - 1, $background);
        imagefilledrectangle($img2, 0, $height, $width - 1, $height + 12, $foreground);
        $credits = empty($credits) ? $_SERVER['HTTP_HOST'] : $credits;
        imagestring($img2, 2, $width/2 - imagefontwidth(2)*strlen($credits)/2, $height - 2, $credits, $background);

        // periods
        $rand1 = mt_rand(750000,1200000)/10000000;
        $rand2 = mt_rand(750000,1200000)/10000000;
        $rand3 = mt_rand(750000,1200000)/10000000;
        $rand4 = mt_rand(750000,1200000)/10000000;

        // phases
        $rand5 = mt_rand(0,31415926)/10000000;
        $rand6 = mt_rand(0,31415926)/10000000;
        $rand7 = mt_rand(0,31415926)/10000000;
        $rand8 = mt_rand(0,31415926)/10000000;

        // amplitudes
        $rand9 = mt_rand(330,420)/110;
        $rand10 = mt_rand(330,450)/100;

        // wave distortion

        for ($x = 0; $x < $width; $x++) {

            for ($y = 0; $y < $height; $y++) {

                $sx = $x + (sin($x*$rand1 + $rand5) + sin($y*$rand3 + $rand6))*$rand9 - $width/2 + $center + 1;
                $sy = $y + (sin($x*$rand2 + $rand7) + sin($y*$rand4 + $rand8))*$rand10;

                if ($sx < 0 || $sy < 0 || $sx >= $width - 1 || $sy >= $height - 1) {

                    continue;

                } else {

                    $color = imagecolorat($img, $sx, $sy) & 0xFF;
                    $color_x = imagecolorat($img, $sx + 1, $sy) & 0xFF;
                    $color_y = imagecolorat($img, $sx, $sy + 1) & 0xFF;
                    $color_xy = imagecolorat($img, $sx + 1, $sy + 1) & 0xFF;
                }

                if ($color == 255 && $color_x == 255 && $color_y == 255 && $color_xy == 255) {

                    continue;

                } elseif ($color == 0 && $color_x == 0 && $color_y == 0 && $color_xy == 0) {

                    $newred = $foreground_color[0];
                    $newgreen = $foreground_color[1];
                    $newblue = $foreground_color[2];

                } else {

                    $frsx = $sx - floor($sx);
                    $frsy = $sy - floor($sy);
                    $frsx1 = 1 - $frsx;
                    $frsy1 = 1 - $frsy;

                    $newcolor = (
                        $color*$frsx1*$frsy1 +
                        $color_x*$frsx*$frsy1 +
                        $color_y*$frsx1*$frsy +
                        $color_xy*$frsx*$frsy
                    );

                    if ($newcolor > 255) {
                        $newcolor = 255;
                    }

                    $newcolor = $newcolor/255;
                    $newcolor0 = 1 - $newcolor;

                    $newred = $newcolor0*$foreground_color[0] + $newcolor*$background_color[0];
                    $newgreen = $newcolor0*$foreground_color[1] + $newcolor*$background_color[1];
                    $newblue = $newcolor0*$foreground_color[2] + $newcolor*$background_color[2];
                }

                imagesetpixel($img2, $x, $y, imagecolorallocate($img2, $newred, $newgreen, $newblue));
            }
        }

        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Cache-Control: no-store, no-cache, must-revalidate');
        header('Cache-Control: post-check=0, pre-check=0', FALSE);
        header('Pragma: no-cache');

        if (function_exists('imagejpeg')) {

            header('Content-Type: image/jpeg');
            imagejpeg($img2, null, $jpeg_quality);

        } elseif (function_exists('imagegif')) {

            header('Content-Type: image/gif');
            imagegif($img2);

        } elseif (function_exists('imagepng')) {

            header('Content-Type: image/x-png');
            imagepng($img2, null, $png_quality);
        }

        exit;
    }

    /**
     * Generates a random captcha keystring.
     */
    public function generate_keystring() {

        $allowed_symbols = $this->config['allowed_symbols'];
        $length = $this->config['length'];

        $allowed_symbols_length = strlen($allowed_symbols);

        $counter = 0;

        // Try to generate a good keystring limited number of times
        while ($counter < 50) {

            $keystring = '';

            for ($i = 0; $i < $length; $i++) {
                $keystring .= $allowed_symbols[mt_rand(0, $allowed_symbols_length - 1)];
            }

            if (!preg_match('/cp|cb|ck|c6|c9|rn|rm|mm|co|do|cl|db|qp|qb|dp|ww/', $keystring)) {
                break;
            }

            $counter++;
        }

        return $keystring;
    }

    /**
     * A getter for generated keystring after captcha image has been created.
     */
    public function get_keystring() {

        return (string) $this->ci->session->userdata('kcaptcha_keystring');
    }

    /**
     * Check whether user input string matches to captcha keystring.
     * @param       string      $input_string       The user input string.
     * @return      boolean                         The result of this check.
     */
    public function valid($input_string) {

        $input_string = (string) $input_string;
        $captcha_keystring = $this->get_keystring();

        if ($input_string != '' && $captcha_keystring != '') {

            $result = $input_string == $captcha_keystring;

        } else {

            $result = false;
        }

        return $result;
    }

    /**
     * Deletes captcha keystring from session.
     */
    public function clear() {

        $this->ci->session->unset_userdata('kcaptcha_keystring');
    }

}
