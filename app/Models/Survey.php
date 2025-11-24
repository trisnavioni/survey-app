<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Survey extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'active',
        'user_id', // ✅ Tambahkan user_id
        'logo',
        'wave_color',
        'button_color',
        'navbar_color',
        'background_color',
    ];

    // 🔥 Relasi ke user (admin pembuat survey)
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
