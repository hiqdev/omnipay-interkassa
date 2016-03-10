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

class OldCompletePurchaseRequestStub extends CompletePurchaseRequestStub
{
    public $purse = '62B97027-5260-1442-CF1A-7BDC16454400';
    public $sign = 'V0VYdl/G3aHvoilH69DcKMaKkghmi5BVkGc9FZfy6No=';
}
