<?php

/*
|--------------------------------------------------------------------------
| Sorgummi AI - konfigurasi multi-provider
|--------------------------------------------------------------------------
|
| Provider utama memakai gateway 9router (model yang dibeli via CommandCode).
| Bila provider utama gagal, sistem otomatis mencoba provider fallback,
| sehingga chatbot tidak mati hanya karena satu endpoint bermasalah.
|
*/

return [

    // Provider yang dicoba lebih dulu: '9router' atau 'gemini'
    'default' => env('SORGUMMI_AI_PROVIDER', '9router'),

    // Urutan failover bila provider utama gagal
    'fallback_order' => ['9router', 'gemini'],

    // Parameter generasi
    'temperature' => (float) env('SORGUMMI_AI_TEMPERATURE', 0.7),
    'max_tokens'  => (int) env('SORGUMMI_AI_MAX_TOKENS', 1024),
    'timeout'     => (int) env('SORGUMMI_AI_TIMEOUT', 120),

    // Aturan perilaku / kepribadian asisten
    'system_prompt' => env('SORGUMMI_AI_SYSTEM_PROMPT',
        'Kamu adalah Sorgummi AI, asisten virtual cerdas dan ramah yang ahli seputar tanaman sorgum (Sorghum bicolor), manfaat kesehatan sorgum, resep olahan sorgum, dan produk-produk dari brand Sorgummi. Jawab selalu dalam bahasa Indonesia yang natural dan ramah. Gunakan emoji sesekali agar percakapan terasa hangat. Gunakan format bullet-points atau numbered list bila ada beberapa poin. Jika ditanya hal di luar topik sorgum, arahkan percakapan kembali ke sorgum dengan sopan.'),

    'providers' => [

        /*
         * Gateway 9router - memakai model hasil pembelian di CommandCode.
         * Model yang terverifikasi berfungsi (per pengujian): 
         *   cmc/deepseek/deepseek-v4-flash, cmc/moonshotai/Kimi-K2.5,
         *   cmc/deepseek/deepseek-v4-pro, cmc/Qwen/Qwen3.6-Plus, cmc/zai-org/GLM-5,
         *   cmc/MiniMaxAI/MiniMax-M2.5, cmc/moonshotai/Kimi-K2.6, cmc/stepfun/Step-3.5-Flash
         * Model yang DIHINDARI (error di sisi CommandCode):
         *   cmc/zai-org/GLM-5.1, cmc/MiniMaxAI/MiniMax-M2.7, cmc/Qwen/Qwen3.6-Max-Preview
         */
        '9router' => [
            'driver'   => 'openai',   // endpoint kompatibel OpenAI /chat/completions
            'base_url' => env('NINEROUTER_BASE_URL', 'http://127.0.0.1:20128/v1'),
            'api_key'  => env('SORGUMMI_AI_9ROUTER_KEY', env('NINEROUTER_API_KEY')),
            'model'    => env('SORGUMMI_AI_MODEL', 'cmc/deepseek/deepseek-v4-flash'),
        ],

        // Google Gemini - cadangan (GEMINI_API_KEY sudah ada di .env).
        // Catatan: gemini-2.0-flash & gemini-2.5-flash sudah tidak tersedia untuk akun baru.
        // 'gemini-flash-lite-latest' adalah alias yang selalu menunjuk model terbaru & terbukti jalan.
        // Alternatif kualitas lebih tinggi yang juga lolos uji: gemini-3.5-flash.
        'gemini' => [
            'driver'   => 'gemini',
            'base_url' => 'https://generativelanguage.googleapis.com/v1beta',
            'api_key'  => env('GEMINI_API_KEY'),
            'model'    => env('GEMINI_MODEL', 'gemini-flash-lite-latest'),
        ],
    ],
];
