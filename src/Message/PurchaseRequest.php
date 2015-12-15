<?php

/*
 * InterKassa driver for the Omnipay PHP payment processing library
 *
 * @link      https://github.com/hiqdev/omnipay-interkassa
 * @package   omnipay-interkassa
 * @license   MIT
 * @copyright Copyright (c) 2015, HiQDev (http://hiqdev.com/)
 */

namespace Omnipay\InterKassa\Message;

/**
 * Class PurchaseRequest
 * @package Omnipay\InterKassa\Message
 */
class PurchaseRequest extends AbstractRequest
{
    /**
     * Whether the request is designed for API v2
     * @return boolean
     */
    public function isVersion2()
    {
        return !strpos($this->getCheckoutId(), '-');
    }

    /**
     * @return string
     */
    public function getBaggageFields()
    {
        return $this->getCurrency() . ' ' . $this->username;
    }

    /**
     * {@inheridoc}
     * @see getDataVersion1
     * @see getDataVersion2
     */
    public function getData()
    {
        $this->validate('checkoutId', 'amount', 'currency', 'description', 'transactionId');

        return $this->isVersion2() ? $this->getDataVersion2() : $this->getDataVersion1();
    }

    /**
     * @return array
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getDataVersion2()
    {
        $return = [
            'ik_co_id'          => $this->getCheckoutId(),
            'ik_am'             => $this->getAmount(),
            'ik_pm_no'          => $this->getTransactionId(),
            'ik_desc'           => $this->getDescription(),
            'ik_cur'            => $this->getCurrency(),
        ];

        if ($ik_pnd_u = $this->getReturnUrl()) {
            $return['ik_pnd_u'] = $ik_pnd_u;
            $return['ik_pnd_m'] = $this->getReturnMethod();
        }

        if ($ik_suc_u = $this->getReturnUrl()) {
            $return['ik_suc_u'] = $ik_suc_u;
            $return['ik_suc_m'] = $this->getReturnMethod();
        }

        if ($ik_fal_u = $this->getCancelUrl()) {
            $return['ik_fal_u'] = $ik_fal_u;
            $return['ik_fal_m'] = $this->getCancelMethod();
        }

        if ($ik_ia_u = $this->getNotifyUrl()) {
            $return['ik_ia_u'] = $ik_ia_u;
            $return['ik_ia_m'] = $this->getNotifyMethod();
        }

        return $return;
    }

    /**
     * Returns data array designed for API v1
     *
     * @return array
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getDataVersion1()
    {
        return [
            'ik_shop_id'        => $this->getCheckoutId(),
            'ik_payment_amount' => $this->getAmount(),
            'ik_payment_id'     => $this->getTransactionId(),
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
