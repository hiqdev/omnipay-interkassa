<?php

/*
 * InterKassa driver for the Omnipay PHP payment processing library
 *
 * @link      https://github.com/hiqdev/omnipay-interkassa
 * @package   omnipay-interkassa
 * @license   MIT
 * @copyright Copyright (c) 2015-2016, HiQDev (http://hiqdev.com/)
 */

namespace Omnipay\InterKassa\Message;

/**
 * Class OldPurchaseRequest
 * Implements request for APIv1.
 */
class OldPurchaseRequest extends AbstractRequest
{
    /**
     * @return string
     */
    public function getBaggageFields()
    {
        return $this->getCurrency();
    }

    /**
     * {@inheritdoc}
     */
    public function getData()
    {
        $this->validate('checkoutId', 'amount', 'currency', 'description', 'transactionId');

        $return = [
            'ik_shop_id' => $this->getCheckoutId(),
            'ik_payment_amount' => $this->getAmount(),
            'ik_payment_id' => $this->getTransactionId(),
            'ik_payment_desc' => $this->getDescription(),
        ];

        if ($ik_success_url = $this->getReturnUrl()) {
            $return['ik_success_url'] = $ik_success_url;
            $return['ik_success_method'] = $this->getReturnMethod();
        }

        if ($ik_fail_method = $this->getCancelUrl()) {
            $return['ik_fail_url'] = $ik_fail_method;
            $return['ik_fail_method'] = $this->getCancelMethod();
        }

        if ($ik_status_url = $this->getNotifyUrl()) {
            $return['ik_status_url'] = $ik_status_url;
            $return['ik_status_method'] = $this->getNotifyMethod();
        }

        return $return;
    }

    /**
     * {@inheritdoc}
     * @param mixed $data
     * @return PurchaseResponse
     */
    public function sendData($data)
    {
        return $this->response = new PurchaseResponse($this, $data);
    }
}
