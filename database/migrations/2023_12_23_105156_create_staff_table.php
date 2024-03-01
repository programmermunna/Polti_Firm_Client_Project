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
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->constrained('branches')
                ->onUpdate('cascade')->onDelete('cascade')->nullable();
            $table->string('name', 250)->nullable();
            $table->integer('salary')->nullable();
            $table->string('father_name', 250)->nullable();
            $table->string('mother_name', 250)->nullable();
            $table->string('email', 250)->nullable();
            $table->string('nid_no', 250)->nullable();
            $table->string('birth_certificate', 250)->nullable();
            $table->string('present_address', 250)->nullable();
            $table->string('permanent_address', 250)->nullable();
            $table->string('blood_group', 25)->nullable();
            $table->string('gender', 25)->nullable();
            $table->timestamp('birth_date')->nullable();
            $table->string('staff_image', 250)->nullable();
            $table->string('status', 10)->default('1')->nullable();
            $table->string('flag', 10)->default('0')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff');
    }
};