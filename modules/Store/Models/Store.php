<?php

namespace Modules\Store\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Modules\Base\Models\BaseModel;

class Store extends BaseModel{
    use SoftDeletes;

    protected $table = "stores";

    protected $primaryKey = "id";

    protected $dates = ["deleted_at"];

    protected $guarded = [];

    public $timestamps = true;

    protected static function boot(){
        parent::boot();

        static::creating(function($model){
            $model->key_slug = Str::random(2) . 'MALL' . Str::random(2) . time();
        });
    }

    /**
     * @param $id
     * @return Builder|Builder[]|Collection|Model|null
     */
    public static function getStore($id){
        return self::query()->find($id);
    }
}
