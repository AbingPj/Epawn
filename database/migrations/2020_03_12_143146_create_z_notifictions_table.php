<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZNotifictionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('z_notifictions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('item_id')->nullable();
            $table->bigInteger('pawnshop_id')->nullable();
            $table->bigInteger('user_id')->nullable();
            $table->text('link')->nullable();
            $table->text('title')->nullable();
            $table->text('description')->nullable();
            $table->string('type')->nullable();
            $table->tinyInteger('seen')->default(0)->nullable();
            $table->tinyInteger('isFromPawnshop')->default(0)->nullable();
            $table->dateTime('date')->nullable();
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
        Schema::dropIfExists('z_notifictions');
    }
}
