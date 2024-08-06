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
        Schema::table('appointments', function (Blueprint $table) {
            $table->string('phone');
            $table->string('country');
            $table->string('city');
            $table->string('diploma');
            $table->string('type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropColumn('phone');
            $table->dropColumn('country');
            $table->dropColumn('city');
            $table->dropColumn('diploma');
            $table->dropColumn('type');
        });
    }
};
