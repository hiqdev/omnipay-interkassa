<?php

/*
 * InterKassa driver for the Omnipay PHP payment processing library
 *
 * @link      https://github.com/hiqdev/omnipay-interkassa
 * @package   omnipay-interkassa
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2015, HiQDev (http://hiqdev.com/)
 */

namespace Omnipay\InterKassa\Message;

class PurchaseRequest extends AbstractRequest
{
    public function isVersion2()
    {
        return !strpos($this->getCheckoutId(), '-');
    }

    public function getBaggageFields()
    {
        return $this->currency . ' ' . $this->username;
    }

    public function getData()
    {
        $this->validate(
            'checkoutId',
            'amount', 'currency', 'description', 'transactionId',
            'returnUrl', 'cancelUrl', 'notifyUrl'
        );

        return $this->isVersion2() ? $this->getDataVersion2() : $this->getDataVersion1();
    }

    public function getDataVersion1()
    {
        return [
            'ik_co_id'          => $this->getCheckoutId(),
            'ik_am'             => $this->getAmount(),
            'ik_pm_no'          => $this->getTransactionId(),
            'ik_desc'           => $this->getDescription(),
            'ik_cur'            => $this->getCurrency(),
            'ik_pnd_u'          => $this->getNotifyUrl(),
            'ik_suc_u'          => $this->getReturnUrl(),
            'ik_fal_u'          => $this->getCancelUrl(),
            'ik_pnd_m'          => 'POST',
            'ik_suc_m'          => 'GET',
            'ik_fal_m'          => 'GET',
        ];
    }

    public function getDataVersion2()
    {
        return [
            'ik_shop_id'        => $this->getCheckoutId(),
            'ik_payment_amount' => $this->getAmount(),
            'ik_payment_id'     => $this->transactionId(),
            'ik_payment_desc'   => $this->getDescription(),
            'ik_baggage_fields' => $this->getBaggageFields(),
            'ik_status_url'     => $this->getNotifyUrl(),
            'ik_success_url'    => $this->getReturnUrl(),
            'ik_fail_url'       => $this->getCancelUrl(),
            'ik_status_method'  => 'POST',
            'ik_success_method' => 'GET',
            'ik_fail_method'    => 'GET',
        ];
    }

    public function sendData($data)
    {
        return $this->response = new PurchaseResponse($this, $data);
    }
}
