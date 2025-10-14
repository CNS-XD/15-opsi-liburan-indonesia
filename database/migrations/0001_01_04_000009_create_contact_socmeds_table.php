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
        Schema::create('contact_socmeds', function (Blueprint $table) {
            $table->bigIncrements('id', true);

            $table->string('type_socmed', 255)->nullable()->comment('Facebook, Instagram, Tiktok, X (Twitter), Youtube, Web, WeChat');
            $table->string('name_account', 255)->nullable();
            $table->text('url')->nullable();
            $table->integer('show')->nullable()->comment('0=tidak tampil, 1=tampil');
            
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
        Schema::dropIfExists('contact_socmeds');
    }
};
