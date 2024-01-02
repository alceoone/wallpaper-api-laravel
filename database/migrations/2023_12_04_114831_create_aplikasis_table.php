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
        Schema::create('aplikasis', function (Blueprint $table) {
            $table->id();
            $table->string('profil_developer');
            $table->string('nama_aplikasi');
            $table->string('key_aplikasi');
            $table->longText('deskripsi_aplikasi');
            $table->longText('privacy_police_aplikasi');
            $table->longText('gambar_aplikasi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aplikasis');
    }
};
