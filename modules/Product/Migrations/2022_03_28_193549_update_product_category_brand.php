<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class UpdateProductCategoryBrand extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        $store = DB::table('stores')->orderBy('created_at')->first();
        Schema::table('product_category_brand', function(Blueprint $table) use ($store){
            $table->unsignedInteger('store_id')->default($store->id ?? 1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::table('product_category_brand', function(Blueprint $table){
            $table->dropColumn('store_id');
        });
    }
}
