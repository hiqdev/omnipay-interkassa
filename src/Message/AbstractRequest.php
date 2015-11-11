<?php

/*
 * InterKassa driver for the Omnipay PHP payment processing library
 *
 * @link      https://github.com/hiqdev/omnipay-interkassa
 * @package   omnipay-interkassa
 * @license   MIT
 * @copyright Copyright (c) 2015, HiQDev (http://hiqdev.com/)
 */

namespace Omnipay\InterKassa\Message;

/**
 * InterKassa Abstract Request.
 */
abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
    protected $zeroAmountAllowed = false;

    protected $endpoint = 'https://sci.interkassa.com/';

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
     * @param string $purse merchant purse
     *
     * @return self
     */
    public function setCheckoutId($purse)
    {
        return $this->setParameter('checkoutId', $purse);
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
     * @param string $key secret key
     *
     * @return self
     */
    public function setSecretKey($key)
    {
        return $this->setParameter('secretKey', $key);
    }
}
