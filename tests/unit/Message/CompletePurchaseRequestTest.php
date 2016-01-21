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

use Omnipay\InterKassa\Message\CompletePurchaseRequest;
use Omnipay\Tests\TestCase;
use Symfony\Component\HttpFoundation\Request as HttpRequest;

class CompletePurchaseRequestTest extends TestCase
{
    /**
     * @var CompletePurchaseRequest
     */
    protected $request;

    protected $purse = '887ac1234c1eeee1488b156b';
    protected $secret = 'Zp2zfdSJzbS61L32';
    protected $description = 'Test Transaction long description';
    protected $transactionId = 'ID_123456';
    protected $amount = '1465.01';
    protected $currency = 'USD';
    protected $state = 'success';
    protected $time = '2015-12-22 11:07:12';
    protected $sign = 'ACm/nwG2yH1y3EVWIriFz4xP3icbqihbAr+06nAsgcU=';

    public function setUp()
    {
        parent::setUp();

        $httpRequest = new HttpRequest([], [
            'ik_co_id' => $this->purse,
            'ik_trn_id' => $this->transactionId,
            'ik_desc' => $this->description,
            'ik_am' => $this->amount,
            'ik_cur' => $this->currency,
            'ik_inv_prc' => $this->time,
            'ik_sign' => $this->sign,
            'ik_inv_st' => $this->state,
        ]);

        $this->request = new CompletePurchaseRequest($this->getHttpClient(), $httpRequest);
        $this->request->initialize([
            'purse' => $this->purse,
            'secret' => $this->secret,
        ]);
    }

    public function testGetData()
    {
        $data = $this->request->getData();

        $this->assertSame($this->purse, $data['ik_co_id']);
        $this->assertSame($this->transactionId, $data['ik_trn_id']);
        $this->assertSame($this->description, $data['ik_desc']);
        $this->assertSame($this->amount, $data['ik_am']);
        $this->assertSame($this->currency, $data['ik_cur']);
        $this->assertSame($this->time, $data['ik_inv_prc']);
    }

    public function testSendData()
    {
        $data = $this->request->getData();
        $response = $this->request->sendData($data);
        $this->assertSame('Omnipay\InterKassa\Message\CompletePurchaseResponse', get_class($response));
    }
}
