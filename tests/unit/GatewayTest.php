<?php

/*
 * Paxum plugin for PHP merchant library
 *
 * @link      https://github.com/hiqdev/omnipay-paxum
 * @package   omnipay-paxum
 * @license   MIT
 * @copyright Copyright (c) 2015, HiQDev (http://hiqdev.com/)
 */

namespace Omnipay\InterKassa\Tests;

use Omnipay\InterKassa\Gateway;
use Omnipay\Tests\GatewayTestCase;

class GatewayTest extends GatewayTestCase
{
    /**
     * @var Gateway
     */
    public $gateway;

    protected $purse = '887ac1234c1eeee1488b156b';
    protected $secret = 'Zp2zfdSJzbS61L32';
    protected $transactionId = 'ID_123456';
    protected $description = 'Test completePurchase description';
    protected $currency = 'USD';
    protected $amount = '12.46';


    public function setUp()
    {
        parent::setUp();

        $this->gateway = new Gateway($this->getHttpClient(), $this->getHttpRequest());
        $this->gateway->setPurse($this->purse);
        $this->gateway->setSecret($this->secret);
    }

    public function testGateway()
    {
        $this->assertSame($this->purse, $this->gateway->getPurse());
        $this->assertSame($this->secret, $this->gateway->getSecret());
    }

    public function testCompletePurchase()
    {
        $request = $this->gateway->completePurchase([
            'transactionId' => $this->transactionId,
        ]);

        $this->assertSame($this->purse, $request->getPurse());
        $this->assertSame($this->secret, $request->getSecret());
        $this->assertSame($this->transactionId, $request->getTransactionId());
    }

    public function testPurchase()
    {
        $request = $this->gateway->purchase([
            'transactionId' => $this->transactionId,
            'description' => $this->description,
            'currency' => $this->currency,
            'amount' => $this->amount,
        ]);

        $this->assertSame($this->transactionId, $request->getTransactionId());
        $this->assertSame($this->description, $request->getDescription());
        $this->assertSame($this->currency, $request->getCurrency());
        $this->assertSame($this->amount, $request->getAmount());
    }
}
