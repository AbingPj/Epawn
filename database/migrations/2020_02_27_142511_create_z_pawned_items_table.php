<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZPawnedItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('z_pawned_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('item_id');
            $table->bigInteger('pawnshop_id');
            $table->bigInteger('customer_id');
            $table->bigInteger('package_id');
            $table->double('pawn_amount', 10, 2);
            // $table->double('interest_per_month', 10, 2)->nullable()->default(0.00);
            // $table->double('pinalty_per_month', 10, 2)->nullable()->default(0.00);
            // $table->integer('number_of_month')->nullable()->default(0);
            // $table->integer('if_advance_interest')->nullable()->default(0);
            // $table->integer('if_has_special_offer')->nullable()->default(0);
            $table->dateTime('date_pawned')->nullable();
            $table->dateTime('date_renew')->nullable();
            $table->dateTime('date_claimed')->nullable();
            $table->integer('is_claimed')->nullable()->default(0);
            $table->integer('is_confiscated')->nullable()->default(0);
            $table->integer('days_deadline')->nullable()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('z_pawned_items');
    }
}
