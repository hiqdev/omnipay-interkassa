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
use Omnipay\InterKassa\Message\OldCompletePurchaseResponse;
use Omnipay\InterKassa\Stubs\OldCompletePurchaseResponseStub;
use Symfony\Component\HttpFoundation\Request as HttpRequest;
use Omnipay\Common\Exception\InvalidResponseException;

class OldCompletePurchaseResponseTest extends CompletePurchaseResponseTest
{
    /**
     * @var OldCompletePurchaseResponseStub
     */
    protected $stub;

    public function setUp()
    {
        parent::setUp();

        $this->stub = new OldCompletePurchaseResponseStub();
    }

    /**
     * @param array $options
     * @return OldCompletePurchaseRequest
     */
    public function createRequest($options = [])
    {
        $stub = $this->stub;

        $httpRequest = new HttpRequest([], array_merge([
            'ik_shop_id' => $stub->purse,
            'ik_payment_id' => $stub->payment_no,
            'ik_payment_desc' => $stub->description,
            'ik_payment_amount' => $stub->amount,
            'ik_payment_timestamp' => $stub->time,
            'ik_sign_hash' => $stub->sign,
            'ik_payment_state' => $stub->state,
            'ik_trans_id' => $stub->transactionId,
            'ik_paysystem_alias' => $stub->payway,
        ], $options));

        $request = new OldCompletePurchaseRequest($this->getHttpClient(), $httpRequest);
        $request->initialize([
            'checkoutId' => $stub->purse,
            'signAlgorithm' => $stub->signAlgorithm,
            'signKey' => $stub->signKey,
        ]);

        return $request;
    }

    public function testSignException()
    {
        $this->expectException(InvalidResponseException::class);
        $this->expectExceptionMessage('Failed to validate signature');
        $this->createRequest([
            'ik_shop_id' => $this->stub->purse,
            'ik_wtf' => ':)',
        ])->send();
    }

    public function testStateException()
    {
        $this->expectException(InvalidResponseException::class);
        $this->expectExceptionMessage('The payment was not success');
        $this->createRequest([
            'ik_shop_id' => $this->stub->purse,
            'ik_payment_state' => 'fail',
            'ik_sign_hash' => 'IL/KyMotmW5XeL2g86kYGlVJXOYTO+HAsuSzudI0qHE=',
        ])->send();
    }

    public function testSuccess()
    {
        /** @var OldCompletePurchaseResponse $response */
        $response = $this->createRequest()->send();
        $stub = $this->stub;

        $this->assertTrue($response->isSuccessful());
        $this->assertSame($stub->purse, $response->getCheckoutId());
        $this->assertSame($stub->payment_no, $response->getTransactionId());
        $this->assertSame($stub->transactionId, $response->getTransactionReference());
        $this->assertSame($stub->amount, $response->getAmount());
        $this->assertSame($stub->currency, $response->getCurrency());
        $this->assertSame(strtotime($stub->time) - 3 * 60 * 60, strtotime($response->getTime()));
        $this->assertSame($stub->payway, $response->getPayer());
        $this->assertSame($stub->state, $response->getState());
        $this->assertSame($stub->sign, $response->getSign());
    }
}
