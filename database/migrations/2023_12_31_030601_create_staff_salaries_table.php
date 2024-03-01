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
        Schema::create('staff_salaries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->constrained('branches')
                ->onUpdate('cascade')->onDelete('cascade')->nullable();
            $table->foreignId('staff_id')->constrained('staff')
                ->onUpdate('cascade')->onDelete('cascade')->nullable();
            $table->timestamp('salary_date')->nullable();
            $table->integer('month')->nullable();
            $table->integer('year')->nullable();
            $table->integer('amount')->nullable();
            $table->timestamp('paid_on')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff_salaries');
    }
};
