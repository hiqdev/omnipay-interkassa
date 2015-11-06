<?php

/*
 * InterKassa driver for the Omnipay PHP payment processing library
 *
 * @link      https://github.com/hiqdev/omnipay-interkassa
 * @package   omnipay-interkassa
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2015, HiQDev (http://hiqdev.com/)
 */

namespace Omnipay\InterKassa\Message;

/**
 * InterKassa Complete Purchase Request.
 */
class CompletePurchaseRequest extends AbstractRequest
{
    /**
     * Get the data for this request.
     *
     * @return array request data
     */
    public function getData()
    {
        $this->validate(
            'secretKey'
        );

        $res = [];
        foreach ($this->httpRequest->request->all() as $k => $v) {
            if (substr($k, 0, 3) === 'ik_') {
                $res[$k] = $v;
            }
        }

        return $res;
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
