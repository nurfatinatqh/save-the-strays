<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonorListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donor_lists', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('donation_id');
            $table->foreign('donation_id')->references('id')->on('donations');
            $table->string('name');
            $table->double('amount_of_donation');
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
        Schema::dropIfExists('donor_lists');
    }
}
