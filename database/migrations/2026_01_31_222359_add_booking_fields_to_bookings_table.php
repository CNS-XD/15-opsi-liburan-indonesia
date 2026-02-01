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
        Schema::table('bookings', function (Blueprint $table) {
            // Add new fields for comprehensive booking system
            $table->string('booking_code', 50)->unique()->after('id');
            $table->string('name', 255)->after('booking_code');
            $table->string('email', 255)->after('name');
            $table->string('phone', 20)->after('email');
            $table->integer('travelers')->default(1)->after('phone');
            $table->date('preferred_date')->after('travelers');
            $table->text('special_requests')->nullable()->after('preferred_date');
            $table->decimal('total_price', 10, 2)->after('special_requests');
            $table->enum('status', ['pending', 'confirmed', 'cancelled'])->default('pending')->after('total_price');
            
            // Make id_tour_price nullable since we might not always have specific price tiers
            $table->unsignedBigInteger('id_tour_price')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn([
                'booking_code',
                'name',
                'email', 
                'phone',
                'travelers',
                'preferred_date',
                'special_requests',
                'total_price',
                'status'
            ]);
            
            // Revert id_tour_price to not nullable
            $table->unsignedBigInteger('id_tour_price')->nullable(false)->change();
        });
    }
};