<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    use HasFactory;

    protected $fillable = [
        'data_diri_id',
        'question_id',
        'jawaban',
        'category_id',
        'user_id', // ✅ Tambahkan user_id
    ];

    // Relasi ke DataDiri
    public function dataDiri()
    {
        return $this->belongsTo(DataDiri::class, 'data_diri_id');
    }

    // Relasi ke Question
    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }

    // Relasi ke Category
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    // 🔥 Relasi ke user (admin pemilik survey)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
