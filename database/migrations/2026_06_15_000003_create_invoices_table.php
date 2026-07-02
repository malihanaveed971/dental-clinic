<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('appointment_id')->constrained()->cascadeOnDelete();

            $table->string('patient_name');
            $table->decimal('medications_total', 10, 2)->default(0);
            $table->decimal('xrays_total', 10, 2)->default(0);
            $table->decimal('grand_total', 10, 2)->default(0);

            $table->string('invoice_no')->unique();
            $table->enum('status', ['Unpaid', 'Paid'])->default('Unpaid');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};

