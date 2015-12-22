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
     * {@inheritdoc}
     */
    public function getData()
    {
        $this->validate('checkoutId', 'amount', 'currency', 'description', 'transactionId');

        $return = [
            'ik_co_id'          => $this->getCheckoutId(),
            'ik_am'             => $this->getAmount(),
            'ik_pm_no'          => $this->getTransactionId(),
            'ik_desc'           => $this->getDescription(),
            'ik_cur'            => $this->getCurrency(),
        ];

        if ($ik_pnd_u = $this->getReturnUrl()) {
            $return['ik_pnd_u'] = $ik_pnd_u;
            
            if ($ik_pnd_m = $this->getReturnMethod()) {
                $return['ik_pnd_m'] = $ik_pnd_m;
            }
        }

        if ($ik_suc_u = $this->getReturnUrl()) {
            $return['ik_suc_u'] = $ik_suc_u;

            if ($ik_suc_m = $this->getReturnMethod()) {
                $return['ik_suc_m'] = $ik_suc_m;
            }
        }

        if ($ik_fal_u = $this->getCancelUrl()) {
            $return['ik_fal_u'] = $ik_fal_u;

            if ($ik_fal_m = $this->getCancelMethod()) {
                $return['ik_fal_m'] = $ik_fal_m;
            }
        }

        if ($ik_ia_u = $this->getNotifyUrl()) {
            $return['ik_ia_u'] = $ik_ia_u;

            if ($ik_ia_m = $this->getNotifyMethod()) {
                $return['ik_ia_m'] = $ik_ia_m;
            }
        }

        if ($this->getSecret()) {
            $return['ik_sign'] = $this->calculateSign($return);
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
