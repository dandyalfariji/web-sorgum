<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Jembatan tunggal ke layanan AI Sorgummi.
 *
 * Mendukung beberapa provider (gateway 9router / CommandCode, dan Google Gemini)
 * dengan failover otomatis: kalau provider pertama gagal atau membalas kosong,
 * provider berikutnya yang dicoba.
 */
class SorgummiAiService
{
    /**
     * Kirim percakapan dan kembalikan balasan teks.
     *
     * @param  array<int, array{role:string, content:string}>  $messages
     * @return array{ok: bool, reply: string, provider: string|null, error: string|null}
     */
    public function chat(array $messages): array
    {
        $order = array_values(array_unique(array_merge(
            [(string) config('sorgummi.default', '9router')],
            (array) config('sorgummi.fallback_order', [])
        )));

        $lastError = null;

        foreach ($order as $name) {
            $cfg = config("sorgummi.providers.{$name}");

            if (! is_array($cfg)) {
                continue;
            }

            if (blank($cfg['api_key'] ?? null)) {
                $lastError = "Provider {$name}: API key belum diatur.";
                Log::warning('Sorgummi AI: '.$lastError);
                continue;
            }

            try {
                $reply = match ($cfg['driver'] ?? 'openai') {
                    'gemini' => $this->callGemini($cfg, $messages),
                    default  => $this->callOpenAiCompatible($cfg, $messages),
                };

                if (filled($reply)) {
                    return ['ok' => true, 'reply' => $reply, 'provider' => $name, 'error' => null];
                }

                $lastError = "Provider {$name} membalas kosong.";
                Log::warning('Sorgummi AI: '.$lastError);
            } catch (\Throwable $e) {
                $lastError = "Provider {$name}: ".$e->getMessage();
                Log::warning('Sorgummi AI gagal', ['provider' => $name, 'error' => $e->getMessage()]);
            }
        }

        return ['ok' => false, 'reply' => '', 'provider' => null, 'error' => $lastError];
    }

    /**
     * Provider dengan API kompatibel OpenAI (9router / CommandCode).
     */
    protected function callOpenAiCompatible(array $cfg, array $messages): string
    {
        $url = rtrim($cfg['base_url'], '/').'/chat/completions';

        $response = Http::withToken($cfg['api_key'])
            ->acceptJson()
            ->timeout((int) config('sorgummi.timeout', 120))
            ->post($url, [
                'model'       => $cfg['model'],
                'messages'    => $messages,
                'temperature' => (float) config('sorgummi.temperature', 0.7),
                'max_tokens'  => (int) config('sorgummi.max_tokens', 1024),
            ]);

        if (! $response->successful()) {
            throw new \RuntimeException('HTTP '.$response->status().' '.mb_substr($response->body(), 0, 200));
        }

        return trim((string) data_get($response->json(), 'choices.0.message.content', ''));
    }

    /**
     * Provider Google Gemini (generateContent).
     */
    protected function callGemini(array $cfg, array $messages): string
    {
        $system   = '';
        $contents = [];

        foreach ($messages as $message) {
            if (($message['role'] ?? '') === 'system') {
                $system .= ($system !== '' ? "\n\n" : '').$message['content'];
                continue;
            }

            $contents[] = [
                'role'  => ($message['role'] ?? 'user') === 'assistant' ? 'model' : 'user',
                'parts' => [['text' => $message['content']]],
            ];
        }

        $payload = [
            'contents'         => $contents,
            'generationConfig' => [
                'temperature'     => (float) config('sorgummi.temperature', 0.7),
                'maxOutputTokens' => (int) config('sorgummi.max_tokens', 1024),
            ],
        ];

        if ($system !== '') {
            $payload['systemInstruction'] = ['parts' => [['text' => $system]]];
        }

        $url = rtrim($cfg['base_url'], '/').'/models/'.$cfg['model'].':generateContent';

        $response = Http::acceptJson()
            ->timeout((int) config('sorgummi.timeout', 120))
            ->post($url.'?key='.urlencode($cfg['api_key']), $payload);

        if (! $response->successful()) {
            throw new \RuntimeException('HTTP '.$response->status().' '.mb_substr($response->body(), 0, 200));
        }

        return trim((string) data_get($response->json(), 'candidates.0.content.parts.0.text', ''));
    }
}
