<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class GeminiController extends Controller
{
    public function generateImage()
    {
        $apiKey = config('services.gemini.api_key');

        $prompt = "
            Create a high-quality cinematic portrait of a person
            standing in a futuristic cyberpunk city at night.

            Neon lights, futuristic buildings, cinematic lighting,
            realistic skin, professional photography,
            detailed environment, photorealistic.
        ";

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'x-goog-api-key' => $apiKey,
        ])->post(
            'https://generativelanguage.googleapis.com/v1beta/interactions',
            [
                'model' => 'gemini-3.1-flash-image',

                'input' => $prompt,

                'response_format' => [
                    'type' => 'image',
                    'mime_type' => 'image/png',
                    'aspect_ratio' => '1:1',
                    'image_size' => '1K',
                ],
            ]
        );

        if ($response->failed()) {
            return response()->json([
                'success' => false,
                'error' => $response->json(),
            ], $response->status());
        }

        $data = $response->json();

        /*
        |--------------------------------------------------------------------------
        | Find generated image
        |--------------------------------------------------------------------------
        */

        $imageData = null;

        foreach ($data['steps'] ?? [] as $step) {

            if (($step['type'] ?? null) === 'model_output') {

                foreach ($step['content'] ?? [] as $content) {

                    if (($content['type'] ?? null) === 'image') {

                        $imageData = $content['data'];

                        break 2;
                    }
                }
            }
        }

        if (!$imageData) {
            return response()->json([
                'success' => false,
                'error' => 'Gemini did not return an image.',
                'response' => $data,
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Decode image
        |--------------------------------------------------------------------------
        */

        $image = base64_decode($imageData);

        /*
        |--------------------------------------------------------------------------
        | Save image
        |--------------------------------------------------------------------------
        */

        $filename = 'ai-portraits/' . uniqid() . '.png';

        Storage::disk('public')->put(
            $filename,
            $image
        );

        /*
        |--------------------------------------------------------------------------
        | Return result
        |--------------------------------------------------------------------------
        */

        return response()->json([
            'success' => true,

            'image_url' => Storage::url($filename),
        ]);
    }
}