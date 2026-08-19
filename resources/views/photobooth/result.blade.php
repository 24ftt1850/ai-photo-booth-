<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Your AI Portrait</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>

        body {
            margin: 0;
            background: #0f172a;
            color: white;
            font-family: Arial, sans-serif;
        }

        .page {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
        }

        .container {
            width: 100%;
            max-width: 700px;
            text-align: center;
        }

        h1 {
            font-size: 36px;
            margin-bottom: 10px;
        }

        .subtitle {
            color: #94a3b8;
            margin-bottom: 30px;
        }

        .image-container {
            background: #1e293b;
            padding: 15px;
            border-radius: 24px;
        }

        .image-container img {
            width: 100%;
            display: block;
            border-radius: 16px;
        }

        .buttons {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 30px;
            flex-wrap: wrap;
        }

        button,
        a {
            padding: 14px 24px;
            border-radius: 12px;
            border: none;
            text-decoration: none;
            font-weight: bold;
            cursor: pointer;
            font-size: 15px;
        }

        .download {
            background: #8b5cf6;
            color: white;
        }

        .again {
            background: #334155;
            color: white;
        }

    </style>

</head>

<body>

<div class="page">

    <div class="container">

        <h1>
            ✨ Your AI Portrait
        </h1>

        <p class="subtitle">
            Your AI-generated portrait is ready.
        </p>


        <div class="image-container">

            <img
                id="resultImage"
                alt="AI Generated Portrait"
            >

        </div>


        <div class="buttons">

            <a
                id="downloadButton"
                class="download"
                download="ai-portrait.jpg"
            >
                ↓ Download
            </a>

            <a
                href="{{ route('photobooth.scene') }}"
                class="again"
            >
                ↻ Generate Again
            </a>

        </div>

    </div>

</div>


<script>

const imageUrl =
    sessionStorage.getItem('generated_image');

const image =
    document.getElementById('resultImage');

const download =
    document.getElementById('downloadButton');


if (!imageUrl) {

    image.alt =
        'Generated image not found.';

} else {

    image.src = imageUrl;

    download.href =
        imageUrl;

}

</script>

</body>

</html>