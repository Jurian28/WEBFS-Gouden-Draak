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
        Schema::create('dishes', function (Blueprint $table) {
            $table->id();
            $table->integer('menu_number');
            $table->string('menu_affix', 3)->nullable();
            $table->string('name');
            $table->decimal('price');
            $table->foreignId('dish_type_id')->constrained();
            $table->text('description')->nullable();
            $table->timestamps();

            $table->unique(['menu_number', 'menu_affix']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dishes');
    }
};
