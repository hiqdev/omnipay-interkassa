<?php
/**
 * InterKassa driver for the Omnipay PHP payment processing library
 *
 * @link      https://github.com/hiqdev/omnipay-interkassa
 * @package   omnipay-interkassa
 * @license   MIT
 * @copyright Copyright (c) 2015-2017, HiQDev (http://hiqdev.com/)
 */

namespace Omnipay\InterKassa\Stubs;

class CompletePurchaseRequestStub
{
    public $purse = '887ac1234c1eeee1488b156b';
    public $signAlgorithm = 'sha256';
    public $signKey = 'Zp2zfdSJzbS61L32';
    public $testKey = 'W0b98idvHeKY2h3w';
    public $description = 'Test Transaction long description';
    public $transactionId = 'ID_123456';
    public $amount = '1465.01';
    public $currency = 'USD';
    public $state = 'success';
    public $time = '2015-12-22 11:07:12';
    public $sign = 'ACm/nwG2yH1y3EVWIriFz4xP3icbqihbAr+06nAsgcU=';
}
