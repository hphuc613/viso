<?php

namespace Modules\Product\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Modules\Base\Models\BaseModel;
use Modules\Store\Models\Store;
use Modules\User\Models\User;

class ProductCategoryBrand extends BaseModel{

    protected $table = "product_category_brand";

    protected $primaryKey = "id";

    protected $guarded = [];

    public $timestamps = false;

    /**
     * @return BelongsTo
     */
    public function category(){
        return $this->belongsTo(ProductCategory::class, 'cate_id');
    }

    /**
     * @return BelongsTo
     */
    public function brand(){
        return $this->belongsTo(ProductBrand::class, 'brand_id');
    }

    /**
     * @return BelongsTo
     */
    public function store(){
        return $this->belongsTo(Store::class, 'store_id');
    }
}
