<?php

/*
 * InterKassa driver for the Omnipay PHP payment processing library
 *
 * @link      https://github.com/hiqdev/omnipay-interkassa
 * @package   omnipay-interkassa
 * @license   MIT
 * @copyright Copyright (c) 2015-2016, HiQDev (http://hiqdev.com/)
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
     * Get the sign algorithm.
     *
     * @return string sign algorithm
     */
    public function getSignAlgorithm()
    {
        return strtolower($this->getParameter('signAlgorithm'));
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
     * Get the method for success return.
     *
     * @return mixed
     */
    public function getReturnMethod()
    {
        return $this->getParameter('returnMethod');
    }

    /**
     * Sets the method for success return.
     *
     * @param $returnMethod
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setReturnMethod($returnMethod)
    {
        return $this->setParameter('returnMethod', $returnMethod);
    }

    /**
     * Get the method for canceled payment return.
     *
     * @return mixed
     */
    public function getCancelMethod()
    {
        return $this->getParameter('cancelMethod');
    }

    /**
     * Sets the method for canceled payment return.
     *
     * @param $cancelMethod
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setCancelMethod($cancelMethod)
    {
        return $this->setParameter('cancelMethod', $cancelMethod);
    }

    /**
     * Get the method for request notify.
     *
     * @return mixed
     */
    public function getNotifyMethod()
    {
        return $this->getParameter('notifyMethod');
    }

    /**
     * Sets the method for request notify.
     *
     * @param $notifyMethod
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setNotifyMethod($notifyMethod)
    {
        return $this->setParameter('notifyMethod', $notifyMethod);
    }

    /**
     * Calculates sign for the $data.
     *
     * @param array $data
     * @param string $signKey
     * @return string
     */
    public function calculateSign($data, $signKey)
    {
        unset($data['ik_sign']);
        ksort($data, SORT_STRING);
        array_push($data, $signKey);
        $signAlgorithm = $this->getSignAlgorithm();
        $signString = implode(':', $data);

        return base64_encode(hash($signAlgorithm, $signString, true));
    }
}
