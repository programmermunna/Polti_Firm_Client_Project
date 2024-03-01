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
        Schema::create('cow_feeds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->constrained('branches')
                ->onUpdate('cascade')->onDelete('cascade')->nullable();
            $table->foreignId('cow_tag')->constrained('cows')
                ->onUpdate('cascade')->onDelete('cascade')->nullable();
            $table->foreignId('shed_id')->constrained('sheds')
                ->onUpdate('cascade')->onDelete('cascade')->nullable();
            $table->string('description', 250)->nullable();
            $table->foreignId('food_id')->constrained('food')
                ->onUpdate('cascade')->onDelete('cascade')->nullable();
            $table->string('food_quantity', 250)->nullable();
            $table->foreignId('unit_id')->constrained('units')
                ->onUpdate('cascade')->onDelete('cascade')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cow_feeds');
    }
};