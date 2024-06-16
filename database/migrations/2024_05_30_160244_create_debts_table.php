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
            $table->string('debt_description');
            $table->unsignedBigInteger('community_id');
            $table->unsignedBigInteger('property_id');
            $table->unsignedBigInteger('neighbor_id')->nullable();
            $table->date('issue_date');
            $table->date('maturity_date');
            $table->date('clearing_date')->nullable();
            $table->decimal('amount', 10, 2);
            $table->unsignedBigInteger('status_id');
            $table->foreign('community_id')->references('community_id')->on('communities');
            $table->foreign('property_id')->references('property_id')->on('properties')->onDelete('cascade');;
            $table->foreign('neighbor_id')->references('neighbor_id')->on('neighbors')->onDelete('set null');
            $table->foreign('status_id')->references('status_id')->on('debt_statuses');
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
