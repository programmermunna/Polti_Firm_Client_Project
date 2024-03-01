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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->constrained('branches')
            ->onUpdate('cascade')->onDelete('cascade')->nullable();
            $table->string('supplier_name', 250)->nullable();
            $table->string('company_name', 250)->nullable();
            $table->string('phone_number', 15)->nullable();
            $table->string('email', 150)->nullable();
            $table->string('adress', 250)->nullable();
            $table->string('supplier_image', 250)->nullable();
            $table->string('status', 10)->default('1')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};