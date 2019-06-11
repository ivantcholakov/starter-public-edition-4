<?php

namespace Omnipay\Safecharge;

use Omnipay\Common\AbstractGateway;

/**
 * SafeCharge Gateway
 */
class Gateway extends AbstractGateway
{
    public function getName()
    {
        return 'SafeCharge';
    }

    public function getDefaultParameters()
    {
        return array(
            'username'  => '',
            'password'  => '',
            'testMode'  => '',
            'is3dTrans' => '',
            'vendorId'  => '',
            'websiteId' => '',
            'descriptor' => '',
            'merchantPhoneNumber' => '',
            'merchantName' => '',
        );
    }

    public function getUsername()
    {
        return $this->getParameter('username');
    }

    public function setUsername($value)
    {
        return $this->setParameter('username', $value);
    }

    public function getPassword()
    {
        return $this->getParameter('password');
    }

    public function setPassword($value)
    {
        return $this->setParameter('password', $value);
    }

    public function getTestMode()
    {
        return $this->getParameter('testMode');
    }

    public function setTestMode($value)
    {
        return $this->setParameter('testMode', $value);
    }

    public function getIs3dTrans()
    {
        return $this->getParameter('is3dTrans');
    }

    /**
     * Whether or not to apply 3D secure authentication.
     *
     * @param int $value 0 or 1
     */
    public function setIs3dTrans($value)
    {
        return $this->setParameter('is3dTrans', $value);
    }

    public function getVendorId()
    {
        return $this->getParameter('vendorId');
    }

    public function setVendorId($value)
    {
        return $this->setParameter('vendorId', $value);
    }

    public function getWebsiteId()
    {
        return $this->getParameter('websiteId');
    }

    public function setWebsiteId($value)
    {
        return $this->setParameter('websiteId', $value);
    }

    public function getDescriptor()
    {
        return $this->getParameter('descriptor');
    }

    public function setDescriptor($value)
    {
        return $this->setParameter('descriptor', $value);
    }

    public function getMerchantPhoneNumber()
    {
        return $this->getParameter('merchantPhoneNumber');
    }

    public function setMerchantPhoneNumber($value)
    {
        return $this->setParameter('merchantPhoneNumber', $value);
    }

    public function getMerchantName()
    {
        return $this->getParameter('merchantName');
    }

    public function setMerchantName($value)
    {
        return $this->setParameter('merchantName', $value);
    }

    /**
     * Purchase
     *
     * Sale Request
     */
    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Safecharge\Message\PurchaseRequest', $parameters);
    }

    /**
     * Refund
     *
     * Credit Request
     */
    public function refund(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Safecharge\Message\RefundRequest', $parameters);
    }

    /**
    * Void
    *
    * Void Request
    */
    public function void(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Safecharge\Message\VoidRequest', $parameters);
    }

    /**
    * Authorize
    *
    * Auth Request
    */
    public function authorize(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Safecharge\Message\AuthorizeRequest', $parameters);
    }

    /**
    * Capture
    *
    * Settle Request
    */
    public function capture(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Safecharge\Message\CaptureRequest', $parameters);
    }
}
