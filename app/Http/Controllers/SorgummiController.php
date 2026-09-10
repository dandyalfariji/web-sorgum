<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SorgummiController extends Controller
{
    public function chat(Request $request)
    {
        $request->validate([
            'message' => 'required|string'
        ]);

        try {
            // Forward the request to the Python microservice
            $response = Http::timeout(60)->post('http://127.0.0.1:8001/chat', [
                'message' => $request->message
            ]);

            if ($response->successful()) {
                return response()->json($response->json());
            }

            return response()->json([
                'error' => 'Gagal terhubung ke AI Service.',
                'reply' => 'Maaf, layanan AI saat ini sedang tidak tersedia.'
            ], 500);

        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'reply' => 'Maaf, terjadi kesalahan internal sistem.'
            ], 500);
        }
    }
}
