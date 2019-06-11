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
use Killbill\Client\Type\BundleAttributes;

/**
 * Bundle actions
 */
class Bundle extends BundleAttributes
{
    /** Type to use for custom fields */
    const CUSTOMFIELD_OBJECTTYPE = CustomField::OBJECTTYPE_BUNDLE;

    /**
     * @param string[]|null $headers Any additional headers
     *
     * @return Bundle|null The fetched bundle
     */
    public function get($headers = null)
    {
        $response = $this->getRequest(Client::PATH_BUNDLES.'/'.$this->getBundleId(), $headers);

        try {
            /** @var Bundle|null $object */
            $object = $this->getFromBody(Bundle::class, $response);
        } catch (Exception $e) {
            $this->logger->error($e);

            return null;
        }

        return $object;
    }

    /**
     * @param string[]|null $headers Any additional headers
     *
     * @return Bundle[]|null The fetched bundles
     */
    public function getByExternalKey($headers = null)
    {
        $response = $this->getRequest(Client::PATH_BUNDLES.'?externalKey='.$this->getExternalKey(), $headers);

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
     * @param string        $date    ?
     * @param string|null   $user    User requesting the creation
     * @param string|null   $reason  Reason for the creation
     * @param string|null   $comment Any addition comment
     * @param string[]|null $headers Any additional headers
     *
     * @return null
     */
    public function pause($date, $user, $reason, $comment, $headers = null)
    {
        $this->updateRequest(Client::PATH_BUNDLES.'/'.$this->getBundleId().Client::PATH_PAUSE.'?requestedDate='.$date, $user, $reason, $comment, $headers);

        return null;
    }

    /**
     * @param string        $date    ?
     * @param string|null   $user    User requesting the creation
     * @param string|null   $reason  Reason for the creation
     * @param string|null   $comment Any addition comment
     * @param string[]|null $headers Any additional headers
     *
     * @return null
     */
    public function resume($date, $user, $reason, $comment, $headers = null)
    {
        $this->updateRequest(Client::PATH_BUNDLES.'/'.$this->getBundleId().Client::PATH_RESUME.'?requestedDate='.$date, $user, $reason, $comment, $headers);

        return null;
    }

    /**
     * Returns the base uri for the current object
     *
     * @return string
     */
    protected function baseUri()
    {
        return Client::PATH_BUNDLES.'/'.$this->getBundleId();
    }

    use CustomFieldTrait;
    use TagTrait;
}
