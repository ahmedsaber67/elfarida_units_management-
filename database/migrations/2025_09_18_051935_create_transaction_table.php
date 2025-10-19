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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
        $table->foreignId('unit_id')->constrained()->onDelete('cascade');
        $table->foreignId('office_id')->constrained()->onDelete('cascade');
        $table->enum('status', ['reserved', 'reserved_downpayment', 'sold']);
        $table->decimal('price', 12,0)->nullable(); // السعر وقت البيع (اختياري)
        $table->date('date')->nullable(); // تاريخ العملية
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
