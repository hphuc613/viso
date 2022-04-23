<?php

namespace Modules\Setting\Models;

/**
 * Class StripeConfig
 * @package Modules\Setting\Models
 */
class PaymentConfig extends Setting{
    const STRIPE_PUBLISHABLE_KEY = 'STRIPE_PUBLISHABLE_KEY';
    const STRIPE_SECRET_KEY      = 'STRIPE_SECRET_KEY';
    const PAYPAL_CLIENT_ID       = 'PAYPAL_CLIENT_ID';
    const PAYPAL_SECRET_KEY      = 'PAYPAL_SECRET_KEY';
    const PAYPAL_ENVIRONMENT     = 'PAYPAL_ENVIRONMENT';

    const CONFIG_KEY
        = [
            self::STRIPE_PUBLISHABLE_KEY,
            self::STRIPE_SECRET_KEY,
            self::PAYPAL_CLIENT_ID,
            self::PAYPAL_SECRET_KEY,
            self::PAYPAL_ENVIRONMENT,
        ];

    /**
     * @return array
     */
    public static function getStripeConfig(){
        $config = [];
        foreach(self::CONFIG_KEY as $item){
            $config[$item] = self::getValueByKey($item);
        }

        return $config;
    }
}
