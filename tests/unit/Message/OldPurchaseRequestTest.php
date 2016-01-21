<?php

/*
 * InterKassa driver for the Omnipay PHP payment processing library
 *
 * @link      https://github.com/hiqdev/omnipay-interkassa
 * @package   omnipay-interkassa
 * @license   MIT
 * @copyright Copyright (c) 2015-2016, HiQDev (http://hiqdev.com/)
 */

namespace Omnipay\InterKassa\Tests\Message;

use Omnipay\InterKassa\Message\OldPurchaseRequest;

class OldPurchaseRequestTest extends PurchaseRequestTest
{
    /**
     * @var OldPurchaseRequest
     */
    protected $request;

    protected $purse = '62B97027-5260-1442-CF1A-7BDC16454400';

    public function setUp()
    {
        parent::setUp();

        $this->request = new OldPurchaseRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->initialize([
            'purse' => $this->purse,
            'secret' => $this->secret,
            'returnUrl' => $this->returnUrl,
            'cancelUrl' => $this->cancelUrl,
            'notifyUrl' => $this->notifyUrl,
            'description' => $this->description,
            'transactionId' => $this->transactionId,
            'amount' => $this->amount,
            'currency' => $this->currency,
        ]);
    }

    public function testGetData()
    {
        $data = $this->request->getData();

        $this->assertSame($this->purse, $data['ik_shop_id']);
        $this->assertSame($this->returnUrl, $data['ik_success_url']);
        $this->assertSame($this->cancelUrl, $data['ik_fail_url']);
        $this->assertSame($this->notifyUrl, $data['ik_status_url']);
        $this->assertSame($this->description, $data['ik_payment_desc']);
        $this->assertSame($this->transactionId, $data['ik_payment_id']);
        $this->assertSame($this->amount, $data['ik_payment_amount']);
    }

    public function testSendData()
    {
        $data = $this->request->getData();
        $response = $this->request->sendData($data);
        $this->assertSame('Omnipay\InterKassa\Message\PurchaseResponse', get_class($response));
    }
}
