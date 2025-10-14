<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tour_departures', function (Blueprint $table) {
            $table->bigIncrements('id', true);
            $table->unsignedBigInteger('id_departure');
            $table->unsignedBigInteger('id_tour');
            
            $table->timestamp('created_at');
            $table->string('created_by', 255)->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->string('updated_by', 255)->nullable();

            $table->foreign('id_departure')->references('id')->on('departures');
            $table->foreign('id_tour')->references('id')->on('tours');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tour_departures');
    }
};
