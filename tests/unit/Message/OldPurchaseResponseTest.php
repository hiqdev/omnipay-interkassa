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
use Omnipay\InterKassa\Message\PurchaseRequest;

class OldPurchaseResponseTest extends PurchaseResponseTest
{
    /**
     * @var OldPurchaseRequest
     */
    protected $request;

    protected $purse = '887ac1234c1eeee1488b156b';
    protected $secret = 'Zp2zfdSJzbS61L32';
    protected $returnUrl = 'https://www.example.com/success';
    protected $cancelUrl = 'https://www.example.com/failure';
    protected $notifyUrl = 'https://www.example.com/notify';
    protected $description = 'Test Transaction long description';
    protected $transactionId = 'ID_123456';
    protected $amount = '14.65';
    protected $currency = 'USD';
    protected $sign = 'C5sYWKMUZF1SDPTAGosZntOLC8Q2WWNvxx4bwy/gIwc=';

    public function setUp()
    {
        parent::setUp();

        $this->request = new PurchaseRequest($this->getHttpClient(), $this->getHttpRequest());
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

    public function testSuccess()
    {
        /** @var PurchaseResponse $response */
        $response = $this->request->send();

        $this->assertFalse($response->isSuccessful());
        $this->assertTrue($response->isRedirect());
        $this->assertNull($response->getCode());
        $this->assertNull($response->getMessage());

        $this->assertSame('POST', $response->getRedirectMethod());
        $this->assertSame([
            'ik_co_id' => $this->purse,
            'ik_am' => $this->amount,
            'ik_pm_no' => $this->transactionId,
            'ik_desc' => $this->description,
            'ik_cur' => $this->currency,
            'ik_pnd_u' => $this->returnUrl,
            'ik_suc_u' => $this->returnUrl,
            'ik_fal_u' => $this->cancelUrl,
            'ik_ia_u' => $this->notifyUrl,
            'ik_sign' => $this->sign,
        ], $response->getRedirectData());
    }
}
