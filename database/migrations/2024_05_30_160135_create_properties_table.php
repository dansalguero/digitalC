<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            
        Schema::create('properties', function (Blueprint $table) {
            $table->id('property_id');
            $table->unsignedBigInteger('community_id');
            $table->foreign('community_id')->references('id')->on('communities');

            $table->string('block')->nullable();
            $table->string('phase')->nullable();
            $table->string('floor')->nullable();
            $table->string('number');
            $table->unsignedBigInteger('status_id')->default('0');
            //$table->foreign('status_id')->references('status_id')->on('property_statuses');

            $table->timestamps('');
            
     
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('properties');
    }
};
