<?php

/*
 * InterKassa plugin for PHP merchant library
 *
 * @link      https://github.com/hiqdev/php-merchant-interkassa
 * @package   php-merchant-interkassa
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2015, HiQDev (https://hiqdev.com/)
 */

namespace hiqdev\php\merchant\interkassa;

class Merchant extends \hiqdev\php\merchant\Merchant
{
    protected static $_defaults = [
        'system'      => 'interkassa',
        'label'       => 'InterKassa',
        'actionUrl'   => 'https://sci.interkassa.com/',
        'confirmText' => 'OK',
    ];

    public function isNewVersion()
    {
        return !strpos($this->purse, '-');
    }

    public function getPaymentNo()
    {
        return $this->username . '_' . $this->cents . '_' . $this->uniqId;
    }

    public function getPaymentId()
    {
        return (strpos($this->username,'@') === false ? $this->username : substr($this->username, 0, strpos($this->username)+1)) .'_'. $this->uniqId;
    }

    public function getBaggageFields()
    {
        return $this->currency . ' ' . $this->username;
    }

    public function getInputs()
    {
        return $this->isNewVersion() ? [
            'ik_co_id'          => strtolower($this->purse),
            'ik_am'             => $this->total,
            'ik_pm_no'          => $this->paymentNo,
            'ik_desc'           => $this->description,
            'ik_cur'            => $this->currency,
            'ik_pnd_u'          => $this->confirmUrl,
            'ik_suc_u'          => $this->successUrl,
            'ik_fal_u'          => $this->failureUrl,
            'ik_pnd_m'          => 'POST',
            'ik_suc_m'          => 'POST',
            'ik_fal_m'          => 'POST',
        ] : [
            'ik_shop_id'        => $this->purse,
            'ik_payment_amount' => $this->total,
            'ik_payment_id'     => $this->paymentId,
            'ik_payment_desc'   => $this->description,
            'ik_baggage_fields' => $this->baggageFields,
            'ik_status_url'     => $this->confirmUrl,
            'ik_success_url'    => $this->successUrl,
            'ik_fail_url'       => $this->failureUrl,
            'ik_success_method' => 'POST',
            'ik_fail_method'    => 'POST',
            'ik_status_method'  => 'POST',
        ];
    }

    public function validateConfirmation($data)
    {
        return $this->isNewVersion()
            ? $this->validateNewVersion($data)
            : $this->validateOldVersion($data)
        ;
    }

    public function validateNewVersion($data)
    {
        $iks = $data;
        if ($data['ik_co_id'] != $this->purse) {
            return 'Wrong purse';
        }
        if ($data['ik_inv_st'] != 'success') {
            return 'Wrong state';
        }
        unset($iks['ik_sign']);
        foreach ($iks as $k=>$v) if (substr($k,0,3)!='ik_') unset($iks[$k]);
        array_push($iks, $this->_secret);
        ksort($iks, SORT_STRING);
        $hash =  base64_encode(md5(implode(':',$iks), true));
        if ($hash != strtolower($data['ik_sign'])) {
            return 'Wrong hash';
        }
        $this->mset([
            'from'  => $data['ik_pm_no'],
            'txn'   => $data['ik_trn_id '],
            'sum'   => $data['ik_am'],
            'time'  => $this->formatDatetime($data['ik_inv_prc']),
        ]);
        return null;
    }

    public function validateOldVersion($data)
    {
        $iks = $data;
        if ($data['ik_shop_id'] != $this->purse) {
            return 'Wrong purse';
        }
        if ($data['ik_payment_state'] != 'success') {
            return 'Wrong state';
        }
        unset($iks['ik_sign_hash'], $iks['ik_payment_desc'], $iks['ik_payment_timestamp']);
        foreach ($iks as $k=>$v) if (substr($k,0,3)!='ik_') unset($iks[$k]);
        array_push($iks, $this->_secret);
        $hash = md5(implode(':', $iks));
        if ($hash != strtolower($data['ik_sign_hash'])) {
            return 'Wrong hash';
        }
        $this->mset(array(
            'from'  => $data['ik_payment_id'],
            'txn'   => $data['ik_trans_id'],
            'sum'   => $data['ik_payment_amount'],
            'time'  => $this->formatDatetime($data['ik_payment_timestamp']),
        ));
        return null;
    }
}
