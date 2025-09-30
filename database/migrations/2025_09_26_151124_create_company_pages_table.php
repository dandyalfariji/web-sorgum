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
        Schema::create('company_pages', function (Blueprint $table) {
            $table->id();
            $table->string('headline');
            $table->text('paragraph_1');
            $table->text('paragraph_2');
            $table->string('button_1_text');
            $table->string('button_1_link');
            $table->string('button_2_text');
            $table->string('button_2_link');
            $table->string('image_1');
            $table->string('image_1_alt');
            $table->string('image_2');
            $table->string('image_2_alt');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_pages');
    }
};
