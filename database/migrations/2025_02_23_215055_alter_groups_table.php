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
        Schema::table('groups', function (Blueprint $table) {
            $table->foreignId('classroom_id')->nullable()->constrained();
            $table->string('teacher')->nullable();
            $table->boolean('inCompany')->default(false);
            $table->json('frequency')->nullable();
            $table->dropColumn(['discount']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('groups', function (Blueprint $table) {
            $table->integer('discount');
            $table->dropForeign(['classroom_id']);
            $table->dropColumn(['classroom_id', 'teacher', 'frequency', 'inCompany']);
        });
    }
};
