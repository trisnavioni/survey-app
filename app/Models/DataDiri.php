<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DataDiri extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_lengkap',
        'jenis_kelamin',
        'umur',
        'user_id', // ✅ Tambahkan user_id
    ];

    // Relasi ke Responses
    public function responses(): HasMany
    {
        return $this->hasMany(Response::class, 'data_diri_id');
    }

    // 🔥 Relasi ke user (admin pemilik data diri)
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
