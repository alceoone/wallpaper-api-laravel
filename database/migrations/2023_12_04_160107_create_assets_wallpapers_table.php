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
        Schema::create('assets_wallpapers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kategori_id');
            $table->unsignedBigInteger('aplikasi_id');
            $table->string('tag');
            $table->longText('gambar_asset_wallpaper');
            $table->bigInteger('view_count')->nullable()->default(0);
            $table->timestamps();

            $table->foreign('aplikasi_id')->references('id')->on('aplikasis')->onDelete('cascade');
            $table->foreign('kategori_id')->references('id')->on('kategoris')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assets_wallpapers');
    }
};
