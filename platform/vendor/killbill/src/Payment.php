<?php
/*
 * Copyright 2014 Groupon, Inc.
 * Copyright 2014 - 2017 The Billing Project, LLC
 *
 * The Billing Project licenses this file to you under the Apache License, version 2.0
 * (the "License"); you may not use this file except in compliance with the
 * License.  You may obtain a copy of the License at:
 *
 *    http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.  See the
 * License for the specific language governing permissions and limitations
 * under the License.
 */

namespace Killbill\Client;

use Killbill\Client\Traits\CustomFieldTrait;
use Killbill\Client\Traits\TagTrait;
use Killbill\Client\Type\PaymentAttributes;

/**
 * Payment actions
 */
class Payment extends PaymentAttributes
{
    /** Type to use for custom fields */
    const CUSTOMFIELD_OBJECTTYPE = CustomField::OBJECTTYPE_PAYMENT;

    /**
     * Returns the base uri for the current object
     *
     * @return string
     */
    protected function baseUri()
    {
        return Client::PATH_PAYMENTS.'/'.$this->getPaymentId();
    }

    use CustomFieldTrait;
    use TagTrait;
}
