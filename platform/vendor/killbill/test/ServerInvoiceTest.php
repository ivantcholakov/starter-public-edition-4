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
 * Tests for ServerInvoice
 */
class ServerInvoiceTest extends KillbillTest
{
    /** @var Account|null */
    protected $account = null;
    /** @var string|null */
    private $externalBundleId = null;

    /**
     * Set up the test
     */
    public function setUp()
    {
        parent::setUp();

        $this->externalBundleId = uniqid();
        if (getenv('ENV') === 'local' || getenv('RECORD_REQUESTS') == '1') {
            $this->externalBundleId = md5('serverInvoiceTest'.$this->tenant->getExternalKey());
        }
        $this->account = $this->accountData->create(self::USER, self::REASON, self::COMMENT, $this->tenant->getTenantHeaders());

        $paymentMethod = new PaymentMethod($this->logger);
        $paymentMethod->setAccountId($this->account->getAccountId());
        $paymentMethod->setIsDefault(true);
        $paymentMethod->setPluginName('__EXTERNAL_PAYMENT__');
        $paymentMethod->create(self::USER, self::REASON, self::COMMENT, $this->tenant->getTenantHeaders());

        $this->account = $this->account->get($this->tenant->getTenantHeaders());
        $this->assertNotEmpty($this->account->getPaymentMethodId());
    }

    /**
     * Tear down the Test
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
        $subscriptionData = new Subscription($this->logger);
        $subscriptionData->setAccountId($this->account->getAccountId());
        $subscriptionData->setProductName('Sports');
        $subscriptionData->setProductCategory('BASE');
        $subscriptionData->setBillingPeriod('MONTHLY');
        $subscriptionData->setPriceList('DEFAULT');
        $subscriptionData->setExternalKey($this->externalBundleId);

        $subscription = $subscriptionData->create(self::USER, self::REASON, self::COMMENT, $this->tenant->getTenantHeaders());
        $this->assertEquals($subscription->getAccountId(), $subscriptionData->getAccountId());
        $this->assertEquals($subscription->getProductName(), $subscriptionData->getProductName());
        $this->assertEquals($subscription->getProductCategory(), $subscriptionData->getProductCategory());
        $this->assertEquals($subscription->getBillingPeriod(), $subscriptionData->getBillingPeriod());
        $this->assertEquals($subscription->getExternalKey(), $subscriptionData->getExternalKey());

        // Move clock after trials
        $this->clock->addDays(31, $this->tenant->getTenantHeaders());

        // Should see 2 invoices for account
        $invoices = $this->account->getInvoices(true, null, $this->tenant->getTenantHeaders());
        $this->assertEquals(2, count($invoices));

        // Retrieve each invoice by id
        $invoice = new Invoice($this->logger);
        $invoice->setInvoiceId($invoices[0]->getInvoiceId());
        $invoice = $invoice->get(false, $this->tenant->getTenantHeaders());
        $this->assertNotEmpty($invoice);
        $this->assertNotEmpty($invoice->getAccountId());
        $this->assertNotEmpty($invoice->getInvoiceId());
        $this->assertNotEmpty($invoice->getCurrency());
        $this->assertEquals($invoice->getAmount(), 0);
        $this->assertEquals($invoice->getBalance(), 0);
        $this->assertEmpty($invoice->getItems());

        $invoice = new Invoice($this->logger);
        $invoice->setInvoiceId($invoices[1]->getInvoiceId());
        $invoice = $invoice->get(true, $this->tenant->getTenantHeaders());
        $this->assertNotEmpty($invoice);
        $this->assertNotEmpty($invoice->getAccountId());
        $this->assertNotEmpty($invoice->getInvoiceId());
        $this->assertNotEmpty($invoice->getCurrency());
        $this->assertEquals($invoice->getAmount(), 500);
        $this->assertEquals($invoice->getBalance(), 0);
        $this->assertNotEmpty($invoice->getItems());
        $this->assertEquals(1, count($invoice->getItems()));
    }

    /**
     * Test tags
     */
    public function testTags()
    {
        // Creating a subscription to make an invoice
        $subscriptionData = new Subscription($this->logger);
        $subscriptionData->setAccountId($this->account->getAccountId());
        $subscriptionData->setProductName('Sports');
        $subscriptionData->setProductCategory('BASE');
        $subscriptionData->setBillingPeriod('MONTHLY');
        $subscriptionData->setPriceList('DEFAULT');
        $subscriptionData->setExternalKey($this->externalBundleId);

        $subscription = $subscriptionData->create(self::USER, self::REASON, self::COMMENT, $this->tenant->getTenantHeaders());

        // Should see 2 invoices for account
        $invoices = $this->account->getInvoices(true, null, $this->tenant->getTenantHeaders());
        $invoice = $invoices[0];

        /*
         * Create the tag definitions
         */
        $tag1 = new TagDefinition($this->logger);
        $tag1->setName('tag1-'.$this->tenant->getExternalKey());
        $tag1->setDescription('This is tag1');
        $tag1 = $tag1->create(self::USER, self::REASON, self::COMMENT, $this->tenant->getTenantHeaders());

        $tag2 = new TagDefinition($this->logger);
        $tag2->setName('tag2-'.$this->tenant->getExternalKey());
        $tag2->setDescription('This is tag2');
        $tag2 = $tag2->create(self::USER, self::REASON, self::COMMENT, $this->tenant->getTenantHeaders());

        /*
         * Add tags
         */
        $accountTags = $invoice->addTags(array($tag1->getId(), $tag2->getId()), self::USER, self::REASON, self::COMMENT, $this->tenant->getTenantHeaders());
        $this->assertEquals(2, count($accountTags));

        /*
         * Verify we can retrieve them
         */
        $tags = $invoice->getTags($this->tenant->getTenantHeaders());
        $this->assertEquals(2, count($tags));
        if (strcmp($tags[0]->getTagDefinitionName(), $tag1->getName()) == 0) {
            $this->assertEquals($tags[0]->getTagDefinitionId(), $tag1->getId());
            $this->assertEquals($tags[1]->getTagDefinitionId(), $tag2->getId());
        } else {
            $this->assertEquals($tags[1]->getTagDefinitionId(), $tag1->getId());
            $this->assertEquals($tags[0]->getTagDefinitionId(), $tag2->getId());
        }

        /*
         * Delete one of them
         */
        $invoice->deleteTags(array($tag1->getId()), self::USER, self::REASON, self::COMMENT, $this->tenant->getTenantHeaders());
        $tags = $invoice->getTags($this->tenant->getTenantHeaders());
        $this->assertEquals(1, count($tags));
        $this->assertEquals($tags[0]->getTagDefinitionId(), $tag2->getId());
    }

    /**
     * Test customfields
     */
    public function testCustomFields()
    {
        // Creating a subscription to make an invoice
        $subscriptionData = new Subscription($this->logger);
        $subscriptionData->setAccountId($this->account->getAccountId());
        $subscriptionData->setProductName('Sports');
        $subscriptionData->setProductCategory('BASE');
        $subscriptionData->setBillingPeriod('MONTHLY');
        $subscriptionData->setPriceList('DEFAULT');
        $subscriptionData->setExternalKey($this->externalBundleId);

        $subscription = $subscriptionData->create(self::USER, self::REASON, self::COMMENT, $this->tenant->getTenantHeaders());

        $invoices = $this->account->getInvoices(true, null, $this->tenant->getTenantHeaders());
        $invoice = $invoices[0];

        /*
         * Create a custom field
         */
        $customFields = array();

        $cf1 = new CustomField();
        $cf1->setObjectType(CustomField::OBJECTTYPE_INVOICE);
        $cf1->setName('cf1-'.$this->tenant->getExternalKey());
        $cf1->setValue('123456');
        $customFields[] = $cf1;

        $cf2 = new CustomField();
        $cf2->setObjectType(CustomField::OBJECTTYPE_INVOICE);
        $cf2->setName('cf2-'.$this->tenant->getExternalKey());
        $cf2->setValue('123456');
        $customFields[] = $cf2;

        $invoice->addCustomFields($customFields, self::USER, self::REASON, self::COMMENT, $this->tenant->getTenantHeaders());

        /*
         * Verify we can retrieve them
         */
        $cfs = $invoice->getCustomFields($this->tenant->getTenantHeaders());
        $this->assertEquals(2, count($cfs));

        $cf = $invoice->getCustomField($cf1->getName(), $this->tenant->getTenantHeaders());
        $this->assertEquals($cf->getName(), $cf1->getName());
        $this->assertEquals($cf->getValue(), $cf1->getValue());
        $this->assertEquals($cf->getObjectType(), $cf1->getObjectType());
        $this->assertEquals($cf->getObjectId(), $invoice->getInvoiceId());

        /*
         * Delete one of them
         */
        $invoice->deleteCustomFields(array($cf->getCustomFieldId()), self::USER, self::REASON, self::COMMENT, $this->tenant->getTenantHeaders());

        $cfs = $invoice->getCustomFields($this->tenant->getTenantHeaders());
        $this->assertEquals(1, count($cfs));
        $this->assertEquals($cfs[0]->getName(), $cf2->getName());

        /*
         * Simpler add method
         */
        $invoice->addCustomField('cf3-'.$this->tenant->getExternalKey(), '123456', self::USER, self::REASON, self::COMMENT, $this->tenant->getTenantHeaders());
        $cfs = $invoice->getCustomFields($this->tenant->getTenantHeaders());
        $this->assertEquals(2, count($cfs));
    }
}
