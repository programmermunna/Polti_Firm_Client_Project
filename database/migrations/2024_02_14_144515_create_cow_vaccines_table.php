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
        Schema::create('polti_vaccines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->constrained('branches')
                ->onUpdate('cascade')->onDelete('cascade')->nullable();
            $table->foreignId('polti_tag')->constrained('poltis')
                ->onUpdate('cascade')->onDelete('cascade')->nullable();
            $table->foreignId('shed_id')->constrained('sheds')
                ->onUpdate('cascade')->onDelete('cascade')->nullable();

            $table->timestamp('push_date')->nullable();
            $table->string('note', 250)->nullable();

            $table->foreignId('vaccine_id')->constrained('vaccines')
                ->onUpdate('cascade')->onDelete('cascade')->nullable();

            $table->string('remarks', 250)->nullable();
            $table->string('given_time', 250)->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('polti_vaccines');
    }
};
