<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('schedules', function (Blueprint $table) {
            $table->year('year')->after('user_id');
            $table->enum('season', ['Spring', 'Summer', 'Fall', 'Winter'])->after('user_id');
        });

        Schema::table('schedules', function (Blueprint $table) {
            $table->unique(['user_id', 'season', 'year'], 'unique_schedule'); // Ensure no duplicate schedules
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('schedules', function (Blueprint $table) {
            $table->string('name')->after('user_id');
            $table->dropUnique('unique_schedule');
            $table->dropColumn(['year', 'season']);
        });
    }
}

