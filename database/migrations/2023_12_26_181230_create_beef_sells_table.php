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
        Schema::create('beef_sells', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->constrained('branches')
                ->onUpdate('cascade')->onDelete('cascade')->nullable();
            $table->string('name', 250)->nullable();
            $table->timestamp('sell_date')->nullable();
            $table->string('quantity', 250)->nullable();
            $table->integer('price')->nullable();
            $table->integer('payment')->nullable();
            $table->integer('due')->nullable();
            $table->string('phone_number', 20)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beef_sells');
    }
};
