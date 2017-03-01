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
use Omnipay\InterKassa\Stubs\PurchaseRequestStub;
use Omnipay\Tests\TestCase;

class PurchaseRequestTest extends TestCase
{
    /**
     * @var
     */
    private $stub;

    /**
     * @var PurchaseRequest
     */
    protected $request;

    public function setUp()
    {
        parent::setUp();

        $this->stub = new PurchaseRequestStub();
        $stub = $this->stub;

        $this->request = new PurchaseRequest($this->getHttpClient(), $this->getHttpRequest());
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

        $this->assertSame($this->stub->purse, $data['ik_co_id']);
        $this->assertSame($this->stub->returnUrl, $data['ik_suc_u']);
        $this->assertSame($this->stub->cancelUrl, $data['ik_fal_u']);
        $this->assertSame($this->stub->notifyUrl, $data['ik_ia_u']);
        $this->assertSame($this->stub->description, $data['ik_desc']);
        $this->assertSame($this->stub->transactionId, $data['ik_pm_no']);
        $this->assertSame($this->stub->amount, $data['ik_am']);
        $this->assertSame($this->stub->currency, $data['ik_cur']);
        $this->assertSame($this->stub->returnMethod, $data['ik_suc_m']);
        $this->assertSame($this->stub->returnMethod, $data['ik_pnd_m']);
        $this->assertSame($this->stub->cancelMethod, $data['ik_fal_m']);
        $this->assertSame($this->stub->notifyMethod, $data['ik_ia_m']);
    }

    public function testSendData()
    {
        $data = $this->request->getData();
        $response = $this->request->sendData($data);
        $this->assertSame('Omnipay\InterKassa\Message\PurchaseResponse', get_class($response));
    }
}
