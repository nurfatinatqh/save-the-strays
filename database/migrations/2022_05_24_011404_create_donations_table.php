<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('volunteer_id');
            $table->foreign('volunteer_id')->references('id')->on('users');
            $table->string('pet_name');
            $table->text('health_condition');
            $table->text('contact_info');
            $table->string('phone_number')->nullable();
            $table->string('email')->nullable();
            $table->string('bank');
            $table->string('bank_no');
            $table->string('bank_owner_name');
            $table->double('expected_amount');
            $table->double('current_amount');
            $table->string('pet_picture');
            $table->string('vet_analysis');
            $table->string('status');
            $table->string('receipt')->nullable();
            $table->string('updated_condition')->nullable();
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
        Schema::dropIfExists('donations');
    }
}
