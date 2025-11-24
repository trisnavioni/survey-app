<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Question extends Model
{
    protected $fillable = [
        'pertanyaan',
        'tipe_jawaban',
        'category_id',
        'user_id', // ✅ Tambahkan user_id
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    // 🔥 Relasi ke responses
    public function responses(): HasMany
    {
        return $this->hasMany(Response::class, 'question_id');
    }

    // 🔥 Relasi ke user (admin pemilik pertanyaan)
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
