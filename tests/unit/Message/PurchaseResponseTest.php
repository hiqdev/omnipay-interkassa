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

use Omnipay\InterKassa\Message\PurchaseRequest;
use Omnipay\InterKassa\Message\PurchaseResponse;
use Omnipay\InterKassa\Stubs\PurchaseResponseStub;
use Omnipay\Tests\TestCase;

class PurchaseResponseTest extends TestCase
{
    /**
     * @var PurchaseRequest
     */
    protected $request;

    /**
     * @var PurchaseResponseStub
     */
    private $stub;

    public function setUp()
    {
        parent::setUp();

        $this->stub = new PurchaseResponseStub();
        $stub = $this->stub;

        $this->request = new PurchaseRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->initialize([
            'purse' => $stub->purse,
            'signAlgorithm' => $stub->signAlgorithm,
            'signKey' => $stub->signKey,
            'testKey' => $stub->testKey,
            'returnUrl' => $stub->returnUrl,
            'cancelUrl' => $stub->cancelUrl,
            'notifyUrl' => $stub->notifyUrl,
            'description' => $stub->description,
            'transactionId' => $stub->transactionId,
            'amount' => $stub->amount,
            'currency' => $stub->currency,
            'returnMethod' => $stub->returnMethod,
            'successMethod' => $stub->successMethod,
            'cancelMethod' => $stub->cancelMethod,
            'notifyMethod' => $stub->notifyMethod,
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
        $this->assertSame($stub->sci, $response->getRedirectUrl());

        $this->assertSame('POST', $response->getRedirectMethod());
        $this->assertSame([
            'ik_co_id' => $stub->purse,
            'ik_am' => $stub->amount,
            'ik_pm_no' => $stub->transactionId,
            'ik_desc' => $stub->description,
            'ik_cur' => $stub->currency,
            'ik_pnd_u' => $stub->returnUrl,
            'ik_pnd_m' => $stub->returnMethod,
            'ik_suc_u' => $stub->returnUrl,
            'ik_suc_m' => $stub->successMethod,
            'ik_fal_u' => $stub->cancelUrl,
            'ik_fal_m' => $stub->cancelMethod,
            'ik_ia_u' => $stub->notifyUrl,
            'ik_ia_m' => $stub->notifyMethod,
            'ik_sign' => $stub->sign,
        ], $response->getRedirectData());
    }
}
