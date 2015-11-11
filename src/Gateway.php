<?php

/*
 * InterKassa driver for the Omnipay PHP payment processing library
 *
 * @link      https://github.com/hiqdev/omnipay-interkassa
 * @package   omnipay-interkassa
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2015, HiQDev (http://hiqdev.com/)
 */

namespace Omnipay\InterKassa;

use Omnipay\Common\AbstractGateway;

/**
 * Gateway for InterKassa Shop Cart Interface.
 * http://interkassa.com/
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
     * @param string $purse merchant purse
     *
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
     * @return \Omnipay\InterKassa\Message\PurchaseRequest
     */
    public function purchase(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\InterKassa\Message\PurchaseRequest', $parameters);
    }

    /**
     * @param array $parameters
     *
     * @return \Omnipay\InterKassa\Message\CompletePurchaseRequest
     */
    public function completePurchase(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\InterKassa\Message\CompletePurchaseRequest', $parameters);
    }
}
