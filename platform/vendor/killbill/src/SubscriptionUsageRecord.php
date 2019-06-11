<?php

namespace Killbill\Client;

use Killbill\Client\Type\SubscriptionUsageRecordAttributes;

/**
 * SubscriptionUsageRecord actions
 */
class SubscriptionUsageRecord extends SubscriptionUsageRecordAttributes
{
    /**
     * @param string|null   $user    User requesting the creation
     * @param string|null   $reason  Reason for the creation
     * @param string|null   $comment Any addition comment
     * @param string[]|null $headers Any additional headers
     *
     * @return bool
     */
    public function create($user, $reason, $comment, $headers)
    {
        $response = $this->createRequest(Client::PATH_USAGES, $user, $reason, $comment, $headers);

        // TODO: clean this
        if ($response->statusCode == 201) {
            return true;
        } else {
            return false;
        }
    }
}
