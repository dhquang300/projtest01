<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWagerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wager', function (Blueprint $table) {
            $table->increments('wager_id');
            $table->integer('total_wager_value');
            $table->integer('odds');
            $table->integer('selling_percentage');
            $table->decimal('current_selling_price',18,2)->nullable();
            $table->decimal('selling_price',18,2);
            $table->integer('percentage_sold')->nullable();
            $table->decimal('amount_sold')->nullable();
            $table->timestamp('placed_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wager');
    }
}
