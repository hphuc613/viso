<?php

namespace Modules\Product\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Modules\Base\Models\BaseModel;

class ProductCategory extends BaseModel {
    use SoftDeletes;

    protected $table = "product_categories";

    protected $primaryKey = "id";

    protected $dates = ["deleted_at"];

    protected $guarded = [];

    public $timestamps = true;

    protected static function boot() {
        parent::boot();

        static::deleting(function ($cate) {
            $cate->products->each->delete();
        });

        static::saving(function ($cate) {
            $cate->key_slug = Str::random(6) . time();
        });
    }

    /**
     * @return HasMany
     */
    public function products() {
        return $this->hasMany(Product::class, 'cate_id');
    }
}
