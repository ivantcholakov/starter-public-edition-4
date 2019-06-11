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

use Killbill\Client\Exception\ResourceParsingException;
use Killbill\Client\Exception\ResponseException;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

/**
* Abstract resource class that implements most CRUD functions
*/
abstract class AbstractResource implements \JsonSerializable
{
    /** @var Client */
    protected $client;
    /** @var LoggerInterface */
    protected $logger;

    /**
     * AbstractResource constructor.
     *
     * @param LoggerInterface|null $logger
     */
    public function __construct(LoggerInterface $logger = null)
    {
        $this->logger = ($logger !== null) ? $logger : new NullLogger();
    }

    /**
     * Implementation of PHP's debug getter
     * Mainly to exclude logger's very verbose and not useful information
     *
     * @return array
     */
    public function __debugInfo()
    {
        $vars = get_object_vars($this);

        unset($vars['logger']);

        return $vars;
    }

    /**
     * Implementation of JsonSerializable
     *
     * Mainly to exclude logger and client properties
     *
     * @return mixed Json encoded resource
     */
    public function jsonSerialize()
    {
        $vars = get_object_vars($this);

        unset($vars['client']);
        unset($vars['logger']);

        return $vars;
    }

    /**
     * Makes the query parameters to use in complex requests
     *
     * @param array $queryData Array of key=>value data to use as query parameters
     *
     * @return string Query string to use in a request
     */
    protected function makeQuery($queryData)
    {
        if (empty($queryData)) {
            return '';
        }

        $query = http_build_query($queryData);

        return '?'.$query;
    }

    /**
     * Issues a GET request to killbill
     *
     * @param string        $uri     Relative or absolute killbill url
     * @param string[]|null $headers Any additional headers
     *
     * @return Response A response object
     */
    protected function getRequest($uri, $headers = null)
    {
        $this->initClientIfNeeded();

        return $this->client->request(Client::GET, $uri, null, null, null, null, $headers);
    }

    /**
     * Issues a create request to killbill
     *
     * @param string        $uri     Relative or absolute killbill url
     * @param string|null   $user    User requesting the creation
     * @param string|null   $reason  Reason for the creation
     * @param string|null   $comment Any addition comment
     * @param string[]|null $headers Any additional headers
     * @param string        $data    JSON encoded data to use, instead of the default object serialization
     *
     * @return Response A response object
     */
    protected function createRequest($uri, $user, $reason, $comment, $headers = null, $data = null)
    {
        $this->initClientIfNeeded();

        return $this->client->request(Client::POST, $uri, ($data !== null) ? $data : json_encode($this), $user, $reason, $comment, $headers);
    }

    /**
     * Issues an update request to killbill
     *
     * @param string        $uri     Relative or absolute killbill url
     * @param string|null   $user    User requesting the update
     * @param string|null   $reason  Reason for the update
     * @param string|null   $comment Any addition comment
     * @param string[]|null $headers Any additional headers
     * @param string        $data    JSON encoded data to use, instead of the default object serialization
     *
     * @return Response A response object
     */
    protected function updateRequest($uri, $user, $reason, $comment, $headers = null, $data = null)
    {
        $this->initClientIfNeeded();

        return $this->client->request(Client::PUT, $uri, ($data !== null) ? $data : json_encode($this), $user, $reason, $comment, $headers);
    }

    /**
     * Issues a DELETE request to killbill
     *
     * @param string        $uri     Relative or absolute killbill url
     * @param string|null   $user    User requesting the deletion
     * @param string|null   $reason  Reason for the deletion
     * @param string|null   $comment Any addition comment
     * @param string[]|null $headers Any additional headers
     * @param string        $data    JSON encoded data to use, instead of the default object serialization
     *
     * @return Response A response object
     */
    protected function deleteRequest($uri, $user, $reason, $comment, $headers = null, $data = null)
    {
        $this->initClientIfNeeded();

        return $this->client->request(Client::DELETE, $uri, ($data !== null) ? $data : json_encode($this), $user, $reason, $comment, $headers);
    }

    /**
     * Given a response object, lookup the resource in killbill via
     * the location header
     *
     * @param string        $class    Resource class
     * @param Response      $response Response object
     * @param string[]|null $headers  Any additional headers
     *
     * @return Resource|Resource[]|null An instance or collection of resources
     */
    protected function getFromResponse($class, $response, $headers = null)
    {
        if ($response === null) {
            $this->logger->notice('Response is null for class '.$class);

            return null;
        }

        $responseHeaders = $response->headers;
        if ($responseHeaders === null || !isset($responseHeaders['Location']) || $responseHeaders['Location'] === null) {
            $this->logger->notice('Response has no Location header while seeking response for class '.$class);

            return null;
        }

        $this->initClientIfNeeded();

        $getResponse = $this->getRequest($responseHeaders['Location'], $headers);
        if ($getResponse === null || $getResponse->body === null) {
            $this->logger->notice('Redirected response is null for class '.$class);

            return null;
        }

        return $this->getFromBody($class, $getResponse);
    }

    /**
     * Given a response object, decode the body
     *
     * @param string   $class    resource class (optional)
     * @param Response $response response object
     *
     * @return Resource|\Resource[]|null An instance or collection of resources
     * @throws ResponseException
     */
    protected function getFromBody($class, $response)
    {
        $dataJson = json_decode($response->body);

        if ($dataJson === null) {
            throw new ResponseException('Killbill returned an invalid response: '.$response->statusCode.' "'.$response->body.'"', $response->statusCode);
        }

        return $this->fromJson($class, $dataJson);
    }

    /**
     * Given a json object, create the associated resource(s)
     * instance(s)
     *
     * @param string          $class Resource class name
     * @param object|object[] $json  Decoded json from killbill
     *
     * @return string|Resource|Resource[]|null An instance or collection of resources
     */
    private function fromJson($class, $json)
    {
        if (is_null($json)) {
            return null;
        } elseif (is_array($json)) {
            return $this->fromJsonArray($class, $json);
        } elseif (is_scalar($json)) {
            return $json;
        } else {
            return $this->fromJsonObject($class, $json);
        }
    }

    /**
     * @param string $class
     * @param array  $json
     *
     * @return array
     */
    private function fromJsonArray($class, $json)
    {
        $objects = array();

        $associativeArray = count(array_filter(array_keys($json), 'is_string')) > 0;

        if ($associativeArray) {
            // key-value array

            foreach ($json as $key => $object) {
                $objects[$key] = $this->fromJson($class, $object);
            }
        } else {
            // indexed array

            foreach ($json as $object) {
                $objects[] = $this->fromJson($class, $object);
            }
        }

        return $objects;
    }

    /**
     * @param string        $class
     * @param string|object $json
     *
     * @return object|string
     * @throws ResourceParsingException
     * @throws ResponseException
     */
    private function fromJsonObject($class, $json)
    {
        if (property_exists($json, 'className') && property_exists($json, 'code') && property_exists($json, 'message')) {
            // An exception has been returned by killbill
            // also available: $json->causeClassName, $json->causeMessage, $json->stackTrace
            throw new ResponseException('Killbill returned an exception: '.$json->className.' '.$json->message, $json->code);
        }

        if (!class_exists($class)) {
            throw new ResourceParsingException('Could not instantiate a class of type '.$class);
        }

        $object = new $class($this->logger);

        foreach ($json as $key => $value) {
            $typeMethod = 'get'.ucfirst($key).'Type';

            if (method_exists($object, $typeMethod)) {
                $type = $object->{$typeMethod}();

                // A type has been specified for this property, so trying to convert the value into this type
                if ($type) {
                    $value = $this->fromJson($type, $value);
                }
            }

            $setterMethod = 'set'.ucfirst($key);
            if (method_exists($object, $setterMethod)) {
                $object->{$setterMethod}($value);
            } else {
                $this->logger->warning('JSON response has '.$key.' but method '.$setterMethod.' does not exist on '.$class);
            }
        }

        return $object;
    }

    /**
     * Initialize API client
     */
    private function initClientIfNeeded()
    {
        if (is_null($this->client)) {
            $this->client = new Client($this->logger);
        }
    }
}
