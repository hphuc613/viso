<?php

namespace Modules\Product\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Base\Models\BaseModel;

class AttributeOption extends BaseModel{
    use SoftDeletes;

    protected $table = "attribute_options";

    protected $primaryKey = "id";

    protected $dates = ["deleted_at"];

    protected $guarded = [];

    public $timestamps = true;

    /**
     * @return BelongsTo
     */
    public function attributeModel(){
        return $this->belongsTo(Attribute::class, 'attribute_id');
    }
}
