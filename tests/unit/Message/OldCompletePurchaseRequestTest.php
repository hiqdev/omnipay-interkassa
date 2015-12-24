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

use Omnipay\InterKassa\Message\OldCompletePurchaseRequest;
use Symfony\Component\HttpFoundation\Request as HttpRequest;

class OldCompletePurchaseRequestTest extends CompletePurchaseRequestTest
{
    /**
     * @var OldCompletePurchaseRequest
     */
    protected $request;

    protected $purse = '62B97027-5260-1442-CF1A-7BDC16454400';
    protected $sign = 'V0VYdl/G3aHvoilH69DcKMaKkghmi5BVkGc9FZfy6No=';

    public function setUp()
    {
        parent::setUp();

        $httpRequest = new HttpRequest([], [
            'ik_shop_id' => $this->purse,
            'ik_payment_id' => $this->transactionId,
            'ik_payment_desc' => $this->description,
            'ik_payment_amount' => $this->amount,
            'ik_payment_timestamp' => $this->time,
            'ik_sign_hash' => $this->sign,
            'ik_payment_state' => $this->state,
        ]);

        $this->request = new OldCompletePurchaseRequest($this->getHttpClient(), $httpRequest);
        $this->request->initialize([
            'purse' => $this->purse,
            'secret' => $this->secret,
        ]);
    }

    public function testGetData()
    {
        $data = $this->request->getData();

        $this->assertSame($this->purse, $data['ik_shop_id']);
        $this->assertSame($this->transactionId, $data['ik_payment_id']);
        $this->assertSame($this->description, $data['ik_payment_desc']);
        $this->assertSame($this->amount, $data['ik_payment_amount']);
        $this->assertSame($this->time, $data['ik_payment_timestamp']);
    }

    public function testSendData()
    {
        $data = $this->request->getData();
        $response = $this->request->sendData($data);
        $this->assertSame('Omnipay\InterKassa\Message\OldCompletePurchaseResponse', get_class($response));
    }
}
