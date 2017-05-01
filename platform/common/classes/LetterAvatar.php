<?php

defined('BASEPATH') OR exit('No direct script access allowed.');

// Created by Ivan Tcholakov, 30-APR-2017.
// Some colors need to be tweaked.

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
        foreach ($words as $word) {

            if ($number_of_word > 2)
                break;

            $this->name_initials .= strtoupper(trim($word[0]));

            $number_of_word++;
        }

        // Modified by Ivan Tcholakov, 30-APR-2017.
        //$colors = [
        //    "#1abc9c", "#2ecc71", "#3498db", "#9b59b6", "#34495e", "#16a085", "#27ae60", "#2980b9", "#8e44ad", "#2c3e50",
        //    "#f1c40f", "#e67e22", "#e74c3c", "#ecf0f1", "#95a5a6", "#f39c12", "#d35400", "#c0392b", "#bdc3c7", "#7f8c8d",
        //];
        $colors = [
            "#1abc9c", "#2ecc71", "#3498db", "#9b59b6", "#34495e", "#16a085", "#27ae60", "#2980b9", "#8e44ad", "#2c3e50",
            "#f1c40f", "#e67e22", "#e74c3c", "#afbdc1", "#95a5a6", "#f39c12", "#d35400", "#c0392b", "#bdc3c7", "#7f8c8d",
        ];
        //

        $char_index  = ord($this->name_initials[0]) - 64;
        $color_index = $char_index % 20;
        $color       = $colors[$color_index];


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
