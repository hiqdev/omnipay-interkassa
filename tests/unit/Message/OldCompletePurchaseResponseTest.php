<?php

/*
 * InterKassa driver for the Omnipay PHP payment processing library
 *
 * @link      https://github.com/hiqdev/omnipay-interkassa
 * @package   omnipay-interkassa
 * @license   MIT
 * @copyright Copyright (c) 2015, HiQDev (http://hiqdev.com/)
 */

namespace Omnipay\InterKassa\Tests\Message;

use Omnipay\InterKassa\Message\OldCompletePurchaseRequest;
use Omnipay\InterKassa\Message\OldCompletePurchaseResponse;
use Symfony\Component\HttpFoundation\Request as HttpRequest;

class OldCompletePurchaseResponseTest extends CompletePurchaseResponseTest
{
    /**
     * @var OldCompletePurchaseResponse
     */
    protected $request;

    protected $purse = '62B97027-5260-1442-CF1A-7BDC16454400';
    protected $sign = 'RtCUy16yl+8c3YidodCa7GC5j0BlI9Y0N5N6oUMLriI=';
    protected $currency = null;

    /**
     * @param array $options
     * @return OldCompletePurchaseRequest
     */
    public function createRequest($options = [])
    {
        $httpRequest = new HttpRequest([], array_merge([
            'ik_shop_id' => $this->purse,
            'ik_payment_id' => $this->transactionId,
            'ik_payment_desc' => $this->description,
            'ik_payment_amount' => $this->amount,
            'ik_payment_timestamp' => $this->time,
            'ik_sign_hash' => $this->sign,
            'ik_payment_state' => $this->state,
            'ik_trans_id' => $this->invoiceId,
            'ik_paysystem_alias' => $this->payway,

        ], $options));

        $request = new OldCompletePurchaseRequest($this->getHttpClient(), $httpRequest);
        $request->initialize([
            'secret' => $this->secret,
        ]);

        return $request;
    }

    public function testSignException()
    {
        $this->setExpectedException('Omnipay\Common\Exception\InvalidResponseException', 'Failed to validate signature');
        $this->createRequest(['ik_wtf' => ':)'])->send();
    }

    public function testStateException()
    {
        $this->setExpectedException('Omnipay\Common\Exception\InvalidResponseException', 'The payment was not success');
        $this->createRequest(['ik_payment_state' => 'fail', 'ik_sign_hash' => '2+Wv5Qna6e+BIhRrykWZ46RJ5sVeEnMdVfPUMxa8tVc='])->send();
    }
}
