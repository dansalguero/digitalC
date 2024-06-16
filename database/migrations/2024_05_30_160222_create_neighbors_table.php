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
            $table->foreign('community_id')->references('community_id')->on('communities');

            $table->unsignedBigInteger('property_id')->nullable();;
            $table->foreign('property_id')->references('property_id')->on('properties')->onDelete('set null');

            $table->decimal('ownership_percentage')->nullable();
            $table->boolean('is_primary_owner')->nullable();
            $table->string('name')->nullable();
            $table->string('surname')->nullable();
            $table->string('nif')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();;

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
