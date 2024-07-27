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
        Schema::create('price_list_products', function (Blueprint $table) {
            $table->id();
            $table->decimal('price', 10, 2);
            $table->string('sku');
            $table->foreign('sku')->references('sku')->on('products')->onDelete('cascade');
            $table->foreignId('price_list_id')->references('id')->on('price_lists')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('price_list_products');
    }
};
