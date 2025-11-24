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
    Schema::create('questions', function (Blueprint $table) {
    $table->id();
    $table->string('pertanyaan');
    $table->enum('tipe_jawaban', ['emoji4', 'skala4']); // 🔹 Tipe jawaban
    $table->boolean('aktif')->default(1);
    $table->timestamps();
});
}




    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
