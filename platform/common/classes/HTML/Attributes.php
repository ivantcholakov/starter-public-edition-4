<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class HTML_Attributes extends HTML_Common2 {

    public function __construct($attributes) {

        if (is_object($attributes)) {
            $attributes = get_object_vars($attributes);
        }

        parent::__construct($attributes);
    }

    /**
     * Creates HTML attribute string from array
     *
     * @param array $attributes Attribute array
     *
     * @return string Attribute string
     */
    protected static function getAttributesString(array $attributes)
    {
        $str     = '';
        $charset = self::getOption('charset');
        foreach ($attributes as $key => $value) {
            // Modified by Ivan Tcholakov, 28-APR-2016.
            // Prevent multiple escaping.
            //$str .= ' ' . $key . '="' . htmlspecialchars($value, ENT_QUOTES, $charset) . '"';
            $str .= ' ' . $key . '="' . htmlspecialchars($value, ENT_QUOTES, $charset, false) . '"';
            //
        }
        return $str;
    }

    /**
     * Returns the attribute array or string
     *
     * @param bool $asString Whether to return attributes as string
     *
     * @return array|string
     */
    public function getAttributes($asString = false)
    {
        if ($asString) {
            return self::getAttributesString($this->attributes);
        } else {
            return $this->attributes;
        }
    }

    public function __toString() {

        return $this->getAttributes(true);
    }

}
