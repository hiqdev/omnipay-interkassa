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

use Omnipay\InterKassa\Message\OldPurchaseRequest;
use Omnipay\InterKassa\Stubs\OldPurchaseRequestStub;
use Omnipay\Tests\TestCase;

class OldPurchaseRequestTest extends TestCase
{
    /**
     * @var OldPurchaseRequestStub
     */
    private $stub;

    /**
     * @var OldPurchaseRequest
     */
    protected $request;

    public function setUp()
    {
        parent::setUp();

        $this->stub = new OldPurchaseRequestStub();
        $stub = $this->stub;

        $this->request = new OldPurchaseRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->initialize([
            'purse' => $stub->purse,
            'signAlgorithm' => $stub->signAlgorithm,
            'signKey' => $stub->signKey,
            'testKey' => $stub->testKey,
            'returnUrl' => $stub->returnUrl,
            'returnMethod' => $stub->returnMethod,
            'cancelUrl' => $stub->cancelUrl,
            'cancelMethod' => $stub->cancelMethod,
            'notifyUrl' => $stub->notifyUrl,
            'notifyMethod' => $stub->notifyMethod,
            'description' => $stub->description,
            'transactionId' => $stub->transactionId,
            'amount' => $stub->amount,
            'currency' => $stub->currency,
        ]);
    }

    public function testGetData()
    {
        $data = $this->request->getData();

        $this->assertSame($this->stub->purse, $data['ik_shop_id']);
        $this->assertSame($this->stub->returnUrl, $data['ik_success_url']);
        $this->assertSame($this->stub->cancelUrl, $data['ik_fail_url']);
        $this->assertSame($this->stub->notifyUrl, $data['ik_status_url']);
        $this->assertSame($this->stub->description, $data['ik_payment_desc']);
        $this->assertSame($this->stub->transactionId, $data['ik_payment_id']);
        $this->assertSame($this->stub->amount, $data['ik_payment_amount']);
        $this->assertSame($this->stub->returnMethod, $data['ik_success_method']);
        $this->assertSame($this->stub->cancelMethod, $data['ik_fail_method']);
        $this->assertSame($this->stub->notifyMethod, $data['ik_status_method']);
    }

    public function testSendData()
    {
        $data = $this->request->getData();
        $response = $this->request->sendData($data);
        $this->assertSame('Omnipay\InterKassa\Message\PurchaseResponse', get_class($response));
    }
}
