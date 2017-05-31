<?php

defined('BASEPATH') OR exit('No direct script access allowed.');

// Created by Ivan Tcholakov, 30-APR-2017.
// Note, Ivan Tcholakov, 31-MAY-2017:
// This class was introduced for tweaking some
// hard-coded color values. Since the original
// project improved color generation, this class
// appears not to be needed at the moment. I am
// going to keep it for backward compatibility
// and as a way for introducing future patches,
// if such become needed.

class LetterAvatar extends \YoHang88\LetterAvatar\LetterAvatar {

    // Added by Ivan Tcholakov, 30-APR-2017.
    protected $font_directory;
    //

    public function __construct($name, $shape = 'circle', $size = '48')
    {
        parent::__construct($name, $shape, $size);

        // Added by Ivan Tcholakov, 30-APR-2017.
        $object = new ReflectionObject($this);
        $this->font_directory = dirname($object->getParentClass()->getFileName());
        //
    }

    /**
     * @return \Intervention\Image\Image
     */
    public function generate()
    {
        $words = $this->break_words($this->name);

        $number_of_word = 1;
        $this->name_initials = '';
        foreach ($words as $word) {

            if ($number_of_word > 2)
                break;

            $this->name_initials .= strtoupper(trim($word[0]));

            $number_of_word++;
        }

        $color = $this->stringToColor($this->name);

        if ($this->shape == 'circle') {
            $canvas = $this->image_manager->canvas(480, 480);

            $canvas->circle(480, 240, 240, function ($draw) use ($color) {
                $draw->background($color);
            });

        } else {

            $canvas = $this->image_manager->canvas(480, 480, $color);
        }

        $canvas->text($this->name_initials, 240, 240, function ($font) {
            // Modified by Ivan Tcholakov, 30-APR-2017.
            //$font->file(__DIR__ . '/fonts/arial-bold.ttf');
            $font->file($this->font_directory . '/fonts/arial-bold.ttf');
            //
            $font->size(220);
            $font->color('#ffffff');
            $font->valign('middle');
            $font->align('center');
        });

        return $canvas->resize($this->size, $this->size);
    }

    public function __toString()
    {
        return parent::__toString();
    }

}
