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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('booking_id');
            $table->string('payment_code', 100)->unique();
            $table->string('xendit_invoice_id')->nullable();
            $table->string('xendit_external_id')->unique();
            $table->string('payment_method')->nullable(); // va, ewallet, qr_code, credit_card
            $table->string('payment_channel')->nullable(); // bca, ovo, qris, etc
            $table->decimal('amount', 12, 2);
            $table->string('currency', 3)->default('IDR');
            $table->enum('status', ['pending', 'paid', 'expired', 'failed', 'cancelled'])->default('pending');
            $table->string('xendit_status')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamp('expired_at')->nullable();
            $table->json('xendit_response')->nullable();
            $table->json('payment_details')->nullable(); // VA number, QR code, etc
            $table->text('failure_reason')->nullable();
            $table->timestamps();

            $table->foreign('booking_id')->references('id')->on('bookings')->onDelete('cascade');
            $table->index(['status', 'created_at']);
            $table->index('xendit_external_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
