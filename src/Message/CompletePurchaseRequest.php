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
 *
 * @package Omnipay\InterKassa\Message
 */
class CompletePurchaseRequest extends AbstractRequest
{
    /**
     * Get the data for this request.
     * @return array request data
     * @throws InvalidResponseException
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData()
    {
        $this->validate('secret');

        $result = [];
        foreach ($this->httpRequest->request->all() as $key => $parameter) {
            if (strpos($key, 'ik_') === 0) {
                $result[$key] = $parameter;
            }
        }

        return $result;
    }

    /**
     * Send the request with specified data.
     *
     * @param mixed $data The data to send
     *
     * @return CompletePurchaseResponse
     */
    public function sendData($data)
    {
        return $this->response = new CompletePurchaseResponse($this, $data);
    }
}
