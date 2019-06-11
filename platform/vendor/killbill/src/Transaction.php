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

use Killbill\Client\Exception\Exception;
use Killbill\Client\Type\PaymentTransactionAttributes;

/**
 * Transaction actions
 */
class Transaction extends PaymentTransactionAttributes
{
    /**
     * @param string        $accountId       ?
     * @param string|null   $paymentMethodId ?
     * @param string|null   $user            User requesting the creation
     * @param string|null   $reason          Reason for the creation
     * @param string|null   $comment         Any addition comment
     * @param string[]|null $headers         Any additional headers
     *
     * @return Payment|null
     */
    public function createAuthorization($accountId, $paymentMethodId, $user, $reason, $comment, $headers = null)
    {
        $this->transactionType = 'AUTHORIZE';

        return $this->createAccountTransaction($accountId, $paymentMethodId, $user, $reason, $comment, $headers);
    }

    /**
     * @param string        $accountId       ?
     * @param string|null   $paymentMethodId ?
     * @param string|null   $user            User requesting the creation
     * @param string|null   $reason          Reason for the creation
     * @param string|null   $comment         Any addition comment
     * @param string[]|null $headers         Any additional headers
     *
     * @return Payment|null
     */
    public function createPurchase($accountId, $paymentMethodId, $user, $reason, $comment, $headers = null)
    {
        $this->transactionType = 'PURCHASE';

        return $this->createAccountTransaction($accountId, $paymentMethodId, $user, $reason, $comment, $headers);
    }

    /**
     * @param string        $accountId       ?
     * @param string|null   $paymentMethodId ?
     * @param string|null   $user            User requesting the creation
     * @param string|null   $reason          Reason for the creation
     * @param string|null   $comment         Any addition comment
     * @param string[]|null $headers         Any additional headers
     *
     * @return Payment|null
     */
    public function createCredit($accountId, $paymentMethodId, $user, $reason, $comment, $headers = null)
    {
        $this->transactionType = 'CREDIT';

        return $this->createAccountTransaction($accountId, $paymentMethodId, $user, $reason, $comment, $headers);
    }

    /**
     * @param string|null   $user    User requesting the creation
     * @param string|null   $reason  Reason for the creation
     * @param string|null   $comment Any addition comment
     * @param string[]|null $headers Any additional headers
     *
     * @return Payment|null
     */
    public function createCapture($user, $reason, $comment, $headers = null)
    {
        return $this->createTransaction(Client::PATH_PAYMENTS.'/'.$this->getPaymentId(), $user, $reason, $comment, $headers);
    }

    /**
     * @param string|null   $user    User requesting the creation
     * @param string|null   $reason  Reason for the creation
     * @param string|null   $comment Any addition comment
     * @param string[]|null $headers Any additional headers
     *
     * @return Payment|null
     */
    public function createRefund($user, $reason, $comment, $headers = null)
    {
        return $this->createTransaction(Client::PATH_PAYMENTS.'/'.$this->getPaymentId().Client::PATH_REFUNDS, $user, $reason, $comment, $headers);
    }

    /**
     * @param string|null   $user    User requesting the creation
     * @param string|null   $reason  Reason for the creation
     * @param string|null   $comment Any addition comment
     * @param string[]|null $headers Any additional headers
     *
     * @return Payment|null
     */
    public function createChargeback($user, $reason, $comment, $headers = null)
    {
        return $this->createTransaction(Client::PATH_PAYMENTS.'/'.$this->getPaymentId().Client::PATH_CHARGEBACKS, $user, $reason, $comment, $headers);
    }

    /**
     * @param string|null   $user    User requesting the creation
     * @param string|null   $reason  Reason for the creation
     * @param string|null   $comment Any addition comment
     * @param string[]|null $headers Any additional headers
     *
     * @return Payment|null
     */
    public function createVoid($user, $reason, $comment, $headers = null)
    {
        $response = $this->deleteRequest(Client::PATH_PAYMENTS.'/'.$this->getPaymentId(), $user, $reason, $comment, $headers);

        try {
            /** @var Payment|null $object */
            $object = $this->getFromResponse(Payment::class, $response, $headers);
        } catch (Exception $e) {
            $this->logger->error($e);

            return null;
        }

        return $object;
    }

    /**
     * @param string        $accountId       ?
     * @param string|null   $paymentMethodId ?
     * @param string|null   $user            User requesting the creation
     * @param string|null   $reason          Reason for the creation
     * @param string|null   $comment         Any addition comment
     * @param string[]|null $headers         Any additional headers
     *
     * @return Payment|null
     */
    public function createAccountTransaction($accountId, $paymentMethodId, $user, $reason, $comment, $headers = null)
    {
        $queryData = array();
        if ($paymentMethodId) {
            $queryData['paymentMethodId'] = $paymentMethodId;
        }

        $query = $this->makeQuery($queryData);

        return $this->createTransaction(Client::PATH_ACCOUNTS.'/'.$accountId.Client::PATH_PAYMENTS.$query, $user, $reason, $comment, $headers);
    }

    /**
     * @param string        $uri
     * @param string|null   $user    User requesting the creation
     * @param string|null   $reason  Reason for the creation
     * @param string|null   $comment Any addition comment
     * @param string[]|null $headers Any additional headers
     *
     * @return Payment|null
     */
    public function createTransaction($uri, $user, $reason, $comment, $headers = null)
    {
        $response = $this->createRequest($uri, $user, $reason, $comment, $headers);

        try {
            /** @var Payment|null $object */
            $object = $this->getFromResponse(Payment::class, $response, $headers);
        } catch (Exception $e) {
            $this->logger->error($e);

            return null;
        }

        return $object;
    }
}
