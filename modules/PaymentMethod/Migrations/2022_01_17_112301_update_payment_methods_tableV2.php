<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class UpdatePaymentMethodsTableV2 extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::table('payment_methods', function(Blueprint $table){
            $table->string('type_id')->nullable();
        });

        DB::table('payment_methods')->insert([
            'name'     => 'COD',
            'key_slug' => Str::random(2) . 1 . Str::random(2) . time(),
            'type_id'  => 'COD',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::table('payment_methods', function(Blueprint $table){
            $table->dropColumn('type_id');
        });
    }
}
