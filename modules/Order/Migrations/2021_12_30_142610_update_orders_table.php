<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateOrdersTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        try{
            Schema::table('orders', function (Blueprint $table) {
                $table->unsignedBigInteger('member_id')->nullable()->change();
                $table->string('member_last_name')->nullable()->after('member_name');
                $table->string('shipping_id')->nullable()->after('phone');
                $table->string('shipping_name')->nullable()->after('shipping_id');
                $table->string('shipping_price')->nullable()->after('shipping_name');
                $table->dropColumn('creator_id');
                $table->dropColumn('creator_name');
            });
        }catch(Exception $e){
            Schema::table('orders', function (Blueprint $table) {
                $table->dropColumn('creator_id');
                $table->dropColumn('creator_name');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('member_last_name');
            $table->dropColumn('shipping_id');
            $table->dropColumn('shipping_name');
            $table->dropColumn('shipping_price');
            $table->unsignedBigInteger('creator_id')->nullable();
            $table->string('creator_name')->nullable();
        });
    }
}
