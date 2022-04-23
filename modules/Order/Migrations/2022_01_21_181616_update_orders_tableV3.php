<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateOrdersTableV3 extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::table('orders', function(Blueprint $table){
            $table->unsignedBigInteger('voucher_id')->nullable();
            $table->string('voucher_name')->nullable();
            $table->double('voucher_value')->nullable();

            $table->dropColumn('coupon_id');
            $table->dropColumn('coupon_name');
            $table->dropColumn('coupon_discount');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::table('orders', function(Blueprint $table){
            $table->unsignedBigInteger('coupon_id')->nullable();
            $table->string('coupon_name')->nullable();
            $table->double('coupon_discount')->nullable();
        });
    }
}
