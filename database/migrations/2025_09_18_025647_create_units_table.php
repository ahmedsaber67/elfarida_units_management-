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
        Schema::create('units', function (Blueprint $table) {
             $table->id();
        $table->string('name'); // اسم الوحدة
        $table->decimal('area', 12); // المساحة
        $table->enum('floor',['first','second','third','fourth','fifth','sixth']); // الطابق
        $table->decimal('price', 12,0); // السعر
        $table->enum('status', ['available', 'reserved', 'reserved_downpayment', 'sold'])->default('available');
        $table->enum('wing', ['left', 'middle', 'right'])->nullable();
        $table->string('office')->nullable();
         $table->json('history')->nullable();
         $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('units');
    }
};
