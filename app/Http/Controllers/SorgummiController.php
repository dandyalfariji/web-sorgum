<?php

namespace App\Http\Controllers;

use App\Services\SorgummiAiService;
use Illuminate\Http\Request;

class SorgummiController extends Controller
{
    public function __construct(protected SorgummiAiService $ai)
    {
    }

    /**
     * Endpoint chat untuk widget Sorgummi AI.
     */
    public function chat(Request $request)
    {
        $validated = $request->validate([
            'message' => 'required|string|max:2000',
        ]);

        $messages = [
            ['role' => 'system', 'content' => (string) config('sorgummi.system_prompt')],
            ['role' => 'user', 'content' => $validated['message']],
        ];

        $result = $this->ai->chat($messages);

        if ($result['ok']) {
            return response()->json([
                'reply'    => $result['reply'],
                'provider' => $result['provider'],
            ]);
        }

        return response()->json([
            'reply' => 'Maaf, layanan AI sedang tidak dapat dihubungi. Silakan coba beberapa saat lagi.',
            'error' => 'Semua provider AI gagal: '.($result['error'] ?? 'tidak diketahui'),
        ], 503);
    }
}
