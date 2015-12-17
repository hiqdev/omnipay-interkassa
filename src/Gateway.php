<?php

/*
 * InterKassa driver for the Omnipay PHP payment processing library
 *
 * @link      https://github.com/hiqdev/omnipay-interkassa
 * @package   omnipay-interkassa
 * @license   MIT
 * @copyright Copyright (c) 2015, HiQDev (http://hiqdev.com/)
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

    public function getAssetDir()
    {
        return dirname(__DIR__) . '/assets';
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultParameters()
    {
        return [
            'checkoutId' => '',
            'secretKey'  => '',
            'testMode'   => false,
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
     * Get the secret key.
     *
     * @return string secret key
     */
    public function getSecretKey()
    {
        return $this->getParameter('secretKey');
    }

    /**
     * Set the secret key.
     *
     * @param string $value secret key
     *
     * @return self
     */
    public function setSecretKey($value)
    {
        return $this->setParameter('secretKey', $value);
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
     * Whether the request is designed for API v2
     * @return boolean
     */
    public function isOldApi()
    {
        return strpos($this->getPurse(), '-');
    }
}
