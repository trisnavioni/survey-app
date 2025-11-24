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
    Schema::table('surveys', function (Blueprint $table) {
        $table->string('wave_color')->nullable()->default('#1E90FF'); // warna biru default
        $table->string('button_color')->nullable()->default('#007BFF'); // warna tombol default
    });
}

public function down(): void
{
    Schema::table('surveys', function (Blueprint $table) {
        $table->dropColumn(['wave_color', 'button_color']);
    });
}

};
