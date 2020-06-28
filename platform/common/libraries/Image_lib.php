<?php
/**
 * The original license header:
 *
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2019, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package     CodeIgniter
 * @author      EllisLab Dev Team
 * @copyright   Copyright (c) 2008 - 2014, EllisLab, Inc. (https://ellislab.com/)
 * @copyright   Copyright (c) 2014 - 2019, British Columbia Institute of Technology (http://bcit.ca/)
 * @license     http://opensource.org/licenses/MIT    MIT License
 * @link        https://codeigniter.com
 * @since       Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Image_lib extends CI_Image_lib
{
    /**
     * X-coordinate of the watermark's pixel which color is to be
     * set as transparent within the watermark before merging
     * with the source image. The value FALSE forces using only transparency
     * information inside the image, if present.
     * See https://github.com/bcit-ci/CodeIgniter/pull/3106
     *
     * @var int/bool
     */
    public $wm_x_transp = 4;

    /**
     * Y-coordinate of the watermark's pixel which color is to be
     * set as transparent within the watermark before merging
     * with the source image. The value FALSE forces using only transparency
     * information inside the image, if present.
     * See https://github.com/bcit-ci/CodeIgniter/pull/3106
     *
     * @var int/bool
     */
    public $wm_y_transp = 4;

    // The following properties are introduced for supporting
    // the additional method fit().
    public $user_width = 0;
    public $user_height = 0;
    public $user_x_axis = '';
    public $user_y_axis = '';

    public function __construct($props = array())
    {
        $this->file_permissions = FILE_WRITE_MODE;

        parent::__construct($props);
    }

    /**
     * Initialize image preferences
     *
     * @access    public
     * @param    array
     * @return    bool
     */
    public function initialize($props = array()) {

        $result = parent::initialize($props);

        // Save user specified dimensions and axis positions before they are modified by the CI library.

        if (isset($props['width'])) {
            $this->user_width = $props['width'];
        }

        if (isset($props['height'])) {
            $this->user_height = $props['height'];
        }

        if (isset($props['x_axis'])) {
            $this->user_x_axis = $props['x_axis'];
        }

        if (isset($props['y_axis'])) {
            $this->user_y_axis = $props['y_axis'];
        }

        return $result;
    }

    /**
     * Initialize image properties
     *
     * Resets values in case this class is used in a loop
     *
     * @access    public
     * @return    void
     */
    public function clear() {

        $result = parent::clear();

        $this->user_width = 0;
        $this->user_height = 0;
        $this->user_x_axis = '';
        $this->user_y_axis = '';

        return $result;
    }

    // --------------------------------------------------------------------

    /**
     * Image Process Using GD/GD2
     *
     * This function will resize or crop
     *
     * @param   string
     * @return  bool
     */
    public function image_process_gd($action = 'resize')
    {
        $v2_override = FALSE;

        // If the target width/height match the source, AND if the new file name is not equal to the old file name
        // we'll simply make a copy of the original with the new name... assuming dynamic rendering is off.
        if ($this->dynamic_output === FALSE && $this->orig_width === $this->width && $this->orig_height === $this->height)
        {
            if ($this->source_image !== $this->new_image && @copy($this->full_src_path, $this->full_dst_path))
            {
                // Modified by Ivan Tcholakov, 12-APR-2015.
                //chmod($this->full_dst_path, $this->file_permissions);
                @chmod($this->full_dst_path, $this->file_permissions);
                //
            }

            return TRUE;
        }

        // Let's set up our values based on the action
        if ($action === 'crop')
        {
            // Reassign the source width/height if cropping
            $this->orig_width  = $this->width;
            $this->orig_height = $this->height;

            // GD 2.0 has a cropping bug so we'll test for it
            if ($this->gd_version() !== FALSE)
            {
                $gd_version = str_replace('0', '', $this->gd_version());
                $v2_override = ($gd_version == 2);
            }
        }
        else
        {
            // If resizing the x/y axis must be zero
            $this->x_axis = 0;
            $this->y_axis = 0;
        }

        // Create the image handle
        if ( ! ($src_img = $this->image_create_gd()))
        {
            return FALSE;
        }

        /* Create the image
         *
         * Old conditional which users report cause problems with shared GD libs who report themselves as "2.0 or greater"
         * it appears that this is no longer the issue that it was in 2004, so we've removed it, retaining it in the comment
         * below should that ever prove inaccurate.
         *
         * if ($this->image_library === 'gd2' && function_exists('imagecreatetruecolor') && $v2_override === FALSE)
         */
        if ($this->image_library === 'gd2' && function_exists('imagecreatetruecolor'))
        {
            $create = 'imagecreatetruecolor';
            $copy   = 'imagecopyresampled';
        }
        else
        {
            $create = 'imagecreate';
            $copy   = 'imagecopyresized';
        }

        $dst_img = $create($this->width, $this->height);

        // Fix for losing image transparency
        // author Yorick Peterse - PyroCMS Dev Team
        //
        //if ($this->image_type === 3) // png we can actually preserve transparency
        //{
        //    imagealphablending($dst_img, FALSE);
        //    imagesavealpha($dst_img, TRUE);
        //}
        //
        // Fix image transparency. Taken from https://codeigniter.com/forums/viewthread/150527/
        if ( $this->image_library == 'gd2' )
        {
            $transparencyIndex = imagecolortransparent($src_img);
            $transparencyColor = array('red' => 255, 'green' => 255, 'blue' => 255);

            // Modified by Ivan Tcholakov, 31-AUG-2014.
            // Dealing with "Color index out of range" error.
            //if ($transparencyIndex >= 0)
            if ($transparencyIndex >= 0 && imagecolorstotal($src_img) > $transparencyIndex)
            //
            {
                $transparencyColor    = imagecolorsforindex($src_img, $transparencyIndex);
            }

            $transparencyIndex = imagecolorallocate($dst_img, $transparencyColor['red'], $transparencyColor['green'], $transparencyColor['blue']);
            imagefill($dst_img, 0, 0, $transparencyIndex);
            imagecolortransparent($dst_img, $transparencyIndex);
        }
        //

        $copy($dst_img, $src_img, 0, 0, $this->x_axis, $this->y_axis, $this->width, $this->height, $this->orig_width, $this->orig_height);

        // Show the image
        if ($this->dynamic_output === TRUE)
        {
            $this->image_display_gd($dst_img);
        }
        elseif ( ! $this->image_save_gd($dst_img)) // Or save it
        {
            return FALSE;
        }

        // Kill the file handles
        imagedestroy($dst_img);
        imagedestroy($src_img);

        if ($this->dynamic_output !== TRUE)
        {
            // Modified by Ivan Tcholakov, 12-APR-2015.
            //chmod($this->full_dst_path, $this->file_permissions);
            @chmod($this->full_dst_path, $this->file_permissions);
            //
        }

        return TRUE;
    }

    // --------------------------------------------------------------------

    /**
     * Image Process Using ImageMagick
     *
     * This function will resize, crop or rotate
     *
     * @param    string
     * @return    bool
     */
    public function image_process_imagemagick($action = 'resize')
    {
        // Do we have a vaild library path?
        if ($this->library_path === '')
        {
            $this->set_error('imglib_libpath_invalid');
            return FALSE;
        }

        if ( ! preg_match('/convert$/i', $this->library_path))
        {
            $this->library_path = rtrim($this->library_path, '/').'/convert';
        }

        // Execute the command
        $cmd = $this->library_path.' -quality '.$this->quality;

        if ($action === 'crop')
        {
            $cmd .= ' -crop '.$this->width.'x'.$this->height.'+'.$this->x_axis.'+'.$this->y_axis;
        }
        elseif ($action === 'rotate')
        {
            $cmd .= ($this->rotation_angle === 'hor' OR $this->rotation_angle === 'vrt')
                    ? ' -flop'
                    : ' -rotate '.$this->rotation_angle;
        }
        else // Resize
        {
            if($this->maintain_ratio === TRUE)
            {
                $cmd .= ' -resize '.$this->width.'x'.$this->height;
            }
            else
            {
                $cmd .= ' -resize '.$this->width.'x'.$this->height.'\!';
            }
        }

        $cmd .= ' '.escape_shell_arg($this->full_src_path).' '.escape_shell_arg($this->full_dst_path).' 2>&1';

        $retval = 1;
        // exec() might be disabled
        if (function_usable('exec'))
        {
            @exec($cmd, $output, $retval);
        }

        // Did it work?
        if ($retval > 0)
        {
            $this->set_error('imglib_image_process_failed');
            return FALSE;
        }

        // Modified by Ivan Tcholakov, 12-APR-2015.
        //chmod($this->full_dst_path, $this->file_permissions);
        @chmod($this->full_dst_path, $this->file_permissions);
        //

        return TRUE;
    }

    // --------------------------------------------------------------------

    /**
     * Image Process Using NetPBM
     *
     * This function will resize, crop or rotate
     *
     * @param    string
     * @return    bool
     */
    public function image_process_netpbm($action = 'resize')
    {
        if ($this->library_path === '')
        {
            $this->set_error('imglib_libpath_invalid');
            return FALSE;
        }

        // Build the resizing command
        switch ($this->image_type)
        {
            case 1 :
                $cmd_in        = 'giftopnm';
                $cmd_out    = 'ppmtogif';
                break;
            case 2 :
                $cmd_in        = 'jpegtopnm';
                $cmd_out    = 'ppmtojpeg';
                break;
            case 3 :
                $cmd_in        = 'pngtopnm';
                $cmd_out    = 'ppmtopng';
                break;
        }

        if ($action === 'crop')
        {
            $cmd_inner = 'pnmcut -left '.$this->x_axis.' -top '.$this->y_axis.' -width '.$this->width.' -height '.$this->height;
        }
        elseif ($action === 'rotate')
        {
            switch ($this->rotation_angle)
            {
                case 90:    $angle = 'r270';
                    break;
                case 180:    $angle = 'r180';
                    break;
                case 270:    $angle = 'r90';
                    break;
                case 'vrt':    $angle = 'tb';
                    break;
                case 'hor':    $angle = 'lr';
                    break;
            }

            $cmd_inner = 'pnmflip -'.$angle.' ';
        }
        else // Resize
        {
            $cmd_inner = 'pnmscale -xysize '.$this->width.' '.$this->height;
        }

        $cmd = $this->library_path.$cmd_in.' '.escape_shell_arg($this->full_src_path).' | '.$cmd_inner.' | '.$cmd_out.' > '.$this->dest_folder.'netpbm.tmp';

        $retval = 1;
        // exec() might be disabled
        if (function_usable('exec'))
        {
            @exec($cmd, $output, $retval);
        }

        // Did it work?
        if ($retval > 0)
        {
            $this->set_error('imglib_image_process_failed');
            return FALSE;
        }

        // With NetPBM we have to create a temporary image.
        // If you try manipulating the original it fails so
        // we have to rename the temp file.
        copy($this->dest_folder.'netpbm.tmp', $this->full_dst_path);
        unlink($this->dest_folder.'netpbm.tmp');
        // Modified by Ivan Tcholakov, 12-APR-2015.
        //chmod($this->full_dst_path, $this->file_permissions);
        @chmod($this->full_dst_path, $this->file_permissions);
        //

        return TRUE;
    }

    // --------------------------------------------------------------------

    /**
     * Image Rotate Using GD
     *
     * @return    bool
     */
    public function image_rotate_gd()
    {
        // Create the image handle
        if ( ! ($src_img = $this->image_create_gd()))
        {
            return FALSE;
        }

        // Set the background color
        // This won't work with transparent PNG files so we are
        // going to have to figure out how to determine the color
        // of the alpha channel in a future release.

        $white = imagecolorallocate($src_img, 255, 255, 255);

        // Rotate it!
        $dst_img = imagerotate($src_img, $this->rotation_angle, $white);

        // Show the image
        if ($this->dynamic_output === TRUE)
        {
            $this->image_display_gd($dst_img);
        }
        elseif ( ! $this->image_save_gd($dst_img)) // ... or save it
        {
            return FALSE;
        }

        // Kill the file handles
        imagedestroy($dst_img);
        imagedestroy($src_img);

        // Modified by Ivan Tcholakov, 12-APR-2015.
        //chmod($this->full_dst_path, $this->file_permissions);
        @chmod($this->full_dst_path, $this->file_permissions);
        //

        return TRUE;
    }

    // --------------------------------------------------------------------

    /**
     * Create Mirror Image using GD
     *
     * This function will flip horizontal or vertical
     *
     * @return    bool
     */
    public function image_mirror_gd()
    {
        if ( ! $src_img = $this->image_create_gd())
        {
            return FALSE;
        }

        $width  = $this->orig_width;
        $height = $this->orig_height;

        if ($this->rotation_angle === 'hor')
        {
            for ($i = 0; $i < $height; $i++)
            {
                $left = 0;
                $right = $width - 1;

                while ($left < $right)
                {
                    $cl = imagecolorat($src_img, $left, $i);
                    $cr = imagecolorat($src_img, $right, $i);

                    imagesetpixel($src_img, $left, $i, $cr);
                    imagesetpixel($src_img, $right, $i, $cl);

                    $left++;
                    $right--;
                }
            }
        }
        else
        {
            for ($i = 0; $i < $width; $i++)
            {
                $top = 0;
                $bottom = $height - 1;

                while ($top < $bottom)
                {
                    $ct = imagecolorat($src_img, $i, $top);
                    $cb = imagecolorat($src_img, $i, $bottom);

                    imagesetpixel($src_img, $i, $top, $cb);
                    imagesetpixel($src_img, $i, $bottom, $ct);

                    $top++;
                    $bottom--;
                }
            }
        }

        // Show the image
        if ($this->dynamic_output === TRUE)
        {
            $this->image_display_gd($src_img);
        }
        elseif ( ! $this->image_save_gd($src_img)) // ... or save it
        {
            return FALSE;
        }

        // Kill the file handles
        imagedestroy($src_img);

        // Modified by Ivan Tcholakov, 12-APR-2015.
        //chmod($this->full_dst_path, $this->file_permissions);
        @chmod($this->full_dst_path, $this->file_permissions);
        //

        return TRUE;
    }

    // --------------------------------------------------------------------

    /**
     * Watermark - Graphic Version
     *
     * @return    bool
     */
    public function overlay_watermark()
    {
        if ( ! function_exists('imagecolortransparent'))
        {
            $this->set_error('imglib_gd_required');
            return FALSE;
        }

        // Fetch source image properties
        $this->get_image_properties();

        // Fetch watermark image properties
        $props        = $this->get_image_properties($this->wm_overlay_path, TRUE);
        $wm_img_type    = $props['image_type'];
        $wm_width    = $props['width'];
        $wm_height    = $props['height'];

        // Create two image resources
        $wm_img  = $this->image_create_gd($this->wm_overlay_path, $wm_img_type);
        $src_img = $this->image_create_gd($this->full_src_path);

        // Reverse the offset if necessary
        // When the image is positioned at the bottom
        // we don't want the vertical offset to push it
        // further down. We want the reverse, so we'll
        // invert the offset. Same with the horizontal
        // offset when the image is at the right

        $this->wm_vrt_alignment = strtoupper($this->wm_vrt_alignment[0]);
        $this->wm_hor_alignment = strtoupper($this->wm_hor_alignment[0]);

        if ($this->wm_vrt_alignment === 'B')
            $this->wm_vrt_offset = $this->wm_vrt_offset * -1;

        if ($this->wm_hor_alignment === 'R')
            $this->wm_hor_offset = $this->wm_hor_offset * -1;

        // Set the base x and y axis values
        $x_axis = $this->wm_hor_offset + $this->wm_padding;
        $y_axis = $this->wm_vrt_offset + $this->wm_padding;

        // Set the vertical position
        if ($this->wm_vrt_alignment === 'M')
        {
            $y_axis += ($this->orig_height / 2) - ($wm_height / 2);
        }
        elseif ($this->wm_vrt_alignment === 'B')
        {
            $y_axis += $this->orig_height - $wm_height;
        }

        // Set the horizontal position
        if ($this->wm_hor_alignment === 'C')
        {
            $x_axis += ($this->orig_width / 2) - ($wm_width / 2);
        }
        elseif ($this->wm_hor_alignment === 'R')
        {
            $x_axis += $this->orig_width - $wm_width;
        }

        // Build the finalized image
        if ($wm_img_type === 3 && function_exists('imagealphablending'))
        {
            @imagealphablending($src_img, TRUE);
        }

        // Set RGB values for text and shadow
        $rgba = imagecolorat($wm_img, (int) $this->wm_x_transp, (int) $this->wm_y_transp);
        $alpha = ($rgba & 0x7F000000) >> 24;

        // make a best guess as to whether we're dealing with an image with alpha transparency or no/binary transparency
        if ($alpha > 0)
        {
            // copy the image directly, the image's alpha transparency being the sole determinant of blending
            imagecopy($src_img, $wm_img, $x_axis, $y_axis, 0, 0, $wm_width, $wm_height);
        }
        else
        {
            if ($this->wm_x_transp !== FALSE && $this->wm_y_transp !== FALSE)
            {
                // Set our RGB value from above to be transparent.
                imagecolortransparent($wm_img, imagecolorat($wm_img, $this->wm_x_transp, $this->wm_y_transp));
            }

            // Merge the images with the specified opacity.
            imagecopymerge($src_img, $wm_img, $x_axis, $y_axis, 0, 0, $wm_width, $wm_height, $this->wm_opacity);
        }

        // We can preserve transparency for PNG images
        if ($this->image_type === 3)
        {
            imagealphablending($src_img, FALSE);
            imagesavealpha($src_img, TRUE);
        }

        // Output the image
        if ($this->dynamic_output === TRUE)
        {
            $this->image_display_gd($src_img);
        }
        elseif ( ! $this->image_save_gd($src_img)) // ... or save it
        {
            return FALSE;
        }

        imagedestroy($src_img);
        imagedestroy($wm_img);

        return TRUE;
    }

    // --------------------------------------------------------------------

    /**
     * Get image properties
     *
     * A helper function that gets info about the file
     *
     * @param    string
     * @param    bool
     * @return    mixed
     */
    public function get_image_properties($path = '', $return = FALSE)
    {
        // For now we require GD but we should
        // find a way to determine this using IM or NetPBM

        if ($path === '')
        {
            $path = $this->full_src_path;
        }

        if ( ! file_exists($path))
        {
            $this->set_error('imglib_invalid_path');
            return FALSE;
        }

        $vals = @ getimagesize($path);
        if ($vals === FALSE)
        {
            $this->set_error('imglib_invalid_image');
            return FALSE;
        }

        $types = array(1 => 'gif', 2 => 'jpeg', 3 => 'png');
        $mime = isset($types[$vals[2]]) ? 'image/'.$types[$vals[2]] : 'image/jpg';

        if ($return === TRUE)
        {
            return array(
                'width'      => $vals[0],
                'height'     => $vals[1],
                'image_type' => $vals[2],
                'size_str'   => $vals[3],
                'mime_type'  => $mime
            );
        }

        $this->orig_width  = $vals[0];
        $this->orig_height = $vals[1];
        $this->image_type  = $vals[2];
        $this->size_str    = $vals[3];
        $this->mime_type   = $mime;

        return TRUE;
    }


    // --------------------------------------------------------------------

    /**
     * Create Image - GD
     *
     * This simply creates an image resource handle
     * based on the type of image being processed
     *
     * @param    string
     * @param   string
     * @return  resource
     */
    public function image_create_gd($path = '', $image_type = '')
    {
        if ($path === '')
        {
            $path = $this->full_src_path;
        }

        if ($image_type === '')
        {
            $image_type = $this->image_type;
        }

        switch ($image_type)
        {
            case 1:
                if ( ! function_exists('imagecreatefromgif'))
                {
                    $this->set_error(array('imglib_unsupported_imagecreate', 'imglib_gif_not_supported'));
                    return FALSE;
                }

                // Modified by Ivan Tcholakov, 08-SEP-2011.
                //return imagecreatefromgif($path);
                return @ imagecreatefromgif($path);
                //
            case 2 :
                if ( ! function_exists('imagecreatefromjpeg'))
                {
                    $this->set_error(array('imglib_unsupported_imagecreate', 'imglib_jpg_not_supported'));
                    return FALSE;
                }

                // Modified by Ivan Tcholakov, 08-SEP-2011.
                //return imagecreatefromjpeg($path);
                return @ imagecreatefromjpeg($path);
                //
            case 3 :
                if ( ! function_exists('imagecreatefrompng'))
                {
                    $this->set_error(array('imglib_unsupported_imagecreate', 'imglib_png_not_supported'));
                    return FALSE;
                }

                // Modified by Ivan Tcholakov, 08-SEP-2011.
                //return imagecreatefrompng($path);
                return @ imagecreatefrompng($path);
                //
            default:
                $this->set_error(array('imglib_unsupported_imagecreate'));
                return FALSE;
        }
    }

    // ====================================================================

    /**
     * The method fit() have been taken from
     * @link https://github.com/jenssegers/codeigniter-advanced-images/
     *
     * See @link http://jenssegers.be/blog/31/codeigniter-resizing-and-cropping-images-on-the-fly
     * See @link http://kennykee.com/138/codeigniter-resize-and-crop-image-to-fit-container-div-example/
     *
     * @name            CodeIgniter Advanced Images
     * @author          Jens Segers
     * @link            http://www.jenssegers.be
     * @license         MIT License Copyright (c) 2012 Jens Segers
     *
     * Permission is hereby granted, free of charge, to any person obtaining a copy
     * of this software and associated documentation files (the "Software"), to deal
     * in the Software without restriction, including without limitation the rights
     * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
     * copies of the Software, and to permit persons to whom the Software is
     * furnished to do so, subject to the following conditions:
     *
     * The above copyright notice and this permission notice shall be included in
     * all copies or substantial portions of the Software.
     *
     * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
     * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
     * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
     * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
     * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
     * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
     * THE SOFTWARE.
     */

    /**
     * Smart resize and crop function
     *
     * @access      public
     * @return      bool
     */
    public function fit() {

        // Overwrite the dimensions with the original user specified dimensions.
        $this->width = $this->user_width;
        $this->height = $this->user_height;

        // We will calculate the sizes ourselves.
        $this->maintain_ratio = FALSE;

        // ------------------------------------------------------------------------------------------
        // Mode 1: Auto-scale the image to fit 1 dimension.
        // ------------------------------------------------------------------------------------------

        if ($this->user_width == 0 || $this->user_height == 0) {

            // Calculate missing dimension.
            if ($this->user_width == 0) {
                @ $this->width = ceil($this->user_height * $this->orig_width / $this->orig_height);
            } else {
                @ $this->height = ceil($this->user_width * $this->orig_height / $this->orig_width);
            }

            // No cropping is needed, just resize.
            return $this->resize();
        }

        // ------------------------------------------------------------------------------------------
        // Mode 2: Resize and crop the image to fit both dimensions.
        // ------------------------------------------------------------------------------------------

        @ $this->width = ceil($this->user_height * $this->orig_width / $this->orig_height);
        @ $this->height = ceil($this->user_width * $this->orig_height / $this->orig_width);

        if (($this->user_width != $this->width) && ($this->user_height != $this->height)) {

            if ($this->master_dim == 'height') {
                $this->width = $this->user_width;
            } else {
                $this->height = $this->user_height;
            }
        }

        // Save dynamic output for last.
        $dynamic_output = $this->dynamic_output;
        $this->dynamic_output = FALSE;

        // If dynamic output is requested we will use a temporary file to work on.

        $tempfile = FALSE;

        if ($dynamic_output) {

            $image_temp_path = TMP_PATH.'image_lib/';
            file_exists($image_temp_path) OR @mkdir($image_temp_path, DIR_WRITE_MODE, TRUE);
            $tempfile = $image_temp_path.'image_lib_'.rand(0, getrandmax()).rand(0, getrandmax()).'.tmp';
            $this->full_dst_path = $tempfile;
        }

        // Resize stage
        if (!$this->resize()) {

            // Reset dynamic output to initial value.
            $this->dynamic_output = $dynamic_output;

            return FALSE;
        }

        // Axis settings
        if (!is_numeric($this->user_x_axis)) {
            $this->x_axis = floor(($this->width - $this->user_width) / 2);
        } else {
            $this->x_axis = $this->user_x_axis;
        }

        if (!is_numeric($this->user_y_axis)) {
            $this->y_axis = floor(($this->height - $this->user_height) / 2);
        } else {
            $this->y_axis = $this->user_y_axis;
        }

        // Cropping options
        $this->orig_width = $this->width;
        $this->orig_height = $this->height;
        $this->width = $this->user_width;
        $this->height = $this->user_height;

        // Use the previous generated image for output.
        $this->full_src_path = $this->full_dst_path;

        // Reset dynamic output to initial value.
        $this->dynamic_output = $dynamic_output;

        // Cropping stage
        if (!$this->crop()) {
            return FALSE;
        }

        // Close (and remove) the temporary file.
        if ($tempfile != '') {
            @ unlink($tempfile);
        }

        return TRUE;
    }

}
