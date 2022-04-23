<?php

namespace Modules\Product\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Base\Models\BaseModel;

class ProductAttributeOption extends BaseModel{

    protected $table = "product_attribute_option";

    protected $primaryKey = "id";

    protected $guarded = [];

    public $timestamps = false;

    /**
     * @return BelongsTo
     */
    public function option(){
        return $this->belongsTo(AttributeOption::class, 'attribute_option_id');
    }

    /**
     * @return BelongsTo
     */
    public function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }
}
