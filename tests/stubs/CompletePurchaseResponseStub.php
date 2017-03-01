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

class CompletePurchaseResponseStub
{
    public $purse = '887ac1234c1eeee1488b156b';
    public $signAlgorithm = 'sha256';
    public $signKey = 'Zp2zfdSJzbS61L32';
    public $testKey = 'W0b98idvHeKY2h3w';
    public $payment_no = '1235151';
    public $description = 'Test Transaction long description';
    public $payway = 'visa_liqpay_merchant_usd';
    public $invoiceId = '5632156';
    public $transactionId = 'ID_123456';
    public $amount = '5.12';
    public $currency = 'USD';
    public $state = 'success';
    public $sign = 'CwbLEwwevJc/5TyOTfIPDXMfIfXP5tPjWkUDX98bAug=';
    public $time = '2015-12-17 17:36:13';
    public $timestamp = 1450362973;
}
