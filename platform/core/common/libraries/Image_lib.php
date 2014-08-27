<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Image_lib extends CI_Image_lib
{
    public function __construct($props = array())
    {
        parent::__construct($props);
    }

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
                $v2_override = ($gd_version === 2);
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
        // Fix image transparency. Taken from http://codeigniter.com/forums/viewthread/150527/
        if ( $this->image_library == 'gd2' )
        {
            $transparencyIndex = imagecolortransparent($src_img);
            $transparencyColor = array('red' => 255, 'green' => 255, 'blue' => 255);

            if ( $transparencyIndex >= 0 )
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
