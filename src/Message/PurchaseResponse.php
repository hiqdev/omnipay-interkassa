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

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;

/**
 * InterKassa Purchase Response.
 * @package Omnipay\InterKassa\Message
 */
class PurchaseResponse extends AbstractResponse implements RedirectResponseInterface
{
    /**
     * @var string URL to redirect client to payment system. Used when [[isRedirect]]
     */
    protected $_redirect = 'https://sci.interkassa.com/';

    /**
     * Always returns `false`, because InterKassa always needs redirect
     * {@inheritdoc}
     */
    public function isSuccessful()
    {
        return false;
    }

    /**
     * Always returns `true`, because InterKassa always needs redirect
     * {@inheritdoc}
     */
    public function isRedirect()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function getRedirectUrl()
    {
        return $this->_redirect;
    }

    /**
     * Always `POST` for InterKassa
     * {@inheritdoc}
     */
    public function getRedirectMethod()
    {
        return 'POST';
    }

    /**
     * {@inheritdoc}
     */
    public function getRedirectData()
    {
        return $this->data;
    }
}
