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
        Schema::create('testimony', function (Blueprint $table) {
            $table->bigIncrements('id', true);
            $table->text('image')->comment('untuk gambar user jika diperlukan');
            $table->string('name')->comment('untuk nama pengguna/orang');
            $table->text('description')->comment('untuk testimoninya');
            $table->integer('rating')->comment('untuk rating bintang 1-5');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testimony');
    }
};
