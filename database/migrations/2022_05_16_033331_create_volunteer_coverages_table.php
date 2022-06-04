<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVolunteerCoveragesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('volunteer_coverages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('volunteer_id')->nullable();
            $table->foreign('volunteer_id')->references('id')->on('users');
            $table->text('street')->nullable();
            $table->text('area')->nullable();
            $table->text('district')->nullable();
            $table->text('state')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('volunteer_coverages');
    }
}
