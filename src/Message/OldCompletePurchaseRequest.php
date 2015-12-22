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

use Omnipay\Common\Exception\InvalidResponseException;

/**
 * InterKassa Complete Purchase Request
 * Implements request for APIv1
 *
 * @package Omnipay\InterKassa\Message
 */
class OldCompletePurchaseRequest extends CompletePurchaseRequest
{
    /**
     * Send the request with specified data.
     *
     * @param mixed $data The data to send
     *
     * @return OldCompletePurchaseResponse
     */
    public function sendData($data)
    {
        return $this->response = new OldCompletePurchaseResponse($this, $data);
    }

    /**
     * @inheritdoc
     */
    public function calculateSign($data)
    {
        unset($data['ik_sign_hash']);
        ksort($data, SORT_STRING);
        array_push($data, $this->getSecret());
        $signString = implode(':', $data);
        $sign = base64_encode(hash('sha256', $signString, true));
        return $sign;
    }
}
