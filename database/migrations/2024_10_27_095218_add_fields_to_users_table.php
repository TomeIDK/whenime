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
        Schema::table('users', function (Blueprint $table) {
            // Add the username field
            $table->string('username')->unique()->after('id');
            
            // Add date of birth field
            $table->date('date_of_birth')->nullable()->after('username'); // Adjust as needed

            // Add profile picture field
            $table->string('profile_picture')->nullable()->after('date_of_birth'); // Adjust as needed
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Remove the fields in reverse order
            $table->dropColumn(['profile_picture', 'date_of_birth', 'username']);
        });
    }
};
