<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Category extends Model
{
    // Kolom yang boleh diisi mass assignment
    protected $fillable = ['name', 'aktif', 'user_id'];

    public function questions(): HasMany
{
    return $this->hasMany(Question::class, 'category_id')
                ->where('user_id', auth()->id()); // 🔥 hanya pertanyaan milik admin ini
}

    // Relasi ke user (admin pemilik kategori)
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Scope untuk ambil kategori yang aktif
    public function scopeActive($query)
    {
        return $query->where('aktif', true);
    }
}
