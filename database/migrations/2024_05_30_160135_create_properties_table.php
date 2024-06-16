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
            $table->id('property_id'); // Clave primaria 'property_id' como unsignedBigInteger
            $table->unsignedBigInteger('community_id'); // Columna para la clave foránea
            $table->foreign('community_id')->references('community_id')->on('communities')->onDelete('cascade'); // Definición de la clave foránea

            $table->string('block')->nullable();
            $table->string('phase')->nullable();
            $table->string('floor')->nullable();
            $table->string('number');
            $table->unsignedBigInteger('status_id'); // Asegúrate de que el tipo de datos sea compatible con 'status_id' en la tabla de referencia
            $table->foreign('status_id')->references('status_id')->on('property_statuses');

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
        Schema::dropIfExists('properties');
    }
};
