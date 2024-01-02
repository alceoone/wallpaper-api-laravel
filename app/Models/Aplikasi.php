<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Aplikasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'profil_developer',
        'nama_aplikasi',
        'key_aplikasi',
        'deskripsi_aplikasi',
        'privacy_police_aplikasi',
        'gambar_aplikasi',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($aplikasi) {
            $aplikasi->key_aplikasi = Str::random(16);
            $aplikasi->fill(['profil_developer' => Auth::id()]);
        });
    }

    public function aplikasiKategori()
    {
        return $this->hasMany(Kategori::class, 'aplikasi_id');
    }
}
