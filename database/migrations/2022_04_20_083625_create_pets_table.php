<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('adopter_id')->nullable();
            $table->unsignedBigInteger('volunteer_id')->nullable();
            $table->foreign('adopter_id')->references('id')->on('users');
            $table->foreign('volunteer_id')->references('id')->on('users');
            $table->string('name');
            $table->string('type');
            $table->string('gender');
            $table->text('health_condition');
            $table->text('state');
            $table->text('city');
            $table->text('location');
            $table->string('phone_number');
            $table->string('pet_picture');
            $table->string('adoption_status')->nullable();
            $table->timestamp('adoption_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pets');
    }
}
