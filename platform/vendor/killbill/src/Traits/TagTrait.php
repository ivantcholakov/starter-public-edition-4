<?php

namespace Killbill\Client\Traits;

use Killbill\Client\Client;
use Killbill\Client\Exception\Exception;
use Killbill\Client\Tag;

/**
 * Methods to manage Tags
 */
trait TagTrait
{
    /**
     * @param string[]|null $headers Any additional headers
     *
     * @return Tag[]|null
     */
    public function getTags($headers = null)
    {
        $response = $this->getRequest($this->baseUri().Client::PATH_TAGS, $headers);

        try {
            /** @var Tag[]|null $object */
            $object = $this->getFromBody(Tag::class, $response);
        } catch (Exception $e) {
            $this->logger->error($e);

            return null;
        }

        return $object;
    }

    /**
     * @param string[]      $tags    Tags list
     * @param string|null   $user
     * @param string|null   $reason
     * @param string|null   $comment
     * @param string[]|null $headers Any additional headers
     *
     * @return Tag[]|null
     */
    public function addTags($tags, $user, $reason, $comment, $headers = null)
    {
        $response = $this->createRequest($this->baseUri().Client::PATH_TAGS.'?tagList='.join(',', $tags), $user, $reason, $comment, $headers);

        try {
            /** @var Tag[]|null $object */
            $object = $this->getFromResponse(Tag::class, $response, $headers);
        } catch (Exception $e) {
            $this->logger->error($e);

            return null;
        }

        return $object;
    }

    /**
     * @param string[]      $tags    Tags list
     * @param string|null   $user    User requesting the creation
     * @param string|null   $reason  Reason for the creation
     * @param string|null   $comment Any addition comment
     * @param string[]|null $headers Any additional headers
     *
     * @return null
     */
    public function deleteTags($tags, $user, $reason, $comment, $headers = null)
    {
        $response = $this->deleteRequest($this->baseUri().Client::PATH_TAGS.'?tagList='.join(',', $tags), $user, $reason, $comment, $headers);

        return null;
    }
}
