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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->string('name');
            $table->decimal('current_price', 10, 2);
            $table->decimal('old_price', 10, 2)->nullable();
            $table->string('image');
            $table->unsignedInteger('weight');
            $table->text('compound');
            $table->enum('new', ['yes','no']);
            $table->enum('hit', ['yes', 'no']);
            $table->unsignedInteger('discount');
            $table->date('date_remove')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
