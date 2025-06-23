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
        Schema::create('arhab_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('arhab_orders')->onDelete('cascade');
            $table->enum('method', ['bank_transfer', 'credit_card', 'e-wallet']);
            $table->enum('status', ['unpaid', 'paid', 'failed'])->default('unpaid');
            $table->string('payment_reference')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
