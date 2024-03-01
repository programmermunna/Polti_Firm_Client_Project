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
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->integer('buy_id');
            $table->foreignId('branch_id')->constrained('branches')
                ->onUpdate('cascade')->onDelete('cascade')->nullable();
            $table->foreignId('expense_type')->constrained('expenses')
                ->onUpdate('cascade')->onDelete('cascade')->nullable();
            $table->decimal('amount', 10, 2)->nullable();
            $table->string('flag', 10)->default('0')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};