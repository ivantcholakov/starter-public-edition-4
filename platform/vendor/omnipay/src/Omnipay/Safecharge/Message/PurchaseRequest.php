<?php

namespace Omnipay\Safecharge\Message;

/**
 * SafeCharge Sale Request
 */
class PurchaseRequest extends AuthorizeRequest
{
    public function getData()
    {
        $data = parent::getData();

        $data['sg_TransType'] = 'Sale';

        // if ($this->getIs3dTrans()) {
        //     $data['sg_TransType'] = 'Sale3D';
        //     $data['sg_ApiType'] = 1;
        // }

        return $data;
    }
}
