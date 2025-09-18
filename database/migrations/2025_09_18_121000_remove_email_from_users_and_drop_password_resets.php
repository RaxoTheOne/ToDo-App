<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Drop FK references if any (not expected here)

        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'email_verified_at')) {
                $table->dropColumn('email_verified_at');
            }
        });

        // Drop unique index on email then drop the column
        // Use raw statements to avoid requiring doctrine/dbal
        try {
            DB::statement('ALTER TABLE users DROP INDEX users_email_unique');
        } catch (Throwable $e) {}

        if (Schema::hasColumn('users', 'email')) {
            DB::statement('ALTER TABLE users DROP COLUMN email');
        }

        // Drop password reset tokens table if exists
        Schema::dropIfExists('password_reset_tokens');
    }

    public function down(): void
    {
        // Recreate email columns (without data) and table
        Schema::table('users', function (Blueprint $table) {
            if (! Schema::hasColumn('users', 'email')) {
                $table->string('email')->unique()->after('username');
            }
            if (! Schema::hasColumn('users', 'email_verified_at')) {
                $table->timestamp('email_verified_at')->nullable()->after('email');
            }
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });
    }
};


