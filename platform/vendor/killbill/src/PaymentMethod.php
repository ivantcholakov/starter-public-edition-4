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
use Killbill\Client\Type\PaymentMethodAttributes;

/**
 * PaymentMethod actions
 */
class PaymentMethod extends PaymentMethodAttributes
{
    /**
     * @param string[]|null $headers Any additional headers
     *
     * @return PaymentMethod[]|null The fetched payment method
     */
    public function get($headers = null)
    {
        $response = $this->getRequest(Client::PATH_PAYMENT_METHODS.'/'.$this->getAccountId(), $headers);

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
     * @param string|null   $user    User requesting the creation
     * @param string|null   $reason  Reason for the creation
     * @param string|null   $comment Any addition comment
     * @param string[]|null $headers Any additional headers
     *
     * @return Account|null The newly created payment method
     */
    public function create($user, $reason, $comment, $headers = null)
    {
        $queryData = array();
        if ($this->isDefault) {
            $queryData['isDefault'] = 'true';
        }

        $query = $this->makeQuery($queryData);
        $response = $this->createRequest(Client::PATH_ACCOUNTS.'/'.$this->getAccountId().Client::PATH_PAYMENT_METHODS.$query, $user, $reason, $comment, $headers);

        try {
            /** @var Account|null $object */
            $object = $this->getFromResponse(PaymentMethod::class, $response, $headers);
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
    public function delete($user, $reason, $comment, $headers = null)
    {
        $queryData = array();
        $queryData['forceDefaultPmDeletion'] = 'true';

        $query = $this->makeQuery($queryData);
        $response = $this->deleteRequest(Client::PATH_PAYMENT_METHODS.'/'.$this->getPaymentMethodId().$query, $user, $reason, $comment, $headers);

        return null;
    }
}
