<?php

class HTMLPurifier_AttrTransform_SafeEmbed extends HTMLPurifier_AttrTransform
{
    /**
     * @type string
     */
    public $name = "SafeEmbed";

    /**
     * @param array $attr
     * @param HTMLPurifier_Config $config
     * @param HTMLPurifier_Context $context
     * @return array
     */
    public function transform($attr, $config, $context)
    {
        $attr['allowscriptaccess'] = 'never';
        $attr['allownetworking'] = 'internal';
        $attr['type'] = 'application/x-shockwave-flash';
        // Added by Ivan Tcholakov, 24-DEC-2013.
        if (!$config->get('HTML.FlashAllowFullScreen') || !$attr['allowfullscreen'] == 'true') {
            unset($attr['allowfullscreen']); // if omitted, assume to be 'false'
        }
        //
        return $attr;
    }
}

// vim: et sw=4 sts=4
