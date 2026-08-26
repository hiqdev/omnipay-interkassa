<?php
/**
 * InterKassa driver for the Omnipay PHP payment processing library
 *
 * @link      https://github.com/hiqdev/omnipay-interkassa
 * @package   omnipay-interkassa
 * @license   MIT
 * @copyright Copyright (c) 2015-2017, HiQDev (http://hiqdev.com/)
 */

namespace Omnipay\InterKassa\Tests;

use Omnipay\InterKassa\UnityFinanceGateway;

class UnityFinanceGatewayTest extends GatewayTest
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->gateway = new UnityFinanceGateway($this->getHttpClient(), $this->getHttpRequest());
        $this->gateway->setPurse($this->purse);
        $this->gateway->setSignKey($this->signKey);
        $this->gateway->setTestKey($this->testKey);
    }

    public function testGatewayName()
    {
        $this->assertSame('UnityFinance', $this->gateway->getName());
    }

    public function testEndpoint()
    {
        $this->assertSame('https://old-pay.unityfinance.com', $this->gateway->getEndpoint());
    }

    public function testPurchaseRequestUsesUnityFinanceEndpoint()
    {
        $request = $this->gateway->purchase([
            'transactionId' => $this->transactionId,
            'description' => $this->description,
            'currency' => $this->currency,
            'amount' => $this->amount,
        ]);

        $this->assertSame('https://old-pay.unityfinance.com', $request->getEndpoint());

        $response = $request->send();
        $this->assertSame('https://old-pay.unityfinance.com', $response->getRedirectUrl());
    }
}
