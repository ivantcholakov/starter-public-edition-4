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
 * Tests for ServerPaymentMethod
 */
class ServerPaymentMethodTest extends KillbillTest
{
    /** @var Account|null */
    protected $account = null;
    /** @var string|null */
    private $externalBundleId = null;

    /**
     * Set up test
     */
    public function setUp()
    {
        parent::setUp();

        $this->externalBundleId = uniqid();
        if (getenv('ENV') === 'local' || getenv('RECORD_REQUESTS') == '1') {
            $this->externalBundleId = md5('serverPaymentMethodTest'.$this->tenant->getExternalKey());
        }

        $this->account = $this->accountData->create(self::USER, self::REASON, self::COMMENT, $this->tenant->getTenantHeaders());
    }

    /**
     * Tear down test
     */
    public function tearDown()
    {
        parent::tearDown();

        unset($this->externalBundleId);
        unset($this->account);
    }

    /**
     * Test basic functionality
     */
    public function testBasic()
    {
        $paymentMethod = new PaymentMethod($this->logger);
        $paymentMethod->setAccountId($this->account->getAccountId());
        $paymentMethod->setIsDefault(true);
        $paymentMethod->setPluginName('__EXTERNAL_PAYMENT__');
        $paymentMethod->create(self::USER, self::REASON, self::COMMENT, $this->tenant->getTenantHeaders());

        $this->account = $this->account->get($this->tenant->getTenantHeaders());
        $this->assertNotEmpty($this->account->getPaymentMethodId());

        $paymentMethods = $this->account->getPaymentMethods($this->tenant->getTenantHeaders());
        $this->assertNotEmpty($paymentMethods);
        $this->assertEquals(count($paymentMethods), 1);
        $this->assertEquals($paymentMethods[0]->getAccountId(), $this->account->getAccountId());
        $this->assertEquals($paymentMethods[0]->getIsDefault(), true);
        $this->assertEquals($paymentMethods[0]->getPluginName(), '__EXTERNAL_PAYMENT__');
    }
}
