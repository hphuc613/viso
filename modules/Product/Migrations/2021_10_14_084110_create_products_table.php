<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('sku');
            $table->string('name');
            $table->string('key_slug')->nullable();
            $table->double('price')->default(0);
            $table->text('ingredient')->nullable();
            $table->text('description')->nullable();
            $table->text('shipping_info')->nullable();
            $table->string('image')->nullable();
            $table->string('capacity')->nullable();
            $table->integer('vote')->default(0);
            $table->integer('stock_in')->default(0);
            $table->smallInteger('status')->default(1);
            $table->unsignedBigInteger('cate_id');
            $table->unsignedBigInteger('brand_id');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('product_images', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->unsignedBigInteger('product_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
        Schema::dropIfExists('product_images');
    }
}
