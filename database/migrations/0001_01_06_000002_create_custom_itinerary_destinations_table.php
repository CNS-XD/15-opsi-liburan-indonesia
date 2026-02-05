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
        Schema::create('custom_itinerary_destinations', function (Blueprint $table) {
            $table->bigIncrements('id', true);
            $table->unsignedBigInteger('id_custom_itinerary');
            $table->unsignedBigInteger('id_destination');

            $table->integer('sequence_order');
            $table->integer('days_allocated')->default(1);

            $table->timestamps();
            
            $table->foreign('id_custom_itinerary')->references('id')->on('custom_itineraries');
            $table->foreign('id_destination')->references('id')->on('destinations');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custom_itinerary_destinations');
    }
};