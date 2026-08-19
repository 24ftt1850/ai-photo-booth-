<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Choose Theme - AI Photo Booth</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #0f172a;
            color: white;
        }

        .page {
            min-height: 100vh;
            padding: 50px 20px;
        }

        .container {
            max-width: 1100px;
            margin: auto;
        }

        .header {
            text-align: center;
            margin-bottom: 40px;
        }

        .header h1 {
            font-size: 38px;
            margin: 0 0 12px;
        }

        .header p {
            color: #94a3b8;
            font-size: 16px;
        }

        /* Photo */

        .photo-preview {
            width: 260px;
            height: 260px;
            margin: 0 auto 45px;
            border-radius: 20px;
            overflow: hidden;
            background: #020617;
            border: 1px solid #334155;
        }

        .photo-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Theme section */

        .section-title {
            text-align: center;
            font-size: 22px;
            margin-bottom: 25px;
        }

        .themes {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
        }

        .theme {
            position: relative;
            background: #1e293b;
            border: 2px solid transparent;
            border-radius: 20px;
            overflow: hidden;
            cursor: pointer;
            transition: 0.25s;
        }

        .theme:hover {
            transform: translateY(-6px);
            border-color: #64748b;
        }

        .theme.selected {
            border-color: #8b5cf6;
            box-shadow: 0 0 30px rgba(139, 92, 246, 0.35);
        }

        .theme-image {
            height: 260px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 90px;
        }

        .graduation {
            background:
                linear-gradient(
                    135deg,
                    #172554,
                    #2563eb
                );
        }

        .spiderman {
            background:
                linear-gradient(
                    135deg,
                    #450a0a,
                    #dc2626
                );
        }

        .mafia {
            background:
                linear-gradient(
                    135deg,
                    #111827,
                    #374151
                );
        }

        .theme-info {
            padding: 20px;
            text-align: center;
        }

        .theme-info h3 {
            margin: 0 0 8px;
            font-size: 21px;
        }

        .theme-info p {
            margin: 0;
            color: #94a3b8;
            font-size: 14px;
        }

        /* Check */

        .check {
            position: absolute;
            top: 15px;
            right: 15px;

            width: 35px;
            height: 35px;

            border-radius: 50%;

            background: #8b5cf6;

            display: none;
            align-items: center;
            justify-content: center;

            font-weight: bold;
        }

        .theme.selected .check {
            display: flex;
        }

        /* Buttons */

        .buttons {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 45px;
        }

        button {
            border: none;
            border-radius: 12px;
            padding: 14px 28px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }

        .back {
            background: #334155;
            color: white;
        }

        .generate {
            background: #8b5cf6;
            color: white;
        }

        .generate:hover {
            background: #7c3aed;
        }

        .generate:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        /* Mobile */

        @media (max-width: 800px) {

            .themes {
                grid-template-columns: 1fr;
                max-width: 450px;
                margin: auto;
            }

            .theme-image {
                height: 220px;
            }

        }

    </style>
</head>

<body>

<div class="page">

    <div class="container">

        <!-- Header -->

        <div class="header">

            <h1>Choose Your Theme</h1>

            <p>
                Select a theme for your AI-generated portrait.
            </p>

        </div>


        <!-- Selected Photo -->

        <div class="photo-preview">

            <img
                id="selectedPhoto"
                alt="Your selected photo"
            >

        </div>


        <!-- Theme -->

        <h2 class="section-title">
            Select a Theme
        </h2>


        <div class="themes">


            <!-- Graduation -->

            <div
                class="theme"
                data-scene="graduation"
                data-prompt="Transform the person's photo into a professional graduation portrait. Preserve the person's facial identity, facial features, hairstyle, body proportions and overall appearance. Place the person in an elegant university graduation environment, wearing appropriate graduation attire, with professional photography and cinematic lighting."
            >

                <div class="theme-image graduation">
                    🎓
                </div>

                <div class="theme-info">

                    <h3>Graduation</h3>

                    <p>
                        Professional graduation portrait
                    </p>

                </div>

                <div class="check">
                    ✓
                </div>

            </div>


            <!-- Spider-Man -->

            <div
                class="theme"
                data-scene="spiderman"
                data-prompt="Transform the person's photo into a cinematic superhero scene inspired by Spider-Man. Preserve the person's facial identity, facial features, hairstyle, body proportions and overall appearance. Place the person in a dramatic modern city environment with red and blue superhero-inspired aesthetics, dynamic cinematic lighting and professional movie-poster photography."
            >

                <div class="theme-image spiderman">
                    🕷️
                </div>

                <div class="theme-info">

                    <h3>Spider-Man</h3>

                    <p>
                        Cinematic superhero experience
                    </p>

                </div>

                <div class="check">
                    ✓
                </div>

            </div>


            <!-- Mafia -->

            <div
                class="theme"
                data-scene="mafia"
                data-prompt="Transform the person's photo into a cinematic classic mafia-inspired portrait. Preserve the person's facial identity, facial features, hairstyle, body proportions and overall appearance. Place the person in an elegant dark suit inside a luxurious vintage environment with dramatic shadows, warm cinematic lighting and sophisticated professional photography."
            >

                <div class="theme-image mafia">
                    🕴️
                </div>

                <div class="theme-info">

                    <h3>Mafia</h3>

                    <p>
                        Classic luxury crime-film aesthetic
                    </p>

                </div>

                <div class="check">
                    ✓
                </div>

            </div>

        </div>


        <!-- Buttons -->

        <div class="buttons">

            <button
                class="back"
                type="button"
                onclick="history.back()"
            >
                ← Back
            </button>

            <button
                id="generateButton"
                class="generate"
                type="button"
                disabled
            >
                ✨ Generate AI Portrait
            </button>

        </div>

    </div>

</div>


<script>

const photo =
    sessionStorage.getItem('photobooth_photo');

const selectedPhoto =
    document.getElementById('selectedPhoto');

const themes =
    document.querySelectorAll('.theme');

const generateButton =
    document.getElementById('generateButton');

let selectedTheme = null;


/*
|--------------------------------------------------------------------------
| Display photo
|--------------------------------------------------------------------------
*/

if (photo) {

    selectedPhoto.src = photo;

} else {

    selectedPhoto.alt =
        'No photo selected';

}


/*
|--------------------------------------------------------------------------
| Select theme
|--------------------------------------------------------------------------
*/

themes.forEach(theme => {

    theme.addEventListener('click', () => {

        themes.forEach(item => {

            item.classList.remove('selected');

        });

        theme.classList.add('selected');

        selectedTheme = {

            name: theme.dataset.scene,

            prompt: theme.dataset.prompt

        };

        generateButton.disabled = false;

    });

});


/*
|--------------------------------------------------------------------------
| Generate button
|--------------------------------------------------------------------------
*/

generateButton.addEventListener('click', () => {

    if (!selectedTheme) {
        return;
    }

    sessionStorage.setItem(
        'selected_scene',
        JSON.stringify(selectedTheme)
    );

    window.location.href =
        "{{ route('photobooth.generate') }}";

});

</script>

</body>
</html>