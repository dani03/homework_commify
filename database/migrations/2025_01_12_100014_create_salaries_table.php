<?php

use App\Models\TaxRate;
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
        Schema::create('salaries', function (Blueprint $table) {
            $table->id();
            $table->string('gross_annual_salary')->nullable();
            $table->string('gross_monthly_salary')->nullable();
            $table->string('net_annual_salary')->nullable();
            $table->string('net_monthly_salary')->nullable();
            $table->string('annual_tax_paid')->nullable();
            $table->string('monthly_tax_paid')->nullable();
            $table->foreignIdFor(TaxRate::class);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salaries');
    }
};
