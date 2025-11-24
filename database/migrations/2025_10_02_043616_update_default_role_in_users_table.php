<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Ubah default role jadi admin
        DB::statement("ALTER TABLE users MODIFY role ENUM('admin','customer') DEFAULT 'admin'");
    }

    public function down(): void
    {
        // Balik lagi default role jadi customer (rollback)
        DB::statement("ALTER TABLE users MODIFY role ENUM('admin','customer') DEFAULT 'customer'");
    }
};
