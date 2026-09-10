<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CompanyPageRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'headline' => 'required|string|max:255',
            'paragraph_1' => 'nullable|string',
            'paragraph_2' => 'nullable|string',
            'button_1_text' => 'nullable|string|max:255',
            'button_1_link' => 'nullable|string|max:255',
            'button_2_text' => 'nullable|string|max:255',
            'button_2_link' => 'nullable|string|max:255',
            'image_1' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'image_1_alt' => 'nullable|string|max:255',
            'image_2' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'image_2_alt' => 'nullable|string|max:255',
        ];
    }
}
