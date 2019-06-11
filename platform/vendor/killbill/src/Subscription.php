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
use Killbill\Client\Type\SubscriptionAttributes;

/**
 * Subscription actions
 */
class Subscription extends SubscriptionAttributes
{
    /** Type to use for custom fields */
    const CUSTOMFIELD_OBJECTTYPE = CustomField::OBJECTTYPE_SUBSCRIPTION;

    /**
     * @param string[]|null $headers Any additional headers
     *
     * @return Subscription|null The fetched subscription
     */
    public function get($headers = null)
    {
        $response = $this->getRequest(Client::PATH_SUBSCRIPTIONS.'/'.$this->getSubscriptionId(), $headers);

        try {
            /** @var Subscription|null $object */
            $object = $this->getFromBody(Subscription::class, $response);
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
     * @return Subscription|null The newly created subscription
     */
    public function create($user, $reason, $comment, $headers = null)
    {
        return $this->createAndWait(false, $user, $reason, $comment, $headers);
    }

    /**
     * @param bool          $wait    ?
     * @param string|null   $user    User requesting the creation
     * @param string|null   $reason  Reason for the creation
     * @param string|null   $comment Any addition comment
     * @param string[]|null $headers Any additional headers
     *
     * @return Subscription|null The newly created subscription
     */
    public function createAndWait($wait, $user, $reason, $comment, $headers = null)
    {
        $queryData = array();
        $queryData['call_completion'] = ($wait ? 'true' : 'false');

        $query = $this->makeQuery($queryData);
        $response = $this->createRequest(Client::PATH_SUBSCRIPTIONS.$query, $user, $reason, $comment, $headers);

        try {
           /** @var Subscription|null $object */
            $object = $this->getFromResponse(Subscription::class, $response, $headers);
        } catch (Exception $e) {
            $this->logger->error($e);

            return null;
        }

        return $object;
    }

    /**
     * @param string|null   $requestedDate  ?
     * @param string|null   $billingPolicy  ?
     * @param string|null   $callCompletion ?
     * @param string|null   $user           User requesting the creation
     * @param string|null   $reason         Reason for the creation
     * @param string|null   $comment        Any addition comment
     * @param string[]|null $headers        Any additional headers
     *
     * @return Subscription|null The updated subscription
     */
    public function changePlan($requestedDate, $billingPolicy, $callCompletion, $user, $reason, $comment, $headers = null)
    {
        $queryData = array();
        if ($requestedDate) {
            $queryData['requestedDate'] = $requestedDate;
        }
        if ($billingPolicy) {
            $queryData['billingPolicy'] = $billingPolicy;
        }
        if ($callCompletion) {
            $queryData['callCompletion'] = $callCompletion;
        }

        $query = $this->makeQuery($queryData);
        $response = $this->updateRequest(Client::PATH_SUBSCRIPTIONS.'/'.$this->getSubscriptionId().$query, $user, $reason, $comment, $headers);

        try {
            /** @var Subscription|null $object */
            $object = $this->getFromBody(Subscription::class, $response);
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
     * @return Subscription|null The updated subscription
     */
    public function reinstate($user, $reason, $comment, $headers = null)
    {
        $response = $this->updateRequest(Client::PATH_SUBSCRIPTIONS.'/'.$this->getSubscriptionId().Client::PATH_UNCANCEL, $user, $reason, $comment, $headers);

        try {
            /** @var Subscription|null $object */
            $object = $this->getFromBody(Subscription::class, $response);
        } catch (Exception $e) {
            $this->logger->error($e);

            return null;
        }

        return $object;
    }

    /**
     * @param string|null   $requestedDate              ?
     * @param string|null   $entitlementPolicy          ?
     * @param string|null   $billingPolicy              ?
     * @param string|null   $useRequestedDateForBilling ?
     * @param string|null   $callCompletion             ?
     * @param string|null   $user                       User requesting the creation
     * @param string|null   $reason                     Reason for the creation
     * @param string|null   $comment                    Any addition comment
     * @param string[]|null $headers                    Any additional headers
     *
     * @return null
     */
    public function cancel($requestedDate, $entitlementPolicy, $billingPolicy, $useRequestedDateForBilling, $callCompletion, $user, $reason, $comment, $headers = null)
    {
        $queryData = array();
        if ($requestedDate) {
            $queryData['requestedDate'] = $requestedDate;
        }
        if ($entitlementPolicy) {
            $queryData['entitlementPolicy'] = $entitlementPolicy;
        }
        if ($billingPolicy) {
            $queryData['billingPolicy'] = $billingPolicy;
        }
        if ($useRequestedDateForBilling) {
            $queryData['useRequestedDateForBilling'] = $useRequestedDateForBilling;
        }
        if ($callCompletion) {
            $queryData['callCompletion'] = $callCompletion;
        }

        $query = $this->makeQuery($queryData);
        $response = $this->deleteRequest(Client::PATH_SUBSCRIPTIONS.'/'.$this->getSubscriptionId().$query, $user, $reason, $comment, $headers);

        return null;
    }

    /**
     * Returns the base uri for the current object
     *
     * @return string
     */
    protected function baseUri()
    {
        return Client::PATH_SUBSCRIPTIONS.'/'.$this->getSubscriptionId();
    }

    use CustomFieldTrait;
    use TagTrait;
}
