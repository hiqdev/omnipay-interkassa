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

use Omnipay\InterKassa\Message\OldCompletePurchaseRequest;
use Omnipay\InterKassa\Stubs\OldCompletePurchaseRequestStub;
use Symfony\Component\HttpFoundation\Request as HttpRequest;

class OldCompletePurchaseRequestTest extends CompletePurchaseRequestTest
{
    /**
     * @var OldCompletePurchaseRequest
     */
    protected $request;

    /**
     * @var OldCompletePurchaseRequestStub
     */
    protected $stub;

    public function setUp()
    {
        parent::setUp();

        $stub = $this->stub = new OldCompletePurchaseRequestStub();

        $httpRequest = new HttpRequest([], [
            'ik_shop_id' => $stub->purse,
            'ik_payment_id' => $stub->transactionId,
            'ik_payment_desc' => $stub->description,
            'ik_payment_amount' => $stub->amount,
            'ik_payment_timestamp' => $stub->time,
            'ik_sign_hash' => $stub->sign,
            'ik_payment_state' => $stub->state,
        ]);

        $this->request = new OldCompletePurchaseRequest($this->getHttpClient(), $httpRequest);
        $this->request->initialize([
            'purse' => $stub->purse,
            'signAlgorithm' => $stub->signAlgorithm,
            'signKey' => $stub->signKey,
        ]);
    }

    public function testGetData()
    {
        $stub = $this->stub;
        $data = $this->request->getData();

        $this->assertSame($stub->purse, $data['ik_shop_id']);
        $this->assertSame($stub->transactionId, $data['ik_payment_id']);
        $this->assertSame($stub->description, $data['ik_payment_desc']);
        $this->assertSame($stub->amount, $data['ik_payment_amount']);
        $this->assertSame($stub->time, $data['ik_payment_timestamp']);
    }

    public function testSendData()
    {
        $data = $this->request->getData();
        $response = $this->request->sendData($data);
        $this->assertSame('Omnipay\InterKassa\Message\OldCompletePurchaseResponse', get_class($response));
    }
}
