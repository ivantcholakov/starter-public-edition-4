<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Image_lib extends CI_Image_lib
{
    public $user_width = 0;
    public $user_height = 0;
    public $user_x_axis = '';
    public $user_y_axis = '';

    public function __construct($props = array())
    {
        parent::__construct($props);
    }

    /**
     * Initialize image preferences
     *
     * @access	public
     * @param	array
     * @return	bool
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
     * @access	public
     * @return	void
     */
    public function clear() {

        $result = parent::clear();

        $this->user_width = 0;
        $this->user_height = 0;
        $this->user_x_axis = '';
        $this->user_y_axis = '';

        return $result;
    }

    /**
     * The method fit() and supporting it code have been taken from
     * @link https://github.com/jenssegers/codeigniter-advanced-images/
     *
     * See @link http://jenssegers.be/blog/31/codeigniter-resizing-and-cropping-images-on-the-fly
     * See @link http://kennykee.com/138/codeigniter-resize-and-crop-image-to-fit-container-div-example/
     *
     * @name		CodeIgniter Advanced Images
     * @author		Jens Segers
     * @link		http://www.jenssegers.be
     * @license		MIT License Copyright (c) 2012 Jens Segers
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
     * @access	public
     * @return	bool
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

            $temp = tmpfile();
            $tempfile = array_search('uri', @array_flip(stream_get_meta_data($temp)));
            $this->full_dst_path = $tempfile;
        }

        // Resize stage
        if (!$this->resize()) {
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
        if ($tempfile) {
            @ fclose($temp);
        }

        return TRUE;
    }

    //--------------------------------------------------------------------------
    // Patches
    //--------------------------------------------------------------------------

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
                @chmod($this->full_dst_path, $this->file_permissions);
            }

            return TRUE;
        }

        // Let's set up our values based on the action
        if ($action === 'crop')
        {
            //  Reassign the source width/height if cropping
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

        //  Create the image handle
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
        elseif ( ! $this->image_save_gd($dst_img)) // ... or save it
        {
            return FALSE;
        }

        // Kill the file handles
        imagedestroy($dst_img);
        imagedestroy($src_img);

        @chmod($this->full_dst_path, $this->file_permissions);

        return TRUE;
    }

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
            case 1 :
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

}
