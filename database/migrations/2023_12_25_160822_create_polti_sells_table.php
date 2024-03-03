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
        Schema::create('polti_sells', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->constrained('branches')
                ->onUpdate('cascade')->onDelete('cascade')->nullable();
            $table->foreignId('polti_id')->constrained('poltis')
                ->onUpdate('cascade')->onDelete('cascade')->nullable();
            $table->foreignId('buyer_id')->constrained('buyers')
                ->onUpdate('cascade')->onDelete('cascade')->nullable();
            $table->integer('piece')->nullable();
            $table->integer('price')->nullable();
            $table->integer('payment')->nullable();
            $table->integer('due')->nullable();
            $table->timestamp('sell_date')->nullable();
            $table->string('description', 250)->nullable();
            $table->string('status', 50)->nullable();
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
        Schema::dropIfExists('polti_sells');
    }
};
