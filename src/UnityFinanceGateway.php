<?php
/**
 * InterKassa driver for the Omnipay PHP payment processing library
 *
 * @link      https://github.com/hiqdev/omnipay-interkassa
 * @package   omnipay-interkassa
 * @license   MIT
 * @copyright Copyright (c) 2015-2026, HiQDev (http://hiqdev.com/)
 */

namespace Omnipay\InterKassa;

/**
 * Gateway for UnityFinance, an Interkassa subcompany reusing the same Checkout Protocol
 * on a different domain.
 */
class UnityFinanceGateway extends Gateway
{
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'UnityFinance';
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultParameters()
    {
        return array_merge(parent::getDefaultParameters(), [
            'endpoint' => 'https://old-pay.unityfinance.com',
        ]);
    }
}
