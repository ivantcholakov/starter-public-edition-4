<?php

namespace Omnipay\Safecharge\Message;

/**
 * SafeCharge Void Request
 */
class VoidRequest extends AbstractRequest
{
    public function getData()
    {
        $data = parent::getData();

        $data['sg_TransType'] = 'Void';

        $this->validate('amount', 'currency', 'expMonth', 'expYear', 'token', 'authCode', 'transactionId');

        $data['sg_CCToken'] = $this->getToken();
        $data['sg_AuthCode'] = $this->getAuthCode();
        $data['sg_TransactionID'] = $this->getTransactionId();

        $data['sg_Amount'] = $this->getAmount();
        $data['sg_Currency'] = $this->getCurrency();

        $data['sg_ExpMonth'] = $this->getExpMonth();
        $data['sg_ExpYear'] = $this->getExpYear();

        return $data;
    }
}
