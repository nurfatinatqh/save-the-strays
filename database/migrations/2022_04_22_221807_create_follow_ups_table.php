<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFollowUpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('follow_ups', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pet_id')->nullable();
            $table->unsignedBigInteger('adopter_id')->nullable();
            $table->unsignedBigInteger('volunteer_id')->nullable();
            $table->foreign('pet_id')->references('id')->on('pets');
            $table->foreign('adopter_id')->references('id')->on('users');
            $table->foreign('volunteer_id')->references('id')->on('users');
            $table->text('health_condition')->nullable();
            $table->string('picture')->nullable();
            $table->timestamp('follow_up_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('follow_ups');
    }
}
