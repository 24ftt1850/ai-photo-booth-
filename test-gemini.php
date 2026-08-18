<?php

echo "GEMINI IMAGE TEST\n";

$apiKey = getenv('GEMINI_API_KEY');

if (!$apiKey) {
    die("API KEY NOT FOUND\n");
}

echo "API KEY FOUND\n";

$url = 'https://generativelanguage.googleapis.com/v1beta/interactions';

$data = [
    'model' => 'gemini-3.1-flash-image',

    'input' => [
        [
            'type' => 'text',
            'text' => 'Create a high-quality futuristic city at night with neon lights and cinematic lighting.'
        ]
    ],
];

$ch = curl_init($url);

curl_setopt_array($ch, [
    CURLOPT_POST => true,

    CURLOPT_HTTPHEADER => [
        'Content-Type: application/json',
        'x-goog-api-key: ' . $apiKey,
    ],

    CURLOPT_POSTFIELDS => json_encode($data),

    CURLOPT_RETURNTRANSFER => true,

    CURLOPT_IPRESOLVE => CURL_IPRESOLVE_V4,

    CURLOPT_CONNECTTIMEOUT => 30,

    CURLOPT_TIMEOUT => 120,
]);

echo "GENERATING IMAGE...\n";

$response = curl_exec($ch);

if ($response === false) {

    echo "CURL ERROR:\n";
    echo curl_error($ch);

    curl_close($ch);
    exit;
}

$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

curl_close($ch);

echo "HTTP CODE: $httpCode\n";

if ($httpCode !== 200) {

    echo "GEMINI ERROR:\n";
    echo $response;

    exit;
}

$result = json_decode($response, true);

echo "STATUS: ";
echo $result['status'] ?? 'unknown';
echo "\n";

/*
|--------------------------------------------------------------------------
| Find generated image
|--------------------------------------------------------------------------
*/

$imageData = null;
$mimeType = 'image/png';

foreach ($result['steps'] ?? [] as $step) {

    if (($step['type'] ?? '') !== 'model_output') {
        continue;
    }

    foreach ($step['content'] ?? [] as $content) {

        if (($content['type'] ?? '') === 'image') {

            $imageData = $content['data'] ?? null;

            $mimeType =
                $content['mime_type']
                ?? 'image/png';

            break 2;
        }
    }
}

if (!$imageData) {

    echo "NO IMAGE DATA FOUND.\n";

    exit;
}

/*
|--------------------------------------------------------------------------
| Decode Base64 image
|--------------------------------------------------------------------------
*/

$image = base64_decode($imageData);

if ($image === false) {

    echo "FAILED TO DECODE IMAGE.\n";

    exit;
}

/*
|--------------------------------------------------------------------------
| Determine extension
|--------------------------------------------------------------------------
*/

$extension = 'png';

if (str_contains(
    strtolower($mimeType),
    'jpeg'
)) {
    $extension = 'jpg';
}

/*
|--------------------------------------------------------------------------
| Save image
|--------------------------------------------------------------------------
*/

$filename = 'gemini-test.' . $extension;

file_put_contents(
    $filename,
    $image
);

echo "\n";
echo "====================================\n";
echo "IMAGE GENERATED SUCCESSFULLY!\n";
echo "====================================\n";
echo "File: $filename\n";
echo "Location: " . realpath($filename) . "\n";
echo "Size: " . filesize($filename) . " bytes\n";