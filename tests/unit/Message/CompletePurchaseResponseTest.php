<?php
/**
 * InterKassa driver for the Omnipay PHP payment processing library
 *
 * @link      https://github.com/hiqdev/omnipay-interkassa
 * @package   omnipay-interkassa
 * @license   MIT
 * @copyright Copyright (c) 2015-2017, HiQDev (http://hiqdev.com/)
 */

namespace Omnipay\InterKassa\Tests\Message;

use Omnipay\InterKassa\Message\CompletePurchaseRequest;
use Omnipay\InterKassa\Message\CompletePurchaseResponse;
use Omnipay\InterKassa\Stubs\CompletePurchaseResponseStub;
use Omnipay\Tests\TestCase;
use Symfony\Component\HttpFoundation\Request as HttpRequest;

class CompletePurchaseResponseTest extends TestCase
{
    /**
     * @var CompletePurchaseResponseStub
     */
    protected $stub;

    public function setUp()
    {
        parent::setUp();

        $this->stub = new CompletePurchaseResponseStub();
    }

    /**
     * @param array $options
     * @return CompletePurchaseRequest
     */
    public function createRequest($options = [])
    {
        $stub = $this->stub;

        $httpRequest = new HttpRequest([], array_merge([
            'ik_co_id' => $stub->purse,
            'ik_pm_no' => $stub->payment_no,
            'ik_desc' => $stub->description,
            'ik_pw_via' => $stub->payway,
            'ik_am' => $stub->amount,
            'ik_cur' => $stub->currency,
            'ik_inv_id' => $stub->transactionId,
            'ik_inv_st' => $stub->state,
            'ik_inv_prc' => $stub->time,
            'ik_sign' => $stub->sign,
        ], $options));

        $request = new CompletePurchaseRequest($this->getHttpClient(), $httpRequest);
        $request->initialize([
            'signAlgorithm' => $stub->signAlgorithm,
            'signKey' => $stub->signKey,
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
        $this->createRequest(['ik_inv_st' => 'fail', 'ik_sign' => 'ElWhUp/CjjSXF0ZjNIKbOk+WjpQ9/KIeowD0TjTshw0='])->send();
    }

    public function testSuccess()
    {
        /** @var CompletePurchaseResponse $response */
        $response = $this->createRequest()->send();
        $stub = $this->stub;

        $this->assertTrue($response->isSuccessful());
        $this->assertSame($stub->purse, $response->getCheckoutId());
        $this->assertSame($stub->payment_no, $response->getTransactionId());
        $this->assertSame($stub->transactionId, $response->getTransactionReference());
        $this->assertSame($stub->amount, $response->getAmount());
        $this->assertSame($stub->currency, $response->getCurrency());
        $this->assertSame($stub->timestamp, $response->getTime());
        $this->assertSame($stub->payway, $response->getPayer());
        $this->assertSame($stub->state, $response->getState());
        $this->assertSame($stub->sign, $response->getSign());
    }
}
