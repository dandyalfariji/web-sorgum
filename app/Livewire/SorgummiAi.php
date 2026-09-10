<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SorgummiAi extends Component
{
    public $message = '';
    public $chatHistory = [];
    public $isLoading = false;

    public function mount()
    {
        $this->chatHistory = [
            ['role' => 'model', 'content' => 'Halo! Saya Sorgummi AI 🌾 Asisten virtual Anda seputar sorgum, kesehatan, resep, dan produk Sorgummi. Ada yang bisa saya bantu hari ini?']
        ];
    }

    public function sendMessage($text = null)
    {
        $textToSend = $text ?? $this->message;
        $textToSend = trim($textToSend);

        if (empty($textToSend)) {
            return;
        }

        // Add user message to chat history
        $this->chatHistory[] = ['role' => 'user', 'content' => $textToSend];
        $this->message = '';

        $apiKey = config('gemini.api_key');
        $model = config('gemini.model', 'gemini-2.0-flash');

        if (empty($apiKey)) {
            $this->chatHistory[] = [
                'role' => 'model',
                'content' => '⚠️ API Key belum dikonfigurasi. Silakan tambahkan `GEMINI_API_KEY` di file `.env` Anda.'
            ];
            return;
        }

        // Build conversation contents for Gemini API
        $contents = [];
        foreach ($this->chatHistory as $chat) {
            $contents[] = [
                'role' => $chat['role'],
                'parts' => [['text' => $chat['content']]]
            ];
        }

        try {
            $this->isLoading = true;

            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->timeout(20)->post(
                "https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent?key={$apiKey}",
                [
                    'contents' => $contents,
                    'systemInstruction' => [
                        'parts' => [[
                            'text' => 'Kamu adalah Sorgummi AI, asisten virtual cerdas dan ramah yang ahli seputar tanaman sorgum (Sorghum bicolor), manfaat kesehatan sorgum, resep olahan sorgum, dan produk-produk dari brand Sorgummi. Jawab selalu dalam bahasa Indonesia yang natural dan ramah. Gunakan emoji sesekali agar percakapan terasa hangat. Gunakan format bullet-points atau numbered list bila ada beberapa poin. Jika ditanya hal di luar topik sorgum, arahkan percakapan kembali ke sorgum dengan sopan.'
                        ]]
                    ],
                    'generationConfig' => [
                        'temperature' => 0.7,
                        'maxOutputTokens' => 1024,
                    ]
                ]
            );

            if ($response->successful()) {
                $data = $response->json();
                $reply = $data['candidates'][0]['content']['parts'][0]['text'] ?? 'Maaf, saya tidak mendapatkan respons yang valid.';
                $this->chatHistory[] = ['role' => 'model', 'content' => $reply];
            } else {
                $statusCode = $response->status();
                $errorBody = $response->json();
                $errorMessage = $errorBody['error']['message'] ?? 'Unknown error';

                Log::error("Gemini API Error [{$statusCode}]: {$errorMessage}");

                $userMessage = match (true) {
                    $statusCode === 400 => '⚠️ Permintaan tidak valid. Coba formulasikan pertanyaan Anda dengan cara berbeda.',
                    $statusCode === 401 || $statusCode === 403 => '🔑 API Key tidak valid atau tidak memiliki akses. Periksa kembali GEMINI_API_KEY di file .env.',
                    $statusCode === 404 => "🔧 Model AI \"{$model}\" tidak ditemukan. Mungkin model sudah deprecated. Periksa konfigurasi GEMINI_MODEL di .env.",
                    $statusCode === 429 => '⏳ Terlalu banyak permintaan. Silakan tunggu sebentar lalu coba lagi.',
                    $statusCode >= 500 => '🔧 Server Google AI sedang mengalami gangguan. Silakan coba lagi nanti.',
                    default => "❌ Terjadi kesalahan (Kode: {$statusCode}). Silakan coba lagi.",
                };

                $this->chatHistory[] = ['role' => 'model', 'content' => $userMessage];
            }
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error('Gemini Connection Timeout: ' . $e->getMessage());
            $this->chatHistory[] = [
                'role' => 'model',
                'content' => '⏱️ Koneksi ke server AI timeout. Pastikan koneksi internet Anda stabil dan coba lagi.'
            ];
        } catch (\Exception $e) {
            Log::error('Gemini Exception: ' . $e->getMessage());
            $this->chatHistory[] = [
                'role' => 'model',
                'content' => '❌ Terjadi kesalahan tak terduga. Silakan coba lagi dalam beberapa saat.'
            ];
        } finally {
            $this->isLoading = false;
        }
    }

    public function resetChat()
    {
        $this->chatHistory = [
            ['role' => 'model', 'content' => 'Halo! Saya Sorgummi AI 🌾 Asisten virtual Anda seputar sorgum, kesehatan, resep, dan produk Sorgummi. Ada yang bisa saya bantu hari ini?']
        ];
        $this->message = '';
    }

    public function render()
    {
        return view('livewire.sorgummi-ai')->layout('components.layouts.app', ['title' => 'Sorgummi AI']);
    }
}
