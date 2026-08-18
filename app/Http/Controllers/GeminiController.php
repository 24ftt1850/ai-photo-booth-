<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class GeminiController extends Controller
{
    public function generateImage()
    {
        set_time_limit(180);

        $apiKey = config('services.gemini.api_key');

        $prompt = "
            Create a high-quality cinematic portrait of a person
            standing in a futuristic cyberpunk city at night.

            Neon lights, futuristic buildings, cinematic lighting,
            realistic skin, professional photography,
            detailed environment, photorealistic.
        ";

        /*
        |--------------------------------------------------------------------------
        | Temporary response file
        |--------------------------------------------------------------------------
        */

        $responseFile = storage_path('app/gemini-response.json');

        /*
        |--------------------------------------------------------------------------
        | Send request to Gemini
        |--------------------------------------------------------------------------
        */

        $response = Http::withOptions([
            'force_ip_resolve' => 'v4',

            // Save Gemini's large response directly to this file
            'sink' => $responseFile,

            'timeout' => 150,
            'connect_timeout' => 30,
        ])->withHeaders([
            'Content-Type' => 'application/json',
            'x-goog-api-key' => $apiKey,
        ])->post(
            'https://generativelanguage.googleapis.com/v1beta/interactions',
            [
                'model' => 'gemini-3.1-flash-image',

                'input' => $prompt,

                'response_format' => [
                    'type' => 'image',
                    'mime_type' => 'image/jpeg',
                    'aspect_ratio' => '1:1',
                    'image_size' => '1K',
                ],
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | Read saved response
        |--------------------------------------------------------------------------
        */

        if (!file_exists($responseFile)) {
            return response()->json([
                'success' => false,
                'error' => 'Gemini response file was not created.',
            ]);
        }

        $responseBody = file_get_contents($responseFile);

        $data = json_decode($responseBody, true);

        /*
        |--------------------------------------------------------------------------
        | Check API error
        |--------------------------------------------------------------------------
        */

        if ($response->failed()) {
            return response()->json([
                'success' => false,
                'status' => $response->status(),
                'error' => $data,
            ], $response->status());
        }

        /*
        |--------------------------------------------------------------------------
        | Find generated image
        |--------------------------------------------------------------------------
        */

        $imageData = null;
        $imageMimeType = 'image/jpeg';

        foreach ($data['steps'] ?? [] as $step) {

            if (($step['type'] ?? null) !== 'model_output') {
                continue;
            }

            foreach ($step['content'] ?? [] as $content) {

                if (($content['type'] ?? null) === 'image') {

                    $imageData = $content['data'] ?? null;

                    $imageMimeType =
                        $content['mime_type'] ?? 'image/jpeg';

                    break 2;
                }
            }
        }

        /*
        |--------------------------------------------------------------------------
        | No image
        |--------------------------------------------------------------------------
        */

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

        if ($image === false) {
            return response()->json([
                'success' => false,
                'error' => 'Unable to decode Gemini image data.',
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Determine image extension
        |--------------------------------------------------------------------------
        */

        $extension = str_contains(
            strtolower($imageMimeType),
            'png'
        ) ? 'png' : 'jpg';

        /*
        |--------------------------------------------------------------------------
        | Save generated image
        |--------------------------------------------------------------------------
        */

        $filename =
            'ai-portraits/' .
            uniqid('gemini_') .
            '.' .
            $extension;

        Storage::disk('public')->put(
            $filename,
            $image
        );

        /*
        |--------------------------------------------------------------------------
        | Delete temporary Gemini response
        |--------------------------------------------------------------------------
        */

        @unlink($responseFile);

        /*
        |--------------------------------------------------------------------------
        | Return result
        |--------------------------------------------------------------------------
        */

        return response()->json([
            'success' => true,
            'message' => 'AI image generated successfully.',
            'image_url' => Storage::url($filename),
        ]);
    }
}