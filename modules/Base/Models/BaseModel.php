<?php

namespace Modules\Base\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class BaseModel
 * @package Modules\Base\Model
 */
class BaseModel extends Model{
    /**
     * @param null $status
     * @param null $condition
     * @param bool $in
     * @param bool $not_in
     * @return array
     */
    public static function getArray($status = null, $condition = null, $in = false, $not_in = false){
        $query = self::query();
        if(!empty($condition)){
            $query = $query->where($condition);
        }
        if(!empty($status)){
            $query = $query->where('status', $status);
        }
        if($in){
            $query = $query->whereIn('id', $in);
        }
        if($not_in){
            $query = $query->whereNotIn('id', $not_in);
        }

        return $query->orderBy('name', 'asc')->pluck("name", "id")->toArray();
    }
}
