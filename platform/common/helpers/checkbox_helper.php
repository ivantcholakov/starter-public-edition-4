<?php defined('BASEPATH') OR exit('No direct script access allowed.');

// See https://gist.github.com/mikedfunk/4004986

/**
 * @author      Mike Funk
 * @link        http://mikefunk.com
 * @email       mike@mikefunk.com
 * @file        checkbox.php
 */

/**
 * checkbox value fixer. If a checkbox is not checked, sets it's value
 * to zero.
 * @param mixed $name the checkbox form field name. Can be passed as a
 * string or as an array.
 * @return void
 */
if (!function_exists('fix_unchecked'))
{
    function fix_unchecked($name)
    {
        // Modified by Ivan Tcholakov, 06-APR-2013.

        /*
        if (!is_array($name)) {$name = array($name);}
        foreach ($name as $item)
        {
            if (!$this->input->post($item)) {$_POST[$item] = 0;}
        }
        */

        if (get_instance()->input->method() != 'post')
        {
            return;
        }

        if (!is_array($name))
        {
            $name = array($name);
        }

        foreach ($name as $item)
        {
            if (!ci()->input->post($item))
            {
                $_POST[$item] = 0;
            }
        }

        //
    }

}

/* README.md

# Checkbox Helper

Just a tiny helper to help with checkboxes. When you uncheck a checkbox, it's value
does not get sent in the form values. Instead of telling CodeIgniter you want to set
this value to 0, it says "don't change it." This fixes that, one by one, by setting
the value of the associated $_POST array item to zero. You can also pass in an array
of checkbox names and it will do each one.

## Usage

    $this->load->helper('checkbox');

    // set post values to zero for unchecked boxes
    fix_unchecked(['is_active', 'is_enabled', 'is_verified']);
*/
