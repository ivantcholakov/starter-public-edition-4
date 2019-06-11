<?php

namespace Omnipay\Safecharge;

use Omnipay\Tests\GatewayTestCase;

class GatewayTest extends GatewayTestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->gateway = new Gateway($this->getHttpClient(), $this->getHttpRequest());

        $this->gateway->setUsername('SafeChargeTestTRX');
        $this->gateway->setPassword('k4fGmMEuRO');

        // The default 4111111111111111 is an invalid card for SafeCharge
        $this->card = $this->getValidCard();
        $this->card['number'] = '4000024473425231';

        $this->purchaseOptions = array(
            'amount'    => '10.00',
            'currency'  => 'USD',
            'card'      => $this->card
        );
    }

    public function testPurchaseSuccess()
    {
        $this->setMockHttpResponse('PurchaseSuccess.txt');

        $response = $this->gateway->purchase($this->purchaseOptions)->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('1504674406', $response->getTransactionId());
        $this->assertSame('MQBzADAAUABzAG0AaABzAFgAVQBcAHwALABHAHkANgBDAFAAJwApAFwAKQBzACwANgAyAC0AdwBEACsAWQBdAHcANgBWADgATwAnACYAUABdADAAMwA=', $response->getToken());
        $this->assertSame('111364', $response->getAuthCode());
        $this->assertSame(null, $response->getMessage());
    }

    public function testPurchaseFailure()
    {
        $this->setMockHttpResponse('PurchaseFailure.txt');

        $response = $this->gateway->purchase($this->purchaseOptions)->send();

        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('1504674481', $response->getTransactionId());
        $this->assertSame(null, $response->getToken());
        $this->assertSame(null, $response->getAuthCode());
        $this->assertSame('Invalid Currency', $response->getMessage());
    }

    public function testRefundSuccess()
    {
        $this->setMockHttpResponse('RefundSuccess.txt');

        $response = $this->gateway->purchase($this->purchaseOptions)->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('1504674408', $response->getTransactionId());
        $this->assertSame(null, $response->getToken());
        $this->assertSame('111692', $response->getAuthCode());
        $this->assertSame(null, $response->getMessage());
    }

    public function testRefundFailure()
    {
        $this->setMockHttpResponse('RefundFailure.txt');

        $response = $this->gateway->purchase($this->purchaseOptions)->send();

        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('1504674494', $response->getTransactionId());
        $this->assertSame(null, $response->getToken());
        $this->assertSame(null, $response->getAuthCode());
        $this->assertSame('Invalid Token', $response->getMessage());
    }

    public function testVoidSuccess()
    {
        $this->setMockHttpResponse('VoidSuccess.txt');

        $response = $this->gateway->purchase($this->purchaseOptions)->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('1504674478', $response->getTransactionId());
        $this->assertSame(null, $response->getToken());
        $this->assertSame('111163', $response->getAuthCode());
        $this->assertSame(null, $response->getMessage());
    }

    public function testVoidFailure()
    {
        $this->setMockHttpResponse('VoidFailure.txt');

        $response = $this->gateway->purchase($this->purchaseOptions)->send();

        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('1504674485', $response->getTransactionId());
        $this->assertSame(null, $response->getToken());
        $this->assertSame(null, $response->getAuthCode());
        $this->assertSame('Auth Code/Trans ID/Credit Card Number Mismatch', $response->getMessage());
    }
}
