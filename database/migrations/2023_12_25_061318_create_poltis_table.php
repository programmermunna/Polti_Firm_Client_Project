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
        Schema::create('poltis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->constrained('branches')
                ->onUpdate('cascade')->onUpdate('cascade')->nullable();
            $table->integer('piece')->nullable();
            $table->integer('price')->nullable();
            $table->foreignId('category_id')->constrained('categories')
                    ->onUpdate('cascade')->onDelete('cascade')->nullable();
            $table->foreignId('shed_id')->constrained('sheds')
                ->onUpdate('cascade')->onDelete('cascade')->nullable();
            $table->string('weight', 200)->nullable();
            $table->integer('transport')->nullable();
            $table->integer('total')->nullable();
            $table->timestamp('buy_date')->nullable();
            $table->string('age', 100)->nullable();
            $table->integer('deth')->nullable();
            $table->string('description', 100)->nullable();
            $table->string('status', 10)->default('1')->nullable();
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
        Schema::dropIfExists('poltis');
    }
};
