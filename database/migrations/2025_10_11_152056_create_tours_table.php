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
            $table->string('title');
            $table->text('description');
            $table->integer('day_tour')->comment('ex: 1, 2, 3, dll');
            $table->string('time_tour')->comment('ex: 10 hours, 3 days 2 night, dll');
            $table->integer('type_tour')->comment('0=private tour, 1=sharing tour');
            $table->float('price')->comment('harga per person');
            $table->integer('is_best')->comment('0=bukan best tour, 1=best tour');
            $table->string('group_size')->comment('ex: 2-10, min. 2 pax, dll');
            $table->string('level_tour')->comment('ex: low, medium, hard level');
            $table->text('slug');
            $table->timestamps();
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
