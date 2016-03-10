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
use Omnipay\InterKassa\Stubs\CompletePurchaseRequestStub;
use Omnipay\Tests\TestCase;
use Symfony\Component\HttpFoundation\Request as HttpRequest;

class CompletePurchaseRequestTest extends TestCase
{
    /**
     * @var CompletePurchaseRequest
     */
    protected $request;

    /**
     * @var CompletePurchaseRequestStub
     */
    protected $stub;

    public function setUp()
    {
        parent::setUp();

        $this->stub = new CompletePurchaseRequestStub();
        $stub = $this->stub;

        $httpRequest = new HttpRequest([], [
            'ik_co_id' => $stub->purse,
            'ik_trn_id' => $stub->transactionId,
            'ik_desc' => $stub->description,
            'ik_am' => $stub->amount,
            'ik_cur' => $stub->currency,
            'ik_inv_prc' => $stub->time,
            'ik_sign' => $stub->sign,
            'ik_inv_st' => $stub->state,
        ]);

        $this->request = new CompletePurchaseRequest($this->getHttpClient(), $httpRequest);
        $this->request->initialize([
            'purse' => $stub->purse,
            'signAlgorithm' => $stub->signAlgorithm,
            'signKey' => $stub->signKey,
        ]);
    }

    public function testGetData()
    {
        $data = $this->request->getData();
        $stub = $this->stub;

        $this->assertSame($stub->purse, $data['ik_co_id']);
        $this->assertSame($stub->transactionId, $data['ik_trn_id']);
        $this->assertSame($stub->description, $data['ik_desc']);
        $this->assertSame($stub->amount, $data['ik_am']);
        $this->assertSame($stub->currency, $data['ik_cur']);
        $this->assertSame($stub->time, $data['ik_inv_prc']);
    }

    public function testSendData()
    {
        $data = $this->request->getData();
        $response = $this->request->sendData($data);
        $this->assertSame('Omnipay\InterKassa\Message\CompletePurchaseResponse', get_class($response));
    }

    public function testTestMode()
    {
        $stub = $this->stub;

        $httpRequest = new HttpRequest([], [
            'ik_co_id' => $stub->purse,
            'ik_trn_id' => $stub->transactionId,
            'ik_desc' => $stub->description,
            'ik_am' => $stub->amount,
            'ik_cur' => $stub->currency,
            'ik_inv_prc' => $stub->time,
            'ik_sign' => $stub->sign,
            'ik_inv_st' => $stub->state,
        ]);

        $request = new CompletePurchaseRequest($this->getHttpClient(), $httpRequest);
        $request->initialize([
            'testMode' => true,
            'purse' => $stub->purse,
            'signAlgorithm' => $stub->signAlgorithm,
            'testKey' => $stub->testKey,
        ]);

        $data = $request->getData();

        $this->assertSame($stub->purse, $data['ik_co_id']);
        $this->assertSame($stub->transactionId, $data['ik_trn_id']);
        $this->assertSame($stub->description, $data['ik_desc']);
        $this->assertSame($stub->amount, $data['ik_am']);
        $this->assertSame($stub->currency, $data['ik_cur']);
        $this->assertSame($stub->time, $data['ik_inv_prc']);
    }
}
