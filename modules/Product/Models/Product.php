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

class Product extends BaseModel{
    use SoftDeletes;

    protected $table = "products";

    protected $primaryKey = "id";

    protected $dates = ["deleted_at"];

    protected $guarded = [];

    public $timestamps = true;

    protected static function boot(){
        parent::boot();

        $author_id = Auth::guard('admin')->user()->id ?? 1;
        static::creating(function($model) use ($author_id){
            $model->key_slug   = Str::random(2) . $model->sku . Str::random(2) . time();
            $model->created_by = $author_id;
            $model->updated_by = $author_id;
        });

        static::updating(function($model) use ($author_id){
            $model->updated_by = $author_id;
        });

        static::saved(function($model){
            $pcb = ProductCategoryBrand::query()->firstOrCreate(['cate_id' => $model->cate_id, 'brand_id' => $model->brand_id, 'store_id' => $model->store_id]);
        });
    }

    /**
     * @param $filter
     * @return Builder
     */
    public static function filter($filter){
        $data = self::query()->with(['category','author', 'store'])->with('updatedBy');
        if(isset($filter['name'])){
            $data = $data->where('name', 'LIKE', '%' . $filter['name'] . '%');
        }
        if(isset($filter['sku'])){
            $data = $data->where('sku', 'LIKE', '%' . $filter['sku'] . '%');
        }
        if(isset($filter['status'])){
            $data = $data->where('status', $filter['status']);
        }
        if(isset($filter['cate_id'])){
            $data = $data->where('cate_id', $filter['cate_id']);
        }
        if(isset($filter['brand_id'])){
            $data = $data->where('brand_id', $filter['brand_id']);
        }
        if(isset($filter['store_id'])){
            $data = $data->where('store_id', $filter['store_id']);
        }

        return $data;
    }

    /**
     * @param $star_qty
     * @param bool $percent
     * @return float|int|string
     */
    public function getPercentStar($star_qty, $percent = true){
        $data = 0;

        return $data;
    }

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

    /**
     * @return BelongsTo
     */
    public function author(){
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * @return BelongsTo
     */
    public function updatedBy(){
        return $this->belongsTo(User::class, 'updated_by');
    }

    /**
     * @return BelongsToMany
     */
    public function attributeOptions(){
        return $this->belongsToMany(AttributeOption::class, 'product_attribute_option', 'product_id');
    }

    /**
     * @return HasMany
     */
    public function productAttributeOptions(){
        return $this->hasMany(ProductAttributeOption::class, 'product_id');
    }
}
