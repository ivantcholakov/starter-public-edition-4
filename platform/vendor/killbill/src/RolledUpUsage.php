<?php

namespace Killbill\Client;

use Killbill\Client\Exception\Exception;
use Killbill\Client\Type\RolledUpUsageAttributes;

/**
 * RolledUpUsage actions
 */
class RolledUpUsage extends RolledUpUsageAttributes
{
    /**
     * @param string        $subscriptionNextInvoiceDate Next invoice date
     * @param string[]|null $headers                     Any additional headers
     *
     * @return RolledUpUsage|null The fetched rolledup usage
     */
    public function get($subscriptionNextInvoiceDate, $headers = null)
    {
        $endDate   = $subscriptionNextInvoiceDate;
        $startDate = new \DateTime($endDate);
        $startDate = $startDate->modify('-1 day')->format('Y-m-d');

        $queryData              = array();
        $queryData['startDate'] = $startDate;
        $queryData['endDate']   = $endDate;

        $query    = $this->makeQuery($queryData);
        $response = $this->getRequest(Client::PATH_USAGES.'/'.$this->getSubscriptionId().$query, $headers);

        try {
            /** @var RolledUpUsage|null $object */
            $object = $this->getFromBody(RolledUpUsage::class, $response);
        } catch (Exception $e) {
            $this->logger->error($e);

            return null;
        }

        return $object;
    }
}
