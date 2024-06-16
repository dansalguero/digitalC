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
        Schema::create('debts', function (Blueprint $table) {

            $table->id('debt_id');
            $table->integer('debt_type_id');
            $table->string('debt_description');
            $table->integer('community_id');
            $table->integer('property_id');
            $table->integer('neighbor_id');
            $table->date('issue_date');
            $table->date('maturity_date');
            $table->date('clearing_date');
            $table->decimal('amount', 10, 2);
            $table->integer('status_id');
            /*$table->foreign('debt_type_id')->references('debt_type_id')->on('debt_types');
            $table->foreign('community_id')->references('community_id')->on('communities');
            $table->foreign('property_id')->references('property_id')->on('properties');
            $table->foreign('neighbor_id')->references('neighbor_id')->on('neighbors');
            $table->foreign('status_id')->references('status_id')->on('debt_statuses');
            */
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
        Schema::dropIfExists('debts');
    }
};
