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

use Omnipay\InterKassa\Message\PurchaseRequest;
use Omnipay\Tests\TestCase;

class PurchaseRequestTest extends TestCase
{
    /**
     * @var PurchaseRequest
     */
    protected $request;

    protected $purse          = '887ac1234c1eeee1488b156b';
    protected $secret         = 'Zp2zfdSJzbS61L32';
    protected $returnUrl      = 'https://www.example.com/success';
    protected $cancelUrl      = 'https://www.example.com/failure';
    protected $notifyUrl      = 'https://www.example.com/notify';
    protected $description    = 'Test Transaction long description';
    protected $transactionId  = 'ID_123456';
    protected $amount         = '14.65';
    protected $currency       = 'USD';

    public function setUp()
    {
        parent::setUp();

        $this->request = new PurchaseRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->initialize([
            'purse'         => $this->purse,
            'secret'        => $this->secret,
            'returnUrl'     => $this->returnUrl,
            'cancelUrl'     => $this->cancelUrl,
            'notifyUrl'     => $this->notifyUrl,
            'description'   => $this->description,
            'transactionId' => $this->transactionId,
            'amount'        => $this->amount,
            'currency'      => $this->currency,
        ]);
    }

    public function testGetData()
    {
        $data = $this->request->getData();

        $this->assertSame($this->purse,         $data['ik_co_id']);
        $this->assertSame($this->returnUrl,     $data['ik_suc_u']);
        $this->assertSame($this->cancelUrl,     $data['ik_fal_u']);
        $this->assertSame($this->notifyUrl,     $data['ik_ia_u']);
        $this->assertSame($this->description,   $data['ik_desc']);
        $this->assertSame($this->transactionId, $data['ik_pm_no']);
        $this->assertSame($this->amount,        $data['ik_am']);
        $this->assertSame($this->currency,      $data['ik_cur']);
    }

    public function testSendData()
    {
        $data = $this->request->getData();
        $response = $this->request->sendData($data);
        $this->assertSame('Omnipay\InterKassa\Message\PurchaseResponse', get_class($response));
    }
}
