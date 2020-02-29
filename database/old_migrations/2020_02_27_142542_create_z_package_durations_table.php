<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZPackageDurationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('z_package_durations', function (Blueprint $table) {
            $table->bigIncrements('id');
            // $table->bigInteger('pawnshop_id')->nullable();
            $table->integer('package_id')->nullable();
            $table->integer('from')->nullable();
            $table->integer('to')->nullable();
            $table->double('interest',10,2)->nullable()->default(0.00);
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
        Schema::dropIfExists('z_package_durations');
    }
}
