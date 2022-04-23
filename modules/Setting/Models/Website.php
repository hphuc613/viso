<?php

namespace Modules\Setting\Models;

/**
 * Class Website
 * @package Modules\Setting\Model
 */
class Website extends Setting
{

    const LOGO = 'LOGO';
    const LOGO_NORMAL = 'LOGO_NORMAL';
    const LOGO_PAYMENT_PAGE = 'LOGO_PAYMENT_PAGE';
    const BACKGROUND = 'BACKGROUND';
    const FAVICON = 'FAVICON';
    const PHONE_NUMBER = 'PHONE_NUMBER';
    const EMAIL = 'EMAIL';
    const WEBSITE_NAME = 'WEBSITE_NAME';
    const FACEBOOK = 'FACEBOOK';
    const INSTAGRAM = 'INSTAGRAM';
    const ADDRESS = 'ADDRESS';
    const NAME_INVOICE = 'NAME_INVOICE';

    const WEBSITE_CONFIG = [
        self::LOGO,
        self::LOGO_NORMAL,
        self::LOGO_PAYMENT_PAGE,
        self::BACKGROUND,
        self::FAVICON,
        self::PHONE_NUMBER,
        self::EMAIL,
        self::WEBSITE_NAME,
        self::FACEBOOK,
        self::INSTAGRAM,
        self::ADDRESS,
        self::NAME_INVOICE
    ];

    /**
     * @return array
     */
    public static function getWebsiteConfig()
    {
        $web_config = [];
        foreach (self::WEBSITE_CONFIG as $item) {
            $web_config[$item] = self::getValueByKey($item);
        }

        return $web_config;
    }
}
