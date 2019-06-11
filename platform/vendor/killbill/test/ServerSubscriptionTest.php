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
 * Tests for Subscription
 */
class ServerSubscriptionTest extends KillbillTest
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
            $this->externalBundleId = md5('serverSubscriptionTest'.$this->tenant->getExternalKey());
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

        // Move by a few days -- still in trial -- and change product
        $this->clock->addDays(3, $this->tenant->getTenantHeaders());
        $subscription->setPlanName('super-monthly');
        $subscriptionRes = $subscription->changePlan(null, null, null, self::USER, self::REASON, self::COMMENT, $this->tenant->getTenantHeaders());
        $this->assertEquals($subscriptionRes->getProductName(), 'Super');
        $subscription = $subscriptionRes;

        // Move by a few days -- still in trial -- and execute a cancellation
        $this->clock->addDays(3, $this->tenant->getTenantHeaders());
        $this->assertEmpty($subscription->getCancelledDate());
        $subscription->cancel(null, null, null, null, false, self::USER, self::REASON, self::COMMENT, $this->tenant->getTenantHeaders());

        $subscriptionRes = $subscription->get($this->tenant->getTenantHeaders());
        $this->assertNotEmpty($subscriptionRes->getCancelledDate());
    }

    /**
     * Test tags
     */
    public function testTags()
    {
        // Creating a subscription to make an bundle
        $subscriptionData = new Subscription($this->logger);
        $subscriptionData->setAccountId($this->account->getAccountId());
        $subscriptionData->setProductName('Super');
        $subscriptionData->setProductCategory('BASE');
        $subscriptionData->setBillingPeriod('MONTHLY');
        $subscriptionData->setPriceList('DEFAULT');
        $subscriptionData->setExternalKey($this->externalBundleId);

        $subscription = $subscriptionData->create(self::USER, self::REASON, self::COMMENT, $this->tenant->getTenantHeaders());

        $tag1 = new TagDefinition($this->logger);
        $tag1->setName('stag1-'.$this->tenant->getExternalKey());
        $tag1->setDescription('This is super tag1');
        $tag1 = $tag1->create(self::USER, self::REASON, self::COMMENT, $this->tenant->getTenantHeaders());

        $tags = $subscription->addTags(array($tag1->getId()), self::USER, self::REASON, self::COMMENT, $this->tenant->getTenantHeaders());
        $this->assertEquals(1, count($tags));

        $tags = $subscription->getTags($this->tenant->getTenantHeaders());
        $this->assertEquals(1, count($tags));
        $this->assertEquals($tags[0]->getTagDefinitionId(), $tag1->getId());

        $subscription->deleteTags(array($tag1->getId()), self::USER, self::REASON, self::COMMENT, $this->tenant->getTenantHeaders());

        $tags = $subscription->getTags($this->tenant->getTenantHeaders());
        $this->assertEquals(0, count($tags));
    }

    /**
     * Test customfields
     */
    public function testCustomFields()
    {
        // Creating a subscription to make an bundle
        $subscriptionData = new Subscription($this->logger);
        $subscriptionData->setAccountId($this->account->getAccountId());
        $subscriptionData->setProductName('Super');
        $subscriptionData->setProductCategory('BASE');
        $subscriptionData->setBillingPeriod('MONTHLY');
        $subscriptionData->setPriceList('DEFAULT');
        $subscriptionData->setExternalKey($this->externalBundleId);

        $subscription = $subscriptionData->create(self::USER, self::REASON, self::COMMENT, $this->tenant->getTenantHeaders());

        /*
         * Create a custom field
         */
        $customFields = array();

        $cf1 = new CustomField();
        $cf1->setObjectType(CustomField::OBJECTTYPE_SUBSCRIPTION);
        $cf1->setName('cf1-'.$this->tenant->getExternalKey());
        $cf1->setValue('123456');
        $customFields[] = $cf1;

        $cf2 = new CustomField();
        $cf2->setObjectType(CustomField::OBJECTTYPE_SUBSCRIPTION);
        $cf2->setName('cf2-'.$this->tenant->getExternalKey());
        $cf2->setValue('123456');
        $customFields[] = $cf2;

        $subscription->addCustomFields($customFields, self::USER, self::REASON, self::COMMENT, $this->tenant->getTenantHeaders());

        /*
         * Verify we can retrieve them
         */
        $cfs = $subscription->getCustomFields($this->tenant->getTenantHeaders());
        $this->assertEquals(2, count($cfs));

        $cf = $subscription->getCustomField($cf1->getName(), $this->tenant->getTenantHeaders());
        $this->assertEquals($cf->getName(), $cf1->getName());
        $this->assertEquals($cf->getValue(), $cf1->getValue());
        $this->assertEquals($cf->getObjectType(), $cf1->getObjectType());
        $this->assertEquals($cf->getObjectId(), $subscription->getSubscriptionId());

        /*
         * Delete one of them
         */
        $subscription->deleteCustomFields(array($cf->getCustomFieldId()), self::USER, self::REASON, self::COMMENT, $this->tenant->getTenantHeaders());

        $cfs = $subscription->getCustomFields($this->tenant->getTenantHeaders());
        $this->assertEquals(1, count($cfs));
        $this->assertEquals($cfs[0]->getName(), $cf2->getName());
    }

    /**
     * Test bundle with AO
     */
    public function testBundleWithAO()
    {
        $subscriptionData = new Subscription($this->logger);
        $subscriptionData->setAccountId($this->account->getAccountId());
        $subscriptionData->setProductName('Super');
        $subscriptionData->setProductCategory('BASE');
        $subscriptionData->setBillingPeriod('MONTHLY');
        $subscriptionData->setPriceList('DEFAULT');
        $subscriptionData->setExternalKey($this->externalBundleId);

        $subscriptionBase = $subscriptionData->create(self::USER, self::REASON, self::COMMENT, $this->tenant->getTenantHeaders());
        $this->assertEquals($subscriptionBase->getAccountId(), $subscriptionData->getAccountId());
        $this->assertEquals($subscriptionBase->getProductName(), $subscriptionData->getProductName());
        $this->assertEquals($subscriptionBase->getProductCategory(), $subscriptionData->getProductCategory());
        $this->assertEquals($subscriptionBase->getBillingPeriod(), $subscriptionData->getBillingPeriod());
        $this->assertEquals($subscriptionBase->getExternalKey(), $subscriptionData->getExternalKey());

        $this->clock->addDays(3, $this->tenant->getTenantHeaders());

        $subscriptionData2 = new Subscription($this->logger);
        $subscriptionData2->setAccountId($this->account->getAccountId());
        $subscriptionData2->setProductName('RemoteControl');
        $subscriptionData2->setProductCategory('ADD_ON');
        $subscriptionData2->setBillingPeriod('MONTHLY');
        $subscriptionData2->setPriceList('DEFAULT');
        $subscriptionData2->setExternalKey($this->externalBundleId);
        $subscriptionData2->setBundleId($subscriptionBase->getBundleId());

        $subscriptionAO = $subscriptionData2->create(self::USER, self::REASON, self::COMMENT, $this->tenant->getTenantHeaders());
        $this->assertEquals($subscriptionAO->getAccountId(), $this->account->getAccountId());
        $this->assertEquals($subscriptionAO->getProductName(), $subscriptionData2->getProductName());
        $this->assertEquals($subscriptionAO->getProductCategory(), $subscriptionData2->getProductCategory());
        $this->assertEquals($subscriptionAO->getBillingPeriod(), $subscriptionData2->getBillingPeriod());
        $this->assertEquals($subscriptionAO->getPriceList(), $subscriptionData2->getPriceList());
        $this->assertEquals($subscriptionAO->getExternalKey(), $this->externalBundleId);

        $bundle = new Bundle($this->logger);
        $bundle->setBundleId($subscriptionBase->getBundleId());
        $bundle = $bundle->get($this->tenant->getTenantHeaders());
        $this->assertNotEmpty($bundle);
        $this->assertEquals($bundle->getAccountId(), $this->account->getAccountId());
        $this->assertEquals($bundle->getExternalKey(), $this->externalBundleId);
        $this->assertEquals(count($bundle->getSubscriptions()), 2);

        unset($bundle);
        $bundle = new Bundle($this->logger);
        $bundle->setExternalKey($this->externalBundleId);
        $bundles = $bundle->getByExternalKey($this->tenant->getTenantHeaders());
        $this->assertEquals(count($bundles), 1);
        $bundle = $bundles[0];
        $this->assertNotEmpty($bundle);
        $this->assertEquals($bundle->getAccountId(), $this->account->getAccountId());
        $this->assertEquals($bundle->getExternalKey(), $this->externalBundleId);
        $this->assertEquals(count($bundle->getSubscriptions()), 2);
        $this->assertEquals($bundle->getSubscriptions()[0]->getProductCategory(), 'BASE');
        $this->assertEquals($bundle->getSubscriptions()[1]->getProductCategory(), 'ADD_ON');
    }

    /**
     * Test bundle with tags
     */
    public function testBundleWithTags()
    {
        // Creating a subscription to make an bundle
        $subscriptionData = new Subscription($this->logger);
        $subscriptionData->setAccountId($this->account->getAccountId());
        $subscriptionData->setProductName('Super');
        $subscriptionData->setProductCategory('BASE');
        $subscriptionData->setBillingPeriod('MONTHLY');
        $subscriptionData->setPriceList('DEFAULT');
        $subscriptionData->setExternalKey($this->externalBundleId);

        $subscriptionBase = $subscriptionData->create(self::USER, self::REASON, self::COMMENT, $this->tenant->getTenantHeaders());

        $bundle = new Bundle($this->logger);
        $bundle->setBundleId($subscriptionBase->getBundleId());
        $bundle = $bundle->get($this->tenant->getTenantHeaders());

        $tag1 = new TagDefinition($this->logger);
        $tag1->setName('stag1-'.$this->tenant->getExternalKey());
        $tag1->setDescription('This is super tag1');
        $tag1 = $tag1->create(self::USER, self::REASON, self::COMMENT, $this->tenant->getTenantHeaders());

        $bundleTags = $bundle->addTags(array($tag1->getId()), self::USER, self::REASON, self::COMMENT, $this->tenant->getTenantHeaders());
        $this->assertEquals(1, count($bundleTags));

        $bundleTags = $bundle->getTags($this->tenant->getTenantHeaders());
        $this->assertEquals(1, count($bundleTags));
        $this->assertEquals($bundleTags[0]->getTagDefinitionId(), $tag1->getId());

        $bundle->deleteTags(array($tag1->getId()), self::USER, self::REASON, self::COMMENT, $this->tenant->getTenantHeaders());

        $bundleTags = $bundle->getTags($this->tenant->getTenantHeaders());
        $this->assertEquals(0, count($bundleTags));
    }

    /**
     * Test bundle with customfields
     */
    public function testBundleWithCustomFields()
    {
        // Creating a subscription to make an bundle
        $subscriptionData = new Subscription($this->logger);
        $subscriptionData->setAccountId($this->account->getAccountId());
        $subscriptionData->setProductName('Super');
        $subscriptionData->setProductCategory('BASE');
        $subscriptionData->setBillingPeriod('MONTHLY');
        $subscriptionData->setPriceList('DEFAULT');
        $subscriptionData->setExternalKey($this->externalBundleId);

        $subscriptionBase = $subscriptionData->create(self::USER, self::REASON, self::COMMENT, $this->tenant->getTenantHeaders());

        $bundle = new Bundle($this->logger);
        $bundle->setBundleId($subscriptionBase->getBundleId());
        $bundle = $bundle->get($this->tenant->getTenantHeaders());

        /*
         * Create a custom field
         */
        $customFields = array();

        $cf1 = new CustomField();
        $cf1->setObjectType(CustomField::OBJECTTYPE_BUNDLE);
        $cf1->setName('cf1-'.$this->tenant->getExternalKey());
        $cf1->setValue('123456');
        $customFields[] = $cf1;

        $cf2 = new CustomField();
        $cf2->setObjectType(CustomField::OBJECTTYPE_BUNDLE);
        $cf2->setName('cf2-'.$this->tenant->getExternalKey());
        $cf2->setValue('123456');
        $customFields[] = $cf2;

        $bundle->addCustomFields($customFields, self::USER, self::REASON, self::COMMENT, $this->tenant->getTenantHeaders());

        /*
         * Verify we can retrieve them
         */
        $cfs = $bundle->getCustomFields($this->tenant->getTenantHeaders());
        $this->assertEquals(2, count($cfs));

        $cf = $bundle->getCustomField($cf1->getName(), $this->tenant->getTenantHeaders());
        $this->assertEquals($cf->getName(), $cf1->getName());
        $this->assertEquals($cf->getValue(), $cf1->getValue());
        $this->assertEquals($cf->getObjectType(), $cf1->getObjectType());
        $this->assertEquals($cf->getObjectId(), $bundle->getBundleId());

        /*
         * Delete one of them
         */
        $bundle->deleteCustomFields(array($cf->getCustomFieldId()), self::USER, self::REASON, self::COMMENT, $this->tenant->getTenantHeaders());

        $cfs = $bundle->getCustomFields($this->tenant->getTenantHeaders());
        $this->assertEquals(1, count($cfs));
        $this->assertEquals($cfs[0]->getName(), $cf2->getName());
    }
}
