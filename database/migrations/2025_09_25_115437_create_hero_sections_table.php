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
        Schema::create('hero_sections', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Nama internal untuk identifikasi, cth: Hero Halaman Utama');
            $table->boolean('is_active')->default(false)->comment('Hanya satu hero section yang boleh aktif pada satu waktu');

            // Section 1: Main Hero (Paling Atas)
            $table->string('headline');
            $table->text('description');
            $table->string('primary_button_text');
            $table->string('primary_button_url');
            $table->string('secondary_button_text');
            $table->string('secondary_button_url');
            $table->string('hero_image_path')->nullable();

            // Section 2: Mid-section (Logo dan Manfaat)
            $table->string('mid_section_headline');
            $table->text('mid_section_description');
            $table->string('mid_section_image_path')->nullable();

            // Section 3: CTA (Call To Action Bawah)
            $table->string('cta_headline');
            $table->text('cta_description');
            $table->string('cta_button_text');
            $table->string('cta_button_url');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hero_sections');
    }
};
