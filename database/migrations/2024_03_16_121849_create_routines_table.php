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
        Schema::create('routines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->constrained('branches')
                ->onUpdate('cascade')->onUpdate('cascade')->nullable();
            $table->foreignId('shed_id')->constrained('sheds')
            ->onUpdate('cascade')->onDelete('cascade')->nullable();
            $table->foreignId('polti_id')->constrained('poltis')->unique()
                ->onUpdate('cascade')->onDelete('cascade')->nullable();
            $table->string('title', 100)->nullable();
            $table->string('food_item')->nullable();
            $table->integer('food_period')->nullable();
            $table->string('vaccine_item')->nullable();
            $table->integer('vaccine_period')->nullable();
            $table->string('description', 100)->nullable();
            $table->string('date')->nullable();
            $table->integer('status')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('routines');
    }
};
