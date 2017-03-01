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

use Omnipay\Common\Exception\InvalidResponseException;

/**
 * InterKassa Complete Purchase Request.
 */
class CompletePurchaseRequest extends AbstractRequest
{
    /**
     * Get the data for this request.
     * @throws InvalidResponseException
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     * @return array request data
     */
    public function getData()
    {
        if ($this->getTestMode()) {
            $this->validate('testKey');
        } else {
            $this->validate('signKey');
        }

        $result = [];
        $vars = array_merge($this->httpRequest->query->all(), $this->httpRequest->request->all());
        foreach ($vars as $key => $parameter) {
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
