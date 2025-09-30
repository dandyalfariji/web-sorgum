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
        // Tabel utama untuk konfigurasi header
        Schema::create('headers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Nama internal untuk identifikasi, cth: Header Utama');
            $table->string('logo_path')->nullable()->comment('Path ke file logo di storage');
            $table->boolean('is_active')->default(false)->comment('Hanya satu header yang boleh aktif pada satu waktu');
            $table->timestamps();
        });

        // Tabel untuk setiap item menu yang ada di dalam header
        Schema::create('header_menu_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('header_id')->constrained()->onDelete('cascade');
            $table->string('label')->comment('Teks yang tampil, cth: Home, Marketplace');
            $table->string('url')->comment('URL tujuan, cth: /, /marketplace, /#team');
            $table->string('wire_click_key')->comment('Key untuk setActive() di Livewire, cth: home, marketplace, team');
            $table->unsignedInteger('order')->default(0)->comment('Urutan tampil menu');
            $table->boolean('is_visible')->default(true)->comment('Untuk menyembunyikan menu tanpa menghapusnya');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('header_menu_items');
        Schema::dropIfExists('headers');
    }
};
