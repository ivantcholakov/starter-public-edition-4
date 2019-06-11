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

use Killbill\Client\Exception\CurlException;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

/**
 * Killbill HTTP API client
 */
class Client
{
    /** @var MockManager|null */
    public static $mockManager = null;
    /** @var bool */
    public static $useMockData = false;
    /** @var bool */
    public static $recordMocks = false;

    /** @var string URL of the killbill server */
    public static $serverUrl = 'http://127.0.0.1:8080';
    /** @var string Api version */
    public static $apiVersion = '1.0';
    /** @var string Api user */
    public static $apiUser = 'admin';
    /** @var string Api password */
    public static $apiPassword = 'password';
    /** @var int Api requests timeout in seconds */
    public static $timeout = 45;
    /** @var int Api requests conneciton timeout in seconds */
    public static $connectionTimeout = 10;

    const API_CLIENT_VERSION = '1.0.0';
    const DEFAULT_ENCODING   = 'UTF-8';

    const GET    = 'GET';
    const POST   = 'POST';
    const PUT    = 'PUT';
    const DELETE = 'DELETE';
    const HEAD   = 'HEAD';

    const PATH_ACCOUNTS             = '/accounts';
    const PATH_BUNDLES              = '/bundles';
    const PATH_CATALOG              = '/catalog';
    const PATH_CUSTOM_FIELDS        = '/customFields';
    const PATH_INVOICES             = '/invoices';
    const PATH_OVERDUE              = '/overdue';
    const PATH_PAYMENT_METHODS      = '/paymentMethods';
    const PATH_PAYMENTS             = '/payments';
    const PATH_PAYMENT_TRANSACTIONS = '/paymentTransactions';
    const PATH_INVOICE_PAYMENTS     = '/invoicePayments';
    const PATH_PAUSE                = '/pause';
    const PATH_RESUME               = '/resume';
    const PATH_SUBSCRIPTIONS        = '/subscriptions';
    const PATH_TAGS                 = '/tags';
    const PATH_TAGDEFINITIONS       = '/tagDefinitions';
    const PATH_TENANTS              = '/tenants';
    const PATH_UNCANCEL             = '/uncancel';
    const PATH_USAGES               = '/usages';
    const PATH_CHARGEBACKS          = '/chargebacks';
    const PATH_REFUNDS              = '/refunds';
    const PATH_DRYRUN               = '/dryRun';
    const PATH_CHARGES              = '/charges';

    /** @var LoggerInterface */
    private $logger;

    /**
     * Client constructor.
     *
     * @param LoggerInterface|null $logger
     */
    public function __construct(LoggerInterface $logger = null)
    {
        $this->logger = ($logger != null) ? $logger : new NullLogger();
    }

    /**
     * @param string        $method
     * @param string        $uri
     * @param string|null   $data
     * @param string|null   $user
     * @param string|null   $reason
     * @param string|null   $comment
     * @param string[]|null $additionalHeaders
     *
     * @return Response
     */
    public function request($method, $uri, $data = null, $user = null, $reason = null, $comment = null, $additionalHeaders = null)
    {
        $this->logger->debug('Performing '.$method.' request on '.$uri.' with data "'.(strlen($data) > 1000 ? 'truncated:'.substr($data, 0, 500).'...'.substr($data, -500, 500) : $data).'" (user: "'.$user.'", reason: "'.$reason.'", comment: "'.$comment.'", additionalHeaders: "'.json_encode($additionalHeaders).'")');

        $response = $this->sendRequest($method, $uri, $data, $user, $reason, $comment, $additionalHeaders);
        $this->logger->debug('Received response '.$response->statusCode.' with headers '.json_encode($response->headers).' and body "'.(strlen($response->body) > 1000 ? 'truncated:'.substr($response->body, 0, 500).'...'.substr($response->body, -500, 500) : $response->body).'"');

        return $response;
    }

    /**
     * @param string        $method
     * @param string        $uri
     * @param string|null   $data
     * @param string|null   $user
     * @param string|null   $reason
     * @param string|null   $comment
     * @param string[]|null $additionalHeaders
     *
     * @return Response
     */
    private function sendRequest($method, $uri, $data = null, $user = null, $reason = null, $comment = null, $additionalHeaders = null)
    {
        if (self::$useMockData && isset(self::$mockManager)) {
            return $this->getMockResponse($method.' '.$uri.' '.$data);
        }

        if (function_exists('mb_internal_encoding')) {
            mb_internal_encoding(self::DEFAULT_ENCODING);
        }

        $effectiveUri = $uri;
        if (substr($uri, 0, 4) != 'http') {
            if (substr($uri, 0, 8) == '/plugins') {
                $effectiveUri = self::apiUrl('plugins').$uri;
            } else {
                $effectiveUri = self::apiUrl('killbill').$uri;
            }
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $effectiveUri);
        // Don't follow the Location header
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
        // Include the header in the output
        curl_setopt($ch, CURLOPT_HEADER, true);
        // Transfer as a string of the return value of curl_exec() instead of outputting it out directly
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // The number of seconds to wait while trying to connect
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, Client::$connectionTimeout);
        // The maximum number of seconds to allow cURL functions to execute
        curl_setopt($ch, CURLOPT_TIMEOUT, Client::$timeout);

        // Default http headers
        $httpHeaders = array(
            'Accept: application/json, text/html',
            'X-Killbill-Reason: '.$reason,
            'X-Killbill-CreatedBy: '.$user,
            'X-Killbill-Comment: '.$comment,
            self::userAgentHeader(),
        );
        if ($additionalHeaders) {
            $httpHeaders = array_merge($httpHeaders, $additionalHeaders);
        }

        $hasContentTypeHeader = false;
        foreach ($httpHeaders as $currentHeader) {
            if (strpos($currentHeader, 'Content-Type') === 0) {
                $hasContentTypeHeader = true;
            }
        }
        if (!$hasContentTypeHeader) {
            $httpHeaders[] = 'Content-Type: application/json; charset=utf-8';
        }

        curl_setopt($ch, CURLOPT_HTTPHEADER, $httpHeaders);

        if (self::apiUser() != null && self::apiPassword() != null) {
            curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            curl_setopt($ch, CURLOPT_USERPWD, self::apiUser().':'.self::apiPassword());
        }

        if ('POST' == $method) {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        } elseif ('PUT' == $method) {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        } elseif ('DELETE' == $method) {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        } elseif ('GET' != $method) {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        }

        // Send the request
        $response = curl_exec($ch);

        // Handle errors
        if ($response === false) {
            $errorNumber = curl_errno($ch);
            $message     = curl_error($ch);
            curl_close($ch);

            $this->raiseCurlError($errorNumber, $message);
        }

        $statusCode  = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        curl_close($ch);

        $header  = substr($response, 0, $headerSize);
        $headers = $this->getHeaders($header);

        $body = substr($response, $headerSize);

        $response = new Response($statusCode, $headers, $body);
        if (self::$recordMocks && isset(self::$mockManager)) {
            // Removing server url from mocks, as it is not relevant
            $mockUri = str_replace(Client::$serverUrl, '', $uri);
            $mockData = str_replace(Client::$serverUrl, '', $data);
            $mockHeaders = str_replace(Client::$serverUrl, '', $response->headers);
            $mockBody = str_replace(Client::$serverUrl, '', $response->body);
            $mockResponse = new Response($statusCode, $mockHeaders, $mockBody);

            $this->saveResponseMock($method.' '.$mockUri.' '.$mockData, $mockResponse);
        }

        return $response;
    }

    /**
     * @param string $mockName
     *
     * @return Response
     */
    private function getMockResponse($mockName)
    {
        $rawMockFileContents = self::$mockManager->getMock($mockName);
        $mockData            = json_decode($rawMockFileContents, true);

        return new Response($mockData['statusCode'], $mockData['headers'], $mockData['body']);
    }

    /**
     * @param string   $mockName
     * @param Response $response
     */
    private function saveResponseMock($mockName, $response)
    {
        $mockContents = json_encode($response);
        self::$mockManager->saveMock($mockName, $mockContents);
    }

    /**
     * @param string $type killbill or plugins
     *
     * @return string
     */
    private static function apiUrl($type = 'killbill')
    {
        if ($type == 'killbill') {
            return Client::$serverUrl.'/'.Client::$apiVersion.'/kb';
        } elseif ($type == 'plugins') {
            return Client::$serverUrl;
        }

        return '';
    }

    /**
     * @return string
     */
    private static function apiUser()
    {
        return Client::$apiUser;
    }

    /**
     * @return string
     */
    private static function apiPassword()
    {
        return Client::$apiPassword;
    }

    /**
     * @return string
     */
    private static function userAgentHeader()
    {
        return 'User-Agent: Killbill/'.self::API_CLIENT_VERSION.'; PHP '.phpversion().' ['.php_uname('s').']';
    }

    /**
     * @param string $headerText
     *
     * @return array[string]string
     */
    private function getHeaders($headerText)
    {
        $headers = explode("\r\n", $headerText);

        $returnHeaders = array();
        foreach ($headers as &$header) {
            preg_match('/([^:]+): (.*)/', $header, $matches);

            if (sizeof($matches) > 2) {
                $returnHeaders[$matches[1]] = $matches[2];
            }
        }

        return $returnHeaders;
    }

    /**
     * @param int $errorNumber
     * @param string $message
     *
     * @throws \Exception
     */
    private function raiseCurlError($errorNumber, $message)
    {
        $this->logger->error('Curl error '.$errorNumber.' '.$message);

        switch ($errorNumber) {
            case CURLE_COULDNT_CONNECT:
            case CURLE_COULDNT_RESOLVE_HOST:
            case CURLE_OPERATION_TIMEOUTED:
                throw new CurlException('Failed to connect to Killbill: '.$message);
            case CURLE_SSL_CACERT:
            case CURLE_SSL_PEER_CERTIFICATE:
                throw new CurlException('Could not verify Killbill\'s SSL certificate: '.$message);
            default:
                throw new CurlException('An unexpected error occurred connecting with Killbill: '.$message);
        }
    }
}
