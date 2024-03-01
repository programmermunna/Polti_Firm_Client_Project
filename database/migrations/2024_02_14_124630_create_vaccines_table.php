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
        Schema::create('vaccines', function (Blueprint $table) {
            $table->id();
            $table->string('name', 250)->nullable();
            $table->string('slug', 250)->nullable();
            $table->string('period_days', 250)->nullable();
            $table->string('repeat_vaccine', 50)->nullable();
            $table->string('dose_qty', 150)->nullable();
            $table->string('note', 150)->nullable();
            $table->string('status', 1)->default('1')->nullable();
            $table->integer('flag')->default(0)->nullable();
            $table->integer('created_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vaccines');
    }
};