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
use Omnipay\InterKassa\Message\PurchaseResponse;
use Omnipay\InterKassa\Stubs\OldPurchaseResponseStub;

class OldPurchaseResponseTest extends PurchaseResponseTest
{
    /**
     * @var PurchaseResponse
     */
    protected $request;

    /**
     * @var OldPurchaseResponseStub
     */
    private $stub;

    public function setUp()
    {
        parent::setUp();

        $this->stub = new OldPurchaseResponseStub();
        $stub = $this->stub;

        $this->request = new OldPurchaseRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->initialize([
            'purse' => $stub->purse,
            'signAlgorithm' => $stub->signAlgorithm,
            'signKey' => $stub->signKey,
            'testKey' => $stub->testKey,
            'returnUrl' => $stub->returnUrl,
            'cancelUrl' => $stub->cancelUrl,
            'notifyUrl' => $stub->notifyUrl,
            'returnMethod' => $stub->returnMethod,
            'cancelMethod' => $stub->cancelMethod,
            'notifyMethod' => $stub->notifyMethod,
            'description' => $stub->description,
            'transactionId' => $stub->transactionId,
            'amount' => $stub->amount,
            'currency' => $stub->currency,
        ]);
    }

    public function testSuccess()
    {
        /** @var PurchaseResponse $response */
        $response = $this->request->send();
        $stub = $this->stub;

        $this->assertFalse($response->isSuccessful());
        $this->assertTrue($response->isRedirect());
        $this->assertNull($response->getCode());
        $this->assertNull($response->getMessage());

        $this->assertSame('POST', $response->getRedirectMethod());
        $this->assertSame([
            'ik_shop_id' => $stub->purse,
            'ik_payment_amount' => $stub->amount,
            'ik_payment_id' => $stub->transactionId,
            'ik_payment_desc' => $stub->description,
            'ik_success_url' => $stub->returnUrl,
            'ik_success_method' => $stub->returnMethod,
            'ik_fail_url' => $stub->cancelUrl,
            'ik_fail_method' => $stub->cancelMethod,
            'ik_status_url' => $stub->notifyUrl,
            'ik_status_method' => $stub->notifyMethod,
        ], $response->getRedirectData());
    }
}
