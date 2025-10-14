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
        Schema::create('tour_reviews', function (Blueprint $table) {
            $table->bigIncrements('id', true);
            $table->unsignedBigInteger('id_tour');

            $table->string('name', 255)->comment('untuk nama pengguna');
            $table->text('image')->nullable()->comment('untuk photo pengguna');
            $table->text('description')->comment('untuk reviewnya');
            $table->integer('rating')->comment('untuk rating bintang 1-5');
            $table->integer('show')->comment('0=tidak tampil, 1=tampil');
            
            $table->timestamp('created_at');
            $table->string('created_by', 255)->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->string('updated_by', 255)->nullable();
            
            $table->foreign('id_tour')->references('id')->on('tours');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tour_reviews');
    }
};
