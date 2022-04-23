<?php

namespace Modules\PaymentMethod\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Modules\Order\Models\Order;

class PaymentMethod extends Model{
    use SoftDeletes;

    protected $table = "payment_methods";

    protected $primaryKey = "id";

    protected $dates = ["deleted_at"];

    protected $guarded = [];

    public $timestamps = true;

    const CREDIT_CARD = 'CREDIT_CARD';

    const PAY_PAL = 'PAY_PAL';

    protected static function boot(){
        parent::boot();

        static::saving(function($model){
            $model->key_slug = Str::random(2) . $model->id . Str::random(2) . time();
        });
    }

    /**
     * @return HasMany
     */
    public function orders(){
        return $this->hasMany(Order::class, 'payment_method_id');
    }

    /**
     * @return array
     */
    public static function getMethodType(){
        return [
            self::CREDIT_CARD => 'Credit Card',
            self::PAY_PAL     => 'Paypal'
        ];
    }
}
