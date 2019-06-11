<?php
/*
 * Copyright 2011-2017 Ning, Inc.
 *
 * Ning licenses this file to you under the Apache License, version 2.0
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

use Killbill\Client\Type\InvoiceItemAttributes;

/**
 * InvoiceItem actions
 */
class InvoiceItem extends InvoiceItemAttributes
{
    /** InvoiceItem types (see: https://github.com/killbill/killbill-api/blob/master/src/main/java/org/killbill/billing/invoice/api/InvoiceItemType.java) */
    const ITEM_TYPE_EXTERNAL_CHARGE = 'EXTERNAL_CHARGE';
    const ITEM_TYPE_FIXED           = 'FIXED';
    const ITEM_TYPE_RECURRING       = 'RECURRING';
    const ITEM_TYPE_REPAIR_ADJ      = 'REPAIR_ADJ';
    const ITEM_TYPE_CBA_ADJ         = 'CBA_ADJ';
    const ITEM_TYPE_CREDIT_ADJ      = 'CREDIT_ADJ';
    const ITEM_TYPE_ITEM_ADJ        = 'ITEM_ADJ';
    const ITEM_TYPE_USAGE           = 'USAGE';
    const ITEM_TYPE_TAX             = 'TAX';
}
