<?php

namespace Omnipay\Safecharge\Message;

/**
 * SafeCharge Auth Request
 */
class AuthorizeRequest extends AbstractRequest
{
    public function getData()
    {
        $data = parent::getData();

        $this->validate('amount', 'currency');

        $data['sg_TransType'] = 'Auth';

        if ($this->getToken() and $this->getTransactionId()) {
            $data['sg_CCToken'] = $this->getToken();
            $data['sg_TransactionID'] = $this->getTransactionId();
            $data['sg_Rebill'] = 1;

            $this->validate('expMonth', 'expYear');

            $data['sg_ExpMonth'] = $this->getExpMonth();
            $data['sg_ExpYear'] = $this->getExpYear();
        } else {
            $this->validate('card');

            if ($this->getCard()->getName()) {
                $data['sg_NameOnCard'] = $this->getCard()->getName();
            }

            $data['sg_CardNumber'] = $this->getCard()->getNumber();
            $data['sg_ExpMonth'] = $this->getCard()->getExpiryDate('m');
            $data['sg_ExpYear'] = $this->getCard()->getExpiryDate('y');

            if ($this->getCard()->getCvv()) {
                $data['sg_CVV2'] = $this->getCard()->getCvv();
            }
        }

        $data['sg_Amount'] = $this->getAmount();
        $data['sg_Currency'] = $this->getCurrency();

        return array_merge(
            $data,
            $this->getBillingData()
        );
    }
}
