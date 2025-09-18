<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'username')) {
                $table->string('username')->unique()->after('name');
            }
        });

        // Make email nullable without requiring doctrine/dbal
        DB::statement("ALTER TABLE users MODIFY email VARCHAR(255) NULL");
    }

    public function down(): void
    {
        // Revert email to NOT NULL (keeps unique index)
        DB::statement("ALTER TABLE users MODIFY email VARCHAR(255) NOT NULL");

        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'username')) {
                $table->dropUnique(['username']);
                $table->dropColumn('username');
            }
        });
    }
};


