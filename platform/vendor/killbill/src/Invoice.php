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

use Killbill\Client\Exception\Exception;
use Killbill\Client\Traits\CustomFieldTrait;
use Killbill\Client\Traits\TagTrait;
use Killbill\Client\Type\InvoiceAttributes;
use Killbill\Client\Type\InvoiceItemAttributes;

/**
 * Invoice actions
 */
class Invoice extends InvoiceAttributes
{
    /** Type to use for custom fields */
    const CUSTOMFIELD_OBJECTTYPE = CustomField::OBJECTTYPE_INVOICE;

    /**
     * @param bool|null     $withItems ?
     * @param string[]|null $headers   Any additional headers
     *
     * @return Invoice|null The fetched invoice
     */
    public function get($withItems, $headers = null)
    {
        $queryData = array();
        if ($withItems) {
            $queryData['withItems'] = 'true';
        }

        $query = $this->makeQuery($queryData);
        $response = $this->getRequest(Client::PATH_INVOICES.'/'.$this->getInvoiceId().$query, $headers);

        try {
            /** @var Invoice|null $object */
            $object = $this->getFromBody(Invoice::class, $response);
        } catch (Exception $e) {
            $this->logger->error($e);

            return null;
        }

        return $object;
    }

    /**
     * @param string[]|null $headers Any additional headers
     *
     * @return string|null
     */
    public function getInvoiceAsHTML($headers = null)
    {
        $response = $this->getRequest(Client::PATH_INVOICES.'/'.$this->getInvoiceId().'/html', $headers);

        return $response->body;
    }

    /**
     * @param string        $accountId              Account to add invoice to
     * @param string        $requestedDate          Target date
     * @param InvoiceItem[] $invoiceItems           Invoice items to add (with at least an amount set on each)
     * @param bool          $payInvoice
     * @param bool          $autoCommit
     * @param string        $paymentExternalKey
     * @param string        $transactionExternalKey
     * @param string|null   $user                   User requesting the creation
     * @param string|null   $reason                 Reason for the creation
     * @param string|null   $comment                Any addition comment
     * @param string[]|null $headers                Any additional headers
     *
     * @return InvoiceItem[]|null The invoice
     */
    public function createExternalCharges($accountId, $requestedDate, $invoiceItems, $payInvoice, $autoCommit, $paymentExternalKey, $transactionExternalKey, $user, $reason, $comment, $headers = null)
    {
        $queryData = array();
        if ($requestedDate !== null) {
            $queryData['requestedDate'] = $requestedDate;
        }
        if ($payInvoice) {
            $queryData['payInvoice'] = 'true';
        }
        if ($autoCommit) {
            $queryData['autoCommit'] = 'true';
        }
        if ($paymentExternalKey !== null) {
            $queryData['paymentExternalKey'] = $paymentExternalKey;
        }
        if ($transactionExternalKey !== null) {
            $queryData['transactionExternalKey'] = $transactionExternalKey;
        }

        $query = $this->makeQuery($queryData);
        $response = $this->createRequest(Client::PATH_INVOICES.Client::PATH_CHARGES.'/'.$accountId.$query, $user, $reason, $comment, $headers, json_encode($invoiceItems));

        try {
            /** @var InvoiceItem[]|null $object */
            $object = $this->getFromBody(InvoiceItem::class, $response);
        } catch (Exception $e) {
            $this->logger->error($e);

            return null;
        }

        return $object;
    }

    /**
     * Returns the base uri for the current object
     *
     * @return string
     */
    protected function baseUri()
    {
        return Client::PATH_INVOICES.'/'.$this->getInvoiceId();
    }

    use CustomFieldTrait;
    use TagTrait;
}
