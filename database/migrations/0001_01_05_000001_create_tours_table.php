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
        Schema::create('tours', function (Blueprint $table) {
            $table->bigIncrements('id', true);

            $table->text('image');
            $table->string('title', 255);
            $table->text('description');
            $table->integer('day_tour')->comment('ex: 1, 2, 3, dll');
            $table->string('time_tour', 255)->comment('ex: 10 hours, 3 days 2 night, dll');
            $table->integer('type_tour')->comment('0=private tour, 1=sharing tour');
            $table->float('price')->comment('harga per person');
            $table->integer('is_best')->comment('0=bukan best tour, 1=best tour');
            $table->string('group_size', 255)->comment('ex: 2-10, min. 2 pax, dll');
            $table->string('level_tour', 255)->comment('ex: low, medium, hard level');
            $table->integer('show')->comment('0=tidak tampil, 1=tampil');
            $table->text('slug');
            
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
        Schema::dropIfExists('tours');
    }
};
