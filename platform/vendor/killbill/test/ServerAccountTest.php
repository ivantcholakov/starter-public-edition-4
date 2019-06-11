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
 * Test class for ServerAccount
 */
class ServerAccountTest extends KillbillTest
{
    /**
     * Test the basic API
     */
    public function testBasicApi()
    {
        $createdAccount = $this->accountData->create(self::USER, self::REASON, self::COMMENT, $this->tenant->getTenantHeaders());

        $this->assertEquals($this->accountData->getName(), $createdAccount->getName());
        $this->assertEquals($this->accountData->getExternalKey(), $createdAccount->getExternalKey());
        $this->assertEquals($this->accountData->getEmail(), $createdAccount->getEmail());
        $this->assertEquals($this->accountData->getCurrency(), $createdAccount->getCurrency());
        $this->assertEquals($this->accountData->getAddress1(), $createdAccount->getAddress1());
        $this->assertEquals($this->accountData->getAddress2(), $createdAccount->getAddress2());
        $this->assertEquals($this->accountData->getCompany(), $createdAccount->getCompany());
        $this->assertEquals($this->accountData->getState(), $createdAccount->getState());
        $this->assertEquals($this->accountData->getCountry(), $createdAccount->getCountry());
        $this->assertEquals($this->accountData->getPhone(), $createdAccount->getPhone());
        $this->assertEquals($this->accountData->getFirstNameLength(), $createdAccount->getFirstNameLength());
        $this->assertEquals($this->accountData->getBillCycleDayLocal(), $createdAccount->getBillCycleDayLocal());
        $this->assertEquals($this->accountData->getTimeZone(), $createdAccount->getTimeZone());

        /*
         * Verify we can retrieve it
         */
        $account = new Account($this->logger);
        $account->setAccountId($createdAccount->getAccountId());
        $account = $account->get($this->tenant->getTenantHeaders());

        /*
         * Update it
         */
        $account->setName('My awesome new name');
        $updatedAccount = $account->update(self::USER, self::REASON, self::COMMENT, $this->tenant->getTenantHeaders());
        $this->assertEquals('My awesome new name', $updatedAccount->getName());
    }

    /**
     * Test the overdue state
     */
    public function testOverdueState()
    {
        $account = $this->accountData->create(self::USER, self::REASON, self::COMMENT, $this->tenant->getTenantHeaders());

        $state = $account->getOverdueState($this->tenant->getTenantHeaders());
        $this->assertEquals($state->getName(), '__KILLBILL__CLEAR__OVERDUE_STATE__');
    }

    /**
     * Test tags
     */
    public function testTags()
    {
        $account = $this->accountData->create(self::USER, self::REASON, self::COMMENT, $this->tenant->getTenantHeaders());

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
        $accountTags = $account->addTags(array($tag1->getId(), $tag2->getId()), self::USER, self::REASON, self::COMMENT, $this->tenant->getTenantHeaders());
        $this->assertEquals(2, count($accountTags));

        /*
         * Verify we can retrieve them
         */
        $tags = $account->getTags($this->tenant->getTenantHeaders());
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
        $account->deleteTags(array($tag1->getId()), self::USER, self::REASON, self::COMMENT, $this->tenant->getTenantHeaders());
        $tags = $account->getTags($this->tenant->getTenantHeaders());
        $this->assertEquals(1, count($tags));
        $this->assertEquals($tags[0]->getTagDefinitionId(), $tag2->getId());
    }

    /**
     * Test customfields
     */
    public function testCustomFields()
    {
        $account = $this->accountData->create(self::USER, self::REASON, self::COMMENT, $this->tenant->getTenantHeaders());

        /*
         * Create a custom field
         */
        $customFields = array();

        $cf1 = new CustomField();
        $cf1->setObjectType(CustomField::OBJECTTYPE_ACCOUNT);
        $cf1->setName('cf1-'.$this->tenant->getExternalKey());
        $cf1->setValue('123456');
        $customFields[] = $cf1;

        $cf2 = new CustomField();
        $cf2->setObjectType(CustomField::OBJECTTYPE_ACCOUNT);
        $cf2->setName('cf2-'.$this->tenant->getExternalKey());
        $cf2->setValue('123456');
        $customFields[] = $cf2;

        $account->addCustomFields($customFields, self::USER, self::REASON, self::COMMENT, $this->tenant->getTenantHeaders());

        /*
         * Verify we can retrieve them
         */
        $cfs = $account->getCustomFields($this->tenant->getTenantHeaders());
        $this->assertEquals(2, count($cfs));

        $cf = $account->getCustomField($cf1->getName(), $this->tenant->getTenantHeaders());
        $this->assertEquals($cf->getName(), $cf1->getName());
        $this->assertEquals($cf->getValue(), $cf1->getValue());
        $this->assertEquals($cf->getObjectType(), $cf1->getObjectType());
        $this->assertEquals($cf->getObjectId(), $account->getAccountId());

        /*
         * Delete one of them
         */
        $account->deleteCustomFields(array($cf->getCustomFieldId()), self::USER, self::REASON, self::COMMENT, $this->tenant->getTenantHeaders());

        $cfs = $account->getCustomFields($this->tenant->getTenantHeaders());
        $this->assertEquals(1, count($cfs));
        $this->assertEquals($cfs[0]->getName(), $cf2->getName());
    }
}
