<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class CreateStoresTable extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('stores', function(Blueprint $table){
            $table->id();
            $table->string('name')->nullable();
            $table->string('key_slug')->nullable();
            $table->smallInteger('status')->default(1);
            $table->text('description')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        DB::table('stores')->insert([
            'name'       => 'MALL',
            'key_slug'   => Str::random(2) . 'MALL' . Str::random(2) . time(),
            'status'     => 1,
            'created_at' => '2020-10-15 23:30:41',
            'updated_at' => '2020-10-20 22:17:19'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('stores');
    }
}
