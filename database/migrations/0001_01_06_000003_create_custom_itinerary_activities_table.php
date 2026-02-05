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
        Schema::create('custom_itinerary_activities', function (Blueprint $table) {
            $table->bigIncrements('id', true);
            $table->unsignedBigInteger('id_custom_itinerary');
            
            $table->string('activity_name');
            $table->string('activity_type')->default('general');
            $table->text('notes')->nullable();

            $table->timestamps();
            
            $table->foreign('id_custom_itinerary')->references('id')->on('custom_itineraries');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custom_itinerary_activities');
    }
};