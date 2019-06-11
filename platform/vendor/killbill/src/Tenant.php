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
use Killbill\Client\Type\TenantAttributes;

/**
 * Tenant actions
 */
class Tenant extends TenantAttributes
{
    /**
     * @param string[]|null $headers Any additional headers
     *
     * @return Tenant|null The fetched tenant
     */
    public function get($headers = null)
    {
        $response = $this->getRequest(Client::PATH_TENANTS.((null !== $this->getTenantId()) ? '/'.$this->getTenantId() : '?apiKey='.$this->apiKey), $headers);

        try {
            /** @var Tenant|null $object */
            $object = $this->getFromBody(Tenant::class, $response);
        } catch (Exception $e) {
            $this->logger->error($e);

            return null;
        }

        return $object;
    }

    /**
     * @param string|null $user    User requesting the creation
     * @param string|null $reason  Reason for the creation
     * @param string|null $comment Any addition comment
     *
     * @return Tenant|null The newly created tenant
     */
    public function create($user, $reason, $comment)
    {
        $response = $this->createRequest(Client::PATH_TENANTS, $user, $reason, $comment);

        try {
            /** @var Tenant|null $object */
            $object = $this->getFromResponse(Tenant::class, $response, $this->getTenantHeaders());
        } catch (Exception $e) {
            $this->logger->error($e);

            return null;
        }

        return $object;
    }

    /**
     * @return array
     */
    public function getTenantHeaders()
    {
        return array(
            'X-Killbill-ApiKey: '.$this->apiKey,
            'X-Killbill-ApiSecret: '.$this->apiSecret,
        );
    }
}
