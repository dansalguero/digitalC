<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */


    public function up()
    {
        Schema::create('communities', function (Blueprint $table) {
            $table->id('community_id'); // Clave primaria 'community_id' como unsignedBigInteger
            $table->integer('user_id');
            $table->string('community_name');
            $table->string('contact_name');
            $table->string('contact_phone');
            $table->string('contact_email');
            $table->timestamps();
            $table->boolean('active')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('communities');
    }
};
