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
        Schema::create('group_student', function (Blueprint $table) {
            $table->id();

            $table->foreignId('group_id')->constrained();
            $table->foreignId('student_id')->constrained();

            $table->foreignId('course_id')->constrained();
            $table->string("modality");
            $table->string("payment");
            $table->string("discover");
            $table->string("google");
            $table->boolean("is_approved")->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group_student');
    }
};
