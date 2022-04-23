<?php

namespace Modules\Page\Models;

use Modules\Base\Models\BaseModel;

/**
 * Class Website
 * @package Modules\Setting\Model
 */
class Home extends BaseModel
{
    protected $table = "homes";

    protected $primaryKey = "id";

    protected $guarded = [];

    public $timestamps = false;

    /**
     * @param $key
     * @return |null
     */
    public static function getValueByKey($key) {

        $setting = self::query()->where('key', $key)->first();

        if (!empty($setting)) {
            return $setting->value;
        }

        return NULL;
    }

    const BANNER = 'BANNER';
    const BANNER_TITLE = 'BANNER_TITLE';
    const BANNER_LINK = 'BANNER_LINK';
    const PRODUCT = 'PRODUCT';
    const CATALOG_LEFT_IMAGE = 'CATALOG_LEFT_IMAGE';
    const CATALOG_LEFT_TITLE = 'CATALOG_LEFT_TITLE';
    const CATALOG_LEFT_CONTENT = 'CATALOG_LEFT_CONTENT';
    const CATALOG_RIGHT_TITLE = 'CATALOG_RIGHT_TITLE';
    const CATALOG_RIGHT_CONTENT = 'CATALOG_RIGHT_CONTENT';
    const CATALOG_RIGHT_IMG_1 = 'CATALOG_RIGHT_IMG_1';
    const CATALOG_RIGHT_IMG_2 = 'CATALOG_RIGHT_IMG_2';
    const CATALOG_RIGHT_IMG_3 = 'CATALOG_RIGHT_IMG_3';
    const CATALOG_RIGHT_CONTENT_1 = 'CATALOG_RIGHT_CONTENT_1';
    const CATALOG_RIGHT_CONTENT_2 = 'CATALOG_RIGHT_CONTENT_2';
    const CATALOG_RIGHT_CONTENT_3 = 'CATALOG_RIGHT_CONTENT_3';
    const OUR_STORY_TITLE = 'OUR_STORY_TITLE';
    const OUR_STORY_CONTENT = 'OUR_STORY_CONTENT';
    const OUR_STORY_IMAGE = 'OUR_STORY_IMAGE';

    const HOME_CONFIG = [
        self::BANNER,
        self::BANNER_TITLE,
        self::BANNER_LINK,
        self::PRODUCT,
        self::CATALOG_LEFT_IMAGE,
        self::CATALOG_LEFT_TITLE,
        self::CATALOG_LEFT_CONTENT,
        self::CATALOG_RIGHT_TITLE,
        self::CATALOG_RIGHT_CONTENT,
        self::CATALOG_RIGHT_IMG_1,
        self::CATALOG_RIGHT_IMG_2,
        self::CATALOG_RIGHT_IMG_3,
        self::CATALOG_RIGHT_CONTENT_1,
        self::CATALOG_RIGHT_CONTENT_2,
        self::CATALOG_RIGHT_CONTENT_3,
        self::OUR_STORY_TITLE,
        self::OUR_STORY_CONTENT,
        self::OUR_STORY_IMAGE,
    ];

    /**
     * @return array
     */
    public static function getWebsiteConfig()
    {
        $web_config = [];
        foreach (self::HOME_CONFIG as $item) {
            $web_config[$item] = self::getValueByKey($item);
        }

        return $web_config;
    }
}
