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
use Killbill\Client\Type\TagDefinitionAttributes;

/**
 * TagDefinition actions
 */
class TagDefinition extends TagDefinitionAttributes
{
    /**
     * @param string[]|null $headers Any additional headers
     *
     * @return TagDefinition|null The fetched tag definition
     */
    public function get($headers = null)
    {
        $response = $this->getRequest(Client::PATH_TAGDEFINITIONS.'/'.$this->getId(), $headers);

        try {
            /** @var TagDefinition|null $object */
            $object = $this->getFromBody(TagDefinition::class, $response);
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
     * @return TagDefinition|null The newly created tag definition
     */
    public function create($user, $reason, $comment, $headers = null)
    {
        $response = $this->createRequest(Client::PATH_TAGDEFINITIONS, $user, $reason, $comment, $headers);

        try {
            /** @var TagDefinition|null $object */
            $object = $this->getFromResponse(TagDefinition::class, $response, $headers);
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
     * @return TagDefinition|null
     */
    public function delete($user, $reason, $comment, $headers = null)
    {
        $response = $this->deleteRequest(Client::PATH_TAGDEFINITIONS.'/'.$this->getId(), $user, $reason, $comment, $headers);

        try {
            /** @var TagDefinition|null $object */
            $object = $this->getFromResponse(TagDefinition::class, $response, $headers);
        } catch (Exception $e) {
            $this->logger->error($e);

            return null;
        }

        return $object;
    }
}
