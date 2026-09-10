<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $articleId = $this->route('article') ? $this->route('article')->id : null;

        return [
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:articles,slug,' . $articleId,
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'content' => 'nullable|string',
            'status' => 'required|in:Draft,Published',
            'published_at' => 'nullable|date',
        ];
    }
}
