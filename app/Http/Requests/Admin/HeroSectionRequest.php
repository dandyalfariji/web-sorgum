<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class HeroSectionRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'headline' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'primary_button_text' => 'nullable|string|max:255',
            'primary_button_url' => 'nullable|string|max:255',
            'secondary_button_text' => 'nullable|string|max:255',
            'secondary_button_url' => 'nullable|string|max:255',
            'hero_image_path' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'mid_section_headline' => 'nullable|string|max:255',
            'mid_section_description' => 'nullable|string',
            'mid_section_image_path' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'cta_headline' => 'nullable|string|max:255',
            'cta_description' => 'nullable|string',
            'cta_button_text' => 'nullable|string|max:255',
            'cta_button_url' => 'nullable|string|max:255',
            'cta_image_path' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'is_active' => 'boolean',
        ];
    }
}
