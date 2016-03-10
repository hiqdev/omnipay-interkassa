<?php

/*
 * InterKassa driver for the Omnipay PHP payment processing library
 *
 * @link      https://github.com/hiqdev/omnipay-interkassa
 * @package   omnipay-interkassa
 * @license   MIT
 * @copyright Copyright (c) 2015-2016, HiQDev (http://hiqdev.com/)
 */

namespace Omnipay\InterKassa\Stubs;

class PurchaseRequestStub
{
    public $purse = '887ac1234c1eeee1488b156b';
    public $signAlgorithm = 'sha256';
    public $signKey = 'Zp2zfdSJzbS61L32';
    public $testKey = 'W0b98idvHeKY2h3w';
    public $returnUrl = 'https://www.example.com/success';
    public $cancelUrl = 'https://www.example.com/failure';
    public $notifyUrl = 'https://www.example.com/notify';
    public $description = 'Test Transaction long description';
    public $transactionId = 'ID_123456';
    public $amount = '14.65';
    public $currency = 'USD';
    public $returnMethod = 'GET';
    public $successMethod = 'POST';
    public $cancelMethod = 'OPTIONS';
    public $notifyMethod = 'PUT';
}
