<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            // Hapus unique lama
            $table->dropUnique('categories_name_unique');

            // Tambahkan unique baru berdasarkan (user_id, name)
            $table->unique(['user_id', 'name']);
        });
    }

    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            // Balik ke kondisi semula (jika rollback)
            $table->dropUnique(['user_id', 'name']);
            $table->unique('name');
        });
    }
};
