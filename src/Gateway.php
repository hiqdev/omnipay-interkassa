<?php

/*
 * InterKassa driver for the Omnipay PHP payment processing library
 *
 * @link      https://github.com/hiqdev/omnipay-interkassa
 * @package   omnipay-interkassa
 * @license   MIT
 * @copyright Copyright (c) 2015-2016, HiQDev (http://hiqdev.com/)
 */

namespace Omnipay\InterKassa;

use Omnipay\Common\AbstractGateway;

/**
 * Gateway for InterKassa Shop Cart Interface.
 * http://interkassa.com/.
 */
class Gateway extends AbstractGateway
{
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'InterKassa';
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultParameters()
    {
        return [
            'checkoutId'    => '',
            'signAlgorithm' => 'md5',
            'signKey'       => '',
            'testKey'       => '',
            'testMode'      => false,
        ];
    }

    /**
     * Get the unified purse.
     *
     * @return string merchant purse
     */
    public function getPurse()
    {
        return $this->getCheckoutId();
    }

    /**
     * Set the unified purse.
     *
     * @param $value
     * @return self
     */
    public function setPurse($value)
    {
        return $this->setCheckoutId($value);
    }

    /**
     * Get the unified secret.
     * @return string merchant secret - sign key.
     */
    public function getSecret()
    {
        return $this->getSignKey();
    }

    /**
     * Set the unified secret.
     * @param string $value merchant secret - sign key.
     * @return self
     */
    public function setSecret($value)
    {
        return $this->setSignKey($value);
    }

    /**
     * Get the merchant purse.
     *
     * @return string merchant purse
     */
    public function getCheckoutId()
    {
        return $this->getParameter('checkoutId');
    }

    /**
     * Set the merchant purse.
     *
     * @param string $value merchant purse
     *
     * @return self
     */
    public function setCheckoutId($value)
    {
        return $this->setParameter('checkoutId', $value);
    }

    /**
     * Get the sign algorithm.
     *
     * @return string sign algorithm
     */
    public function getSignAlgorithm()
    {
        return $this->getParameter('signAlgorithm');
    }

    /**
     * Set the sign algorithm.
     *
     * @param string $value sign algorithm
     *
     * @return self
     */
    public function setSignAlgorithm($value)
    {
        return $this->setParameter('signAlgorithm', $value);
    }

    /**
     * Get the sign key.
     *
     * @return string sign key
     */
    public function getSignKey()
    {
        return $this->getParameter('signKey');
    }

    /**
     * Set the sign key.
     *
     * @param string $value sign key
     *
     * @return self
     */
    public function setSignKey($value)
    {
        return $this->setParameter('signKey', $value);
    }

    /**
     * Get the test key.
     *
     * @return string test key
     */
    public function getTestKey()
    {
        return $this->getParameter('testKey');
    }

    /**
     * Set the test key.
     *
     * @param string $value test key
     *
     * @return self
     */
    public function setTestKey($value)
    {
        return $this->setParameter('testKey', $value);
    }

    /**
     * @param array $parameters
     *
     * @return \Omnipay\InterKassa\Message\PurchaseRequest|\Omnipay\InterKassa\Message\OldPurchaseRequest
     */
    public function purchase(array $parameters = [])
    {
        if ($this->isOldApi()) {
            $requestClass = '\Omnipay\InterKassa\Message\OldPurchaseRequest';
        } else {
            $requestClass = '\Omnipay\InterKassa\Message\PurchaseRequest';
        }

        return $this->createRequest($requestClass, $parameters);
    }

    /**
     * @param array $parameters
     *
     * @return \Omnipay\InterKassa\Message\CompletePurchaseRequest|\Omnipay\InterKassa\Message\OldCompletePurchaseRequest
     */
    public function completePurchase(array $parameters = [])
    {
        if ($this->isOldApi()) {
            $requestClass = '\Omnipay\InterKassa\Message\OldCompletePurchaseRequest';
        } else {
            $requestClass = '\Omnipay\InterKassa\Message\CompletePurchaseRequest';
        }

        return $this->createRequest($requestClass, $parameters);
    }

    /**
     * Whether the request is designed for API v2.
     * @return boolean
     */
    public function isOldApi()
    {
        return strpos($this->getPurse(), '-');
    }
}
