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
        Schema::create('pregnancies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->constrained('branches')
                ->onUpdate('cascade')->onDelete('cascade')->nullable();
            $table->foreignId('cow_id')->constrained('cows')
                ->onUpdate('cascade')->onDelete('cascade')->nullable();
            $table->string('pregnancy_type', 20)->nullable();
            $table->foreignId('semen_id')->constrained('semens')
                ->onUpdate('cascade')->onDelete('cascade')->nullable();
            $table->timestamp('push_date')->nullable();
            $table->timestamp('start_date')->nullable();
            $table->integer('semen_cost')->nullable();
            $table->integer('other_cost')->nullable();
            $table->integer('due')->nullable();
            $table->string('status', 10)->default('1')->nullable();
            $table->integer('flag')->default(0)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pregnancies');
    }
};
