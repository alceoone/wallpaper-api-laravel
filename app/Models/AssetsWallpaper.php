<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetsWallpaper extends Model
{
    use HasFactory;
    protected $fillable = [
        'kategori_id',
        'aplikasi_id',
        'tag',
        'gambar_asset_wallpaper',
        'view_count'
    ];
}
