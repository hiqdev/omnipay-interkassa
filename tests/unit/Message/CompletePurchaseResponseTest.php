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

use Omnipay\InterKassa\Message\CompletePurchaseRequest;
use Omnipay\InterKassa\Message\CompletePurchaseResponse;
use Omnipay\Tests\TestCase;
use Symfony\Component\HttpFoundation\Request as HttpRequest;

class CompletePurchaseResponseTest extends TestCase
{
    protected $purse = '887ac1234c1eeee1488b156b';
    protected $secret = 'Zp2zfdSJzbS61L32';
    protected $payment_no = '1235151';
    protected $description = 'Test Transaction long description';
    protected $payway = 'visa_liqpay_merchant_usd';
    protected $invoiceId = '5632156';
    protected $transactionId = 'ID_123456';
    protected $amount = '5.12';
    protected $currency = 'USD';
    protected $state = 'success';
    protected $sign = '3Ra3gDluuAKUoGddlJTfrTJrQpjQHqbAbkUKB5k11y0=';
    protected $time = '2015-12-17 17:36:13';

    /**
     * @param array $options
     * @return CompletePurchaseRequest
     */
    public function createRequest($options = [])
    {
        $httpRequest = new HttpRequest([], array_merge([
            'ik_co_id' => $this->purse,
            'ik_pm_no' => $this->payment_no,
            'ik_desc' => $this->description,
            'ik_pw_via' => $this->payway,
            'ik_am' => $this->amount,
            'ik_cur' => $this->currency,
            'ik_inv_id' => $this->invoiceId,
            'ik_trn_id' => $this->transactionId,
            'ik_inv_st' => $this->state,
            'ik_inv_prc' => $this->time,
            'ik_sign' => $this->sign,
        ], $options));

        $request = new CompletePurchaseRequest($this->getHttpClient(), $httpRequest);
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
        $this->createRequest(['ik_inv_st' => 'fail', 'ik_sign' => 'iVRccLMwsoTVEgXMMn+flZAus3dgIGgvB6orib5fAKk='])->send();
    }

    public function testSuccess()
    {
        /** @var CompletePurchaseResponse $response */
        $response = $this->createRequest()->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertSame($this->purse, $response->getCheckoutId());
        $this->assertSame($this->invoiceId, $response->getTransactionId());
        $this->assertSame($this->transactionId, $response->getTransactionReference());
        $this->assertSame($this->amount, $response->getAmount());
        $this->assertSame($this->currency, $response->getCurrency());
        $this->assertSame(strtotime($this->time . ' Europe/Moscow'), $response->getTime());
        $this->assertSame($this->payway, $response->getPayer());
        $this->assertSame($this->state, $response->getState());
        $this->assertSame($this->sign, $response->getSign());
    }
}
