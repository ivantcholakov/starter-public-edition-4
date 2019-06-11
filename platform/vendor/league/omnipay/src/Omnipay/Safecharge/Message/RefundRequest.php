<?php

namespace Omnipay\Safecharge\Message;

/**
 * SafeCharge Credit Request
 */
class RefundRequest extends VoidRequest
{
    public function getData()
    {
        $data = parent::getData();

        $data['sg_TransType'] = 'Credit';

        return $data;
    }
}
