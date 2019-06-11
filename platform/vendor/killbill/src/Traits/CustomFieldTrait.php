<?php

namespace Killbill\Client\Traits;

use Killbill\Client\Client;
use Killbill\Client\CustomField;
use Killbill\Client\Exception\Exception;

/**
 * Methods to manage CustomFields
 */
trait CustomFieldTrait
{
    /**
     * Gets all custom fields for this account
     *
     * @param string[]|null $headers Any additional headers
     *
     * @return CustomField[]|null
     */
    public function getCustomFields($headers = null)
    {
        $response = $this->getRequest($this->baseUri().Client::PATH_CUSTOM_FIELDS, $headers);

        try {
            /** @var CustomField[]|null $object */
            $object = $this->getFromBody(CustomField::class, $response);
        } catch (Exception $e) {
            $this->logger->error($e);

            return null;
        }

        return $object;
    }

    /**
     * Gets a custom field for this account by name
     *
     * @param string        $name    Name of the custom field
     * @param string[]|null $headers Any additional headers
     *
     * @return CustomField|null
     */
    public function getCustomField($name, $headers = null)
    {
        $customFields = $this->getCustomFields($headers);

        foreach ($customFields as $customField) {
            if ($customField instanceof CustomField && $customField->getName() == $name) {
                return $customField;
            }
        }

        $this->logger->warning('No CustomField found on this object with name '.$name);

        return null;
    }

    /**
     * Adds custom fields to the account
     *
     * @param CustomField[] $customFields Array of custom field objects to add
     * @param string|null   $user         User requesting the creation
     * @param string|null   $reason       Reason for the creation
     * @param string|null   $comment      Any addition comment
     * @param string[]|null $headers      Any additional headers
     *
     * @return null
     */
    public function addCustomFields($customFields, $user, $reason, $comment, $headers = null)
    {
        $data = array();
        foreach ($customFields as $customField) {
            $data[] = $customField;
        }
        $data = json_encode($data);

        $response = $this->createRequest($this->baseUri().Client::PATH_CUSTOM_FIELDS, $user, $reason, $comment, $headers, $data);

        return null;
    }

    /**
     * Adds a custom field to the account
     *
     * @param string        $name    Name of the custom field to add
     * @param string        $value   Value of the custom field to add
     * @param string|null   $user    User requesting the creation
     * @param string|null   $reason  Reason for the creation
     * @param string|null   $comment Any addition comment
     * @param string[]|null $headers Any additional headers
     *
     * @return null
     */
    public function addCustomField($name, $value, $user, $reason, $comment, $headers = null)
    {
        $customFields = array();

        $cf = new CustomField();
        $cf->setObjectType(self::CUSTOMFIELD_OBJECTTYPE);
        $cf->setName($name);
        $cf->setValue($value);
        $customFields[] = $cf;

        return $this->addCustomFields($customFields, $user, $reason, $comment, $headers);
    }

    /**
     * Deletes custom fields from the account
     *
     * @param string[]      $customFields Custom fields ID list
     * @param string|null   $user         User requesting the creation
     * @param string|null   $reason       Reason for the creation
     * @param string|null   $comment      Any addition comment
     * @param string[]|null $headers      Any additional headers
     *
     * @return CustomField[]|null
     */
    public function deleteCustomFields($customFields, $user, $reason, $comment, $headers = null)
    {
        $response = $this->deleteRequest($this->baseUri().Client::PATH_CUSTOM_FIELDS.'?customFieldList='.join(',', $customFields), $user, $reason, $comment, $headers);

        return null;
    }
}
