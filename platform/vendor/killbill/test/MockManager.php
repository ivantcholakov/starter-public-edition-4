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

/**
 * Work with response mocks
 */
class MockManager
{
    /** @var array|null */
    protected $stubs = null;

    /**
     * Public constructor
     */
    public function __construct()
    {
        $this->stubs = array();
    }

    /**
     * @param string $identifier
     * @param string $response
     */
    public function saveMock($identifier, $response)
    {
        $filename = $this->getIteratedIdentifier($identifier);
        file_put_contents(__DIR__.'/resources/mocks/'.$filename, $response);
    }

    /**
     * @param string $identifier
     *
     * @return bool|string
     */
    public function getMock($identifier)
    {
        $filename = $this->getIteratedIdentifier($identifier);

        return file_get_contents(__DIR__.'/resources/mocks/'.$filename);
    }

    /**
     * @param string $identifier
     * @param string $externalKey
     */
    public function saveExternalKey($identifier, $externalKey)
    {
        file_put_contents(__DIR__.'/resources/mocks/externalKey-'.md5($identifier), $externalKey);
    }

    /**
     * @param string $identifier
     *
     * @return bool|string
     */
    public function getExternalKey($identifier)
    {
        return file_get_contents(__DIR__.'/resources/mocks/externalKey-'.md5($identifier));
    }

    /**
     * @param string $identifier
     *
     * @return string
     */
    private function getIteratedIdentifier($identifier)
    {
        $iteration  = 0;
        $identifier = md5($identifier);
        if (in_array($identifier, array_keys($this->stubs))) {
            $iteration                = $this->stubs[$identifier];
            $this->stubs[$identifier] = ++$iteration;
        } else {
            $this->stubs[$identifier] = 0;
        }

        return md5($identifier.'_'.$iteration);
    }
}
