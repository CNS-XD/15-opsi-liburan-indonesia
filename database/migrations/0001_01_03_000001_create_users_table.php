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
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id', true);

            $table->string('name', 255);
            $table->string('email', 255)->unique();
            $table->string('password', 255);
            $table->string('plain_text', 255);
            $table->string('phone', 255)->nullable();
            $table->string('nationality', 255)->nullable();
            $table->integer('role')->comment('1=Superadmin, 2=Client / Visitor / Traveler');
            $table->integer('status')->default(1)->comment('0=Pending, 1=Active, 2=Non-Active');
            $table->text('photo')->nullable();

            $table->rememberToken();
            
            $table->timestamp('created_at');
            $table->string('created_by', 255)->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->string('updated_by', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
