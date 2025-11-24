<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    \App\Models\Question::insert([
        ['pertanyaan' => 'Bagaimana pendapat Anda tentang pelayanan kami?', 'tipe_jawaban' => 'emoji4', 'aktif'=>true, 'created_at'=>now(), 'updated_at'=>now()],
        ['pertanyaan' => 'Kondisi sarana/prasarana?', 'tipe_jawaban' => 'emoji4', 'aktif'=>true, 'created_at'=>now(), 'updated_at'=>now()],
    ]);
}
}
