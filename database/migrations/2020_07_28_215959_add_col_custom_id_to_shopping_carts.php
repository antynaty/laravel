<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColCustomIdToShoppingCarts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shopping_carts', function (Blueprint $table) {
            //
            $table->string('custom_id')->unique()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('shopping_carts', 'custom_id')) {
            Schema::table('shopping_carts', function (Blueprint $table) {
    
                $table->dropColumn(['custom_id']);
            });
        }
    }
}
