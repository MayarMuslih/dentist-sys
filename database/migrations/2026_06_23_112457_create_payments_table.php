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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained()->cascadeOnDelete(); // ربطنا الدفعة بالمريض فقط
            $table->foreignId('clinic_id')->nullable()->constrained()->cascadeOnDelete();

            $table->decimal('amount', 10, 2); // المبلغ المدفوع
            $table->string('payment_method')->default('cash'); // طريقة الدفع
            $table->date('payment_date'); // تاريخ الدفعة
            $table->text('notes')->nullable(); // ملاحظات اختيارية

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
