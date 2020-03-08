<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('z_packages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('pawnshop_id')->nullable();
            $table->text('package_name')->nullable();
            $table->text('package_desc')->nullable();
            $table->integer('number_of_month')->nullable()->default(0);
            $table->double('interest_per_month', 10, 2)->nullable()->default(0.00);
            $table->double('pinalty_per_month', 10, 2)->nullable()->default(0.00);
            $table->integer('if_advance_interest')->nullable()->default(0);
            $table->integer('if_has_special_offer')->nullable()->default(0);
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
        Schema::dropIfExists('z_packages');
    }
}
