<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Generate slug otomatis saat user dibuat
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            if (empty($user->slug)) {
                $user->slug = Str::slug($user->name . '-' . Str::random(5));
            }
        });
    }

    /**
     * Kolom yang boleh diisi (mass assignable)
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // tambahkan role untuk login
        'slug', // tambahkan juga slug agar bisa diset manual jika perlu
    ];

    /**
     * Kolom yang disembunyikan dari array/JSON
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Casting kolom
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // ===============================
    // 🔹 RELASI MODEL
    // ===============================

    // 1️⃣ Setiap user bisa punya banyak kategori
    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    // 2️⃣ Setiap user bisa punya banyak pertanyaan
    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    // 3️⃣ Setiap user bisa punya banyak survey
    public function surveys()
    {
        return $this->hasMany(Survey::class);
    }

    // 4️⃣ Setiap user bisa punya banyak response
    public function responses()
    {
        return $this->hasMany(Response::class);
    }

    // 5️⃣ Setiap user bisa punya banyak data diri responden
    public function dataDiris()
    {
        return $this->hasMany(DataDiri::class);
    }

    // ===============================
    // 🔹 HELPER ROLE
    // ===============================

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isCustomer()
    {
        return $this->role === 'customer';
    }
}
