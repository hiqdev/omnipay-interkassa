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
    /**
     * {@inheritdoc}
     */
    protected $zeroAmountAllowed = false;

    /**
     * @var string
     */
    protected $endpoint = 'https://sci.interkassa.com/';

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
     * @param string $purse merchant purse
     *
     * @return self
     */
    public function setCheckoutId($purse)
    {
        return $this->setParameter('checkoutId', $purse);
    }

    /**
     * Get the secret.
     *
     * @return string secret key
     */
    public function getSecret()
    {
        return $this->getParameter('secret');
    }

    /**
     * Set the secret.
     *
     * @param string $key secret key
     *
     * @return self
     */
    public function setSecret($key)
    {
        return $this->setParameter('secret', $key);
    }

    /**
     * Get the method for success return
     *
     * @return mixed
     */
    public function getReturnMethod()
    {
        return $this->getParameter('returnMethod');
    }

    /**
     * Sets the method for success return
     *
     * @param $returnMethod
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setReturnMethod($returnMethod)
    {
        return $this->setParameter('returnMethod', $returnMethod);
    }

    /**
     * Get the method for canceled payment return
     *
     * @return mixed
     */
    public function getCancelMethod()
    {
        return $this->getParameter('returnMethod');
    }

    /**
     * Sets the method for canceled payment return
     *
     * @param $cancelMethod
     * @return \Omnipay\Common\Message\AbstractRequest
     */

    public function setCancelMethod($cancelMethod)
    {
        return $this->setParameter('cancelMethod', $cancelMethod);
    }

    /**
     * Get the method for request notify
     *
     * @return mixed
     */
    public function getNotifyMethod()
    {
        return $this->getParameter('notifyMethod');
    }

    /**
     * Sets the method for request notify
     *
     * @param $notifyMethod
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setNotifyMethod($notifyMethod)
    {
        return $this->setParameter('notifyMethod', $notifyMethod);
    }

    /**
     * Calculates sign for the $data
     *
     * @param array $data
     * @return string
     */
    public function calculateSign($data)
    {
        unset($data['ik_sign']);
        ksort($data, SORT_STRING);
        array_push($data, $this->getSecret());
        $signString = implode(':', $data);
        $sign = base64_encode(hash('sha256', $signString, true));
        return $sign;
    }
}
