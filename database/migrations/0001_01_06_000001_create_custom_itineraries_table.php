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
        Schema::create('custom_itineraries', function (Blueprint $table) {
            $table->bigIncrements('id', true);

            $table->string('customer_name');
            $table->string('email');
            $table->string('phone');
            $table->integer('participants_adult');
            $table->integer('participants_child')->default(0);
            $table->decimal('budget_min', 10, 2)->nullable();
            $table->decimal('budget_max', 10, 2)->nullable();
            $table->integer('duration_days');
            $table->date('travel_date_start')->nullable();
            $table->date('travel_date_end')->nullable();
            $table->boolean('date_flexible')->default(false);
            $table->enum('tour_type', ['private', 'sharing', 'group']);
            $table->enum('accommodation_level', ['budget', 'standard', 'luxury']);
            $table->enum('transportation_type', ['car', 'bus', 'flight']);
            $table->text('special_requirements')->nullable();
            $table->enum('status', ['pending', 'quoted', 'confirmed', 'cancelled'])->default('pending');
            $table->text('admin_notes')->nullable();
            $table->decimal('estimated_price', 10, 2)->nullable();
            $table->decimal('final_price', 10, 2)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custom_itineraries');
    }
};