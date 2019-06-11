<?php

namespace Killbill\Client;

use Killbill\Client\Type\CustomFieldAttributes;

/**
 * CustomField actions
 */
class CustomField extends CustomFieldAttributes
{
    /**
     * Possible object types
     */
    const OBJECTTYPE_ACCOUNT      = 'ACCOUNT';
    const OBJECTTYPE_BUNDLE       = 'BUNDLE';
    const OBJECTTYPE_SUBSCRIPTION = 'SUBSCRIPTION';
    const OBJECTTYPE_INVOICE      = 'INVOICE';
    const OBJECTTYPE_PAYMENT      = 'PAYMENT';
}
