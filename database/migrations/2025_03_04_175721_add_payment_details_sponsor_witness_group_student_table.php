<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // payment_details_sponsor_witness
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('group_student', function (Blueprint $table) {
            $table->string("payment_details")->nullable();
            $table->string("sponsor")->nullable();
            $table->string("witness")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('group_student', function (Blueprint $table) {
            $table->dropColumn(['payment_details', 'sponsor', 'witness']);
        });
    }
};
