<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('arhab_order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('arhab_orders')->onDelete('cascade');
            $table->foreignId('product_id')->constrained('arhab_products')->onDelete('cascade');
            $table->integer('quantity');
            $table->decimal('price', 12, 2); // harga saat order
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
