<?php

namespace App\Livewire;

use App\Services\SorgummiAiService;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class SorgummiAi extends Component
{
    public string $message = '';

    /** @var array<int, array{role:string, content:string}> */
    public array $chatHistory = [];

    public bool $isLoading = false;

    public function mount(): void
    {
        $this->chatHistory = [$this->greeting()];
    }

    protected function greeting(): array
    {
        return [
            'role'    => 'model',
            'content' => 'Halo! Saya Sorgummi AI 🌾 Asisten virtual Anda seputar sorgum, kesehatan, resep, dan produk Sorgummi. Ada yang bisa saya bantu hari ini?',
        ];
    }

    public function sendMessage($text = null): void
    {
        $textToSend = trim((string) ($text ?? $this->message));

        if ($textToSend === '') {
            return;
        }

        $this->chatHistory[] = ['role' => 'user', 'content' => $textToSend];
        $this->message = '';
        $this->isLoading = true;

        try {
            $messages = array_merge(
                [['role' => 'system', 'content' => (string) config('sorgummi.system_prompt')]],
                $this->chatHistory
            );

            $result = app(SorgummiAiService::class)->chat($messages);

            if ($result['ok']) {
                $this->chatHistory[] = ['role' => 'model', 'content' => $result['reply']];
            } else {
                Log::error('Sorgummi AI: semua provider gagal', ['error' => $result['error']]);

                $this->chatHistory[] = [
                    'role'    => 'model',
                    'content' => "⚠️ Layanan AI sedang tidak bisa dihubungi.\n\n"
                        ."Pastikan gateway 9router berjalan di `http://127.0.0.1:20128` "
                        ."(atau isi kunci cadangan Gemini di `.env`), lalu coba lagi.\n\n"
                        .'_Detail: '.e((string) $result['error']).'_',
                ];
            }
        } catch (\Throwable $e) {
            Log::error('Sorgummi AI exception: '.$e->getMessage());

            $this->chatHistory[] = [
                'role'    => 'model',
                'content' => '❌ Terjadi kesalahan tak terduga. Silakan coba lagi dalam beberapa saat.',
            ];
        } finally {
            $this->isLoading = false;
        }
    }

    public function resetChat(): void
    {
        $this->chatHistory = [$this->greeting()];
        $this->message = '';
    }

    public function render()
    {
        return view('livewire.sorgummi-ai')
            ->layout('components.layouts.app', ['title' => 'Sorgummi AI']);
    }
}
