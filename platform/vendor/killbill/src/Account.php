<?php
/*
 * Copyright 2011-2017 Ning, Inc.
 * Copyright 2014 Groupon, Inc.
 * Copyright 2014 The Billing Project, LLC
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

use Killbill\Client\Exception\Exception;
use Killbill\Client\Exception\ResponseException;
use Killbill\Client\Traits\CustomFieldTrait;
use Killbill\Client\Traits\TagTrait;
use Killbill\Client\Type\AccountAttributes;

/**
 * Account actions
 */
class Account extends AccountAttributes
{
    /** Type to use for custom fields */
    const CUSTOMFIELD_OBJECTTYPE = CustomField::OBJECTTYPE_ACCOUNT;

    /**
     * @param string[]|null $headers Any additional headers
     *
     * @return Account|null The fetched account
     */
    public function get($headers = null)
    {
        if ($this->getAccountId()) {
            $response = $this->getRequest(Client::PATH_ACCOUNTS.'/'.$this->getAccountId(), $headers);
        } else {
            $queryData = array();
            $queryData['externalKey'] = $this->getExternalKey();

            $query = $this->makeQuery($queryData);
            $response = $this->getRequest(Client::PATH_ACCOUNTS.$query, $headers);
        }

        try {
            /** @var Account|null $object */
            $object = $this->getFromBody(Account::class, $response);
        } catch (ResponseException $e) {
            return null;
        }

        return $object;
    }

    /**
     * @param string|null   $user    User requesting the creation
     * @param string|null   $reason  Reason for the creation
     * @param string|null   $comment Any addition comment
     * @param string[]|null $headers Any additional headers
     *
     * @return Account|null The newly created account
     */
    public function create($user, $reason, $comment, $headers = null)
    {
        $response = $this->createRequest(Client::PATH_ACCOUNTS, $user, $reason, $comment, $headers);

        try {
            /** @var Account|null $object */
            $object = $this->getFromResponse(Account::class, $response, $headers);
        } catch (Exception $e) {
            $this->logger->error($e);

            return null;
        }

        return $object;
    }

    /**
     * @param string|null   $user    User requesting the creation
     * @param string|null   $reason  Reason for the creation
     * @param string|null   $comment Any addition comment
     * @param string[]|null $headers Any additional headers
     *
     * @return Account|null The updated account
     */
    public function update($user, $reason, $comment, $headers = null)
    {
        $response = $this->updateRequest(Client::PATH_ACCOUNTS.'/'.$this->getAccountId(), $user, $reason, $comment, $headers);

        try {
            /** @var Account|null $object */
            $object = $this->getFromBody(Account::class, $response);
        } catch (Exception $e) {
            $this->logger->error($e);

            return null;
        }

        return $object;
    }

    /**
     * @param string[]|null $headers Any additional headers
     *
     * @return Bundle[]|null
     */
    public function getBundles($headers = null)
    {
        $response = $this->getRequest(Client::PATH_ACCOUNTS.'/'.$this->getAccountId().Client::PATH_BUNDLES, $headers);

        try {
            /** @var Bundle[]|null $object */
            $object = $this->getFromBody(Bundle::class, $response);
        } catch (Exception $e) {
            $this->logger->error($e);

            return null;
        }

        return $object;
    }

    /**
     * @param bool|null     $withItems          ?
     * @param bool|null     $unpaidInvoicesOnly ?
     * @param string[]|null $headers            Any additional headers
     *
     * @return Invoice[]|null
     */
    public function getInvoices($withItems, $unpaidInvoicesOnly, $headers = null)
    {
        $queryData = array();
        if ($withItems) {
            $queryData['withItems'] = 'true';
        }
        if ($unpaidInvoicesOnly) {
            $queryData['unpaidInvoicesOnly'] = 'true';
        }

        $query = $this->makeQuery($queryData);
        $response = $this->getRequest(Client::PATH_ACCOUNTS.'/'.$this->getAccountId().Client::PATH_INVOICES.$query, $headers);

        try {
            /** @var Invoice[]|null $object */
            $object = $this->getFromBody(Invoice::class, $response);
        } catch (Exception $e) {
            $this->logger->error($e);

            return null;
        }

        return $object;
    }

    /**
     * @param string        $date    Target date
     * @param string|null   $user    User requesting the creation
     * @param string|null   $reason  Reason for the creation
     * @param string|null   $comment Any addition comment
     * @param string[]|null $headers Any additional headers
     *
     * @return Invoice|null The dry invoice
     */
    public function getDryInvoice($date, $user, $reason, $comment, $headers = null)
    {
        $invoice = new InvoiceDryRun();

        $queryData = array();
        $queryData['accountId'] = $this->getAccountId();
        $queryData['targetDate'] = $date;

        $query = $this->makeQuery($queryData);
        $response = $invoice->createRequest(Client::PATH_INVOICES.Client::PATH_DRYRUN.$query, $user, $reason, $comment, $headers);

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
     * @param string|null   $user    User requesting the creation
     * @param string|null   $reason  Reason for the creation
     * @param string|null   $comment Any addition comment
     * @param string[]|null $headers Any additional headers
     *
     * @return null
     */
    public function payAllUnpaidInvoices($user, $reason, $comment, $headers = null)
    {
        $this->createRequest(Client::PATH_ACCOUNTS.'/'.$this->getAccountId().Client::PATH_INVOICE_PAYMENTS, $user, $reason, $comment, $headers);

        return null;
    }

    /**
     * @param string[]|null $headers Any additional headers
     *
     * @return Overdue|null
     */
    public function getOverdueState($headers = null)
    {
        $response = $this->getRequest(Client::PATH_ACCOUNTS.'/'.$this->getAccountId().Client::PATH_OVERDUE, $headers);

        try {
            /** @var Overdue|null $object */
            $object = $this->getFromBody(Overdue::class, $response);
        } catch (Exception $e) {
            $this->logger->error($e);

            return null;
        }

        return $object;
    }

    /**
     * @param string[]|null $headers Any additional headers
     *
     * @return PaymentMethod[]|null
     */
    public function getPaymentMethods($headers = null)
    {
        $queryData = array();
        $queryData['withPluginInfo'] = 'true';

        $query = $this->makeQuery($queryData);
        $response = $this->getRequest(Client::PATH_ACCOUNTS.'/'.$this->getAccountId().Client::PATH_PAYMENT_METHODS.$query, $headers);

        try {
            /** @var PaymentMethod[]|null $object */
            $object = $this->getFromBody(PaymentMethod::class, $response);
        } catch (Exception $e) {
            $this->logger->error($e);

            return null;
        }

        return $object;
    }

    /**
     * @param string[]|null $headers Any additional headers
     *
     * @return Payment[]|null
     */
    public function getPayments($headers = null)
    {
        $response = $this->getRequest(Client::PATH_ACCOUNTS.'/'.$this->getAccountId().Client::PATH_PAYMENTS, $headers);

        try {
            /** @var Payment[]|null $object */
            $object = $this->getFromBody(Payment::class, $response);
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
        return Client::PATH_ACCOUNTS.'/'.$this->getAccountId();
    }

    use CustomFieldTrait;
    use TagTrait;
}
