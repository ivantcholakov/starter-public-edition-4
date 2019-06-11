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
 * Response wrapper
 */
class Response
{
    /** @var int */
    public $statusCode;
    /** @var string[string] */
    public $headers;
    /** @var string */
    public $body;

    /**
    * @param int    $statusCode HTTP status code
    * @param array  $headers    Response headers
    * @param string $body       Response body
    */
    public function __construct($statusCode, $headers, $body)
    {
        $this->statusCode = $statusCode;
        $this->headers    = $headers;
        $this->body       = $body;
    }
}
