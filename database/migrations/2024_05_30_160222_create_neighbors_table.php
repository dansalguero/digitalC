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
        Schema::create('neighbors', function (Blueprint $table) {
            $table->id('neighbor_id');
            $table->unsignedBigInteger('community_id');
            // $table->foreign('community_id')->references('community_id')->on('communities');

            $table->unsignedBigInteger('property_id');
            // $table->foreign('property_id')->references('property_id')->on('properties');

            $table->decimal('ownership_percentage')->nullable();
            $table->boolean('is_primary_owner')->nullable();
            $table->string('name')->nullable();
            $table->string('surname')->nullable();
            $table->string('nif')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();;
            $table->unsignedBigInteger('status_id')->default(0);
            // $table->foreign('status_id')->references('status_id')->on('property_statuses');

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
        Schema::dropIfExists('neighbors');
    }
};
