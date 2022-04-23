<?php

namespace Modules\Frontend\Models;

use Modules\Product\Models\Product as BaseProduct;

class Product extends BaseProduct {

    /**
     * @param $data
     */
    public static function storeProductRecently($data) {
        $session          = request()->session();
        $recently_session = ($session->has('product_recently')) ? $session->get('product_recently') : [];

        if (($key = self::checkProductRecentlyById($data->id, $recently_session)) !== false) {
            unset($recently_session[$key]);
        }
        $recently_session[time()] = self::query()->find($data->id);
        krsort($recently_session);
        if (count($recently_session) > 4) {
            array_pop($recently_session);
        }
        $session->put('product_recently', $recently_session);
    }

    /**
     * @param $id
     * @param $recently_session
     * @return bool
     */
    static public function checkProductRecentlyById($id, $recently_session) {
        foreach ($recently_session as $key => $item) {
            if ($id == $item->id) {
                return $key;
            }
        }

        return false;
    }

}
