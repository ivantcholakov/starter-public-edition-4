<?php
namespace Omnipay\Safecharge\Message;

/**
 * SafeCharge Abstract Request
 */
abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
    protected $liveEndpoint = 'https://process.safecharge.com/service.asmx/Process?';
    protected $testEndpoint = 'https://test.safecharge.com/service.asmx/Process?';

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

    public function getAuthCode()
    {
        return $this->getParameter('authCode');
    }

    public function setAuthCode($value)
    {
        return $this->setParameter('authCode', $value);
    }

    public function getToken()
    {
        return $this->getParameter('token');
    }

    public function setToken($value)
    {
        return $this->setParameter('token', $value);
    }

    public function getExpMonth()
    {
        return $this->getParameter('expMonth');
    }

    public function setExpMonth($value)
    {
        return $this->setParameter('expMonth', $value);
    }

    public function getExpYear()
    {
        return $this->getParameter('expYear');
    }

    public function setExpYear($value)
    {
        return $this->setParameter('expYear', $value);
    }

    public function getData()
    {
        $this->validate('username', 'password');

        $data = array();
        $data['sg_ClientLoginID'] = $this->getUsername();
        $data['sg_ClientPassword'] = $this->getPassword();
        $data['sg_VendorID'] = $this->getVendorId();
        $data['sg_WebsiteID'] = $this->getWebsiteId();
        $data['sg_MerchantPhoneNumber'] = $this->getMerchantPhoneNumber();
        $data['sg_Descriptor'] = $this->getDescriptor();
        $data['sg_MerchantName'] = $this->getMerchantName();
        $data['sg_IPAddress'] = '127.0.0.1';
        $data['sg_ResponseFormat'] = 4;
        $data['sg_Is3dTrans'] = ($this->getIs3dTrans()) ? 1 : 0;
        $data['sg_ClientUniqueID'] = (string) time();
        $data['sg_Version'] = '4.0.2';

        return $data;
    }

    public function getBillingData()
    {
        $data = array();

        if ($card = $this->getCard()) {
            // customer details
            $data['sg_FirstName'] = $card->getBillingFirstName();
            $data['sg_LastName'] = $card->getBillingLastName();
            $data['sg_Address'] = $card->getBillingAddress1();
            $data['sg_City'] = $card->getBillingCity();
            $data['sg_State'] = $card->getBillingState();
            $data['sg_Zip'] = $card->getBillingPostcode();
            $data['sg_Country'] = $card->getBillingCountry();
            $data['sg_Phone'] = $card->getBillingPhone();
            $data['sg_IPAddress'] = $this->getClientIp();
            $data['sg_Email'] = $card->getEmail();
            // shipping details
            $data['sg_Ship_Country'] = $card->getShippingCountry();
            $data['sg_Ship_State'] =  $card->getShippingState();
            $data['sg_Ship_City'] = $card->getShippingCity();
            $data['sg_Ship_Address'] = $card->getShippingAddress1();
            $data['sg_Ship_Zip'] = $card->getShippingPostcode();
        }

        return $data;
    }

    public function sendData($data)
    {
        $httpResponse = $this->httpClient->post($this->getEndpoint(), null, $data)->send();

        // This is to generate test Mocks
        // $headersIterator = $httpResponse->getHeaders();
        // foreach ($headersIterator as $key => $val) {
        //     echo $key .": ". $val ."\n";
        // }
        // echo "\n";
        // echo $httpResponse->getBody();

        return $this->response = new Response($this, $httpResponse->getBody());
    }

    public function getEndpoint()
    {
        return $this->getTestMode() ? $this->testEndpoint : $this->liveEndpoint;
    }
}
