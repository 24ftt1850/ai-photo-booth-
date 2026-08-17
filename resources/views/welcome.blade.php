<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>RupaVue</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-950 text-white">

    <!-- Navigation -->
    <nav class="border-b border-white/10">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-5">

            <a href="/" class="text-2xl font-bold">
                RupaVue
            </a>

            <div class="flex items-center gap-4">

                @auth
                    <a href="{{ url('/dashboard') }}"
                       class="rounded-lg px-4 py-2 text-sm font-medium hover:bg-white/10">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}"
                       class="rounded-lg px-4 py-2 text-sm font-medium hover:bg-white/10">
                        Login
                    </a>

                    <a href="{{ route('register') }}"
                       class="rounded-lg bg-white px-4 py-2 text-sm font-semibold text-slate-950 hover:bg-gray-200">
                        Register
                    </a>
                @endauth

            </div>

        </div>
    </nav>


    <!-- Hero Section -->
    <main>

        <section class="mx-auto flex min-h-[75vh] max-w-7xl items-center px-6 py-20">

            <div class="max-w-3xl">

                <p class="mb-5 text-sm font-semibold uppercase tracking-[0.3em] text-indigo-400">
                    Next Generation Of PhotoBooth
                </p>

                <h1 class="text-5xl font-extrabold leading-tight md:text-7xl">
                    Turn Your Photo Into
                    <span class="text-indigo-400">
                        Something Amazing.
                    </span>
                </h1>

                <p class="mt-6 max-w-2xl text-lg leading-8 text-gray-400">
                    Capture a moment and transform yourself into an
                    AI-generated portrait using creative themes and
                    immersive scenes.
                </p>

                <div class="mt-10 flex flex-wrap gap-4">

                    @auth

                        <a href="{{ url('/dashboard') }}"
                           class="rounded-xl bg-indigo-500 px-7 py-4 font-semibold transition hover:bg-indigo-600">
                            Start Photo Session
                        </a>

                    @else

                        <a href="{{ route('register') }}"
                           class="rounded-xl bg-indigo-500 px-7 py-4 font-semibold transition hover:bg-indigo-600">
                            Start Photo Session
                        </a>

                        <a href="#features"
                           class="rounded-xl border border-white/20 px-7 py-4 font-semibold transition hover:bg-white/10">
                            Explore Features
                        </a>

                    @endauth

                </div>

            </div>

        </section>


        <!-- Features -->
        <section id="features" class="border-t border-white/10 bg-slate-900 py-24">

            <div class="mx-auto max-w-7xl px-6">

                <div class="mb-14 text-center">

                    <p class="text-sm font-semibold uppercase tracking-widest text-indigo-400">
                        How It Works
                    </p>

                    <h2 class="mt-3 text-4xl font-bold">
                        Create Your AI Portrait
                    </h2>

                    <p class="mx-auto mt-4 max-w-2xl text-gray-400">
                        Our photo booth makes it simple to create
                        memorable AI-generated portraits.
                    </p>

                </div>


                <div class="grid gap-8 md:grid-cols-3">

                    <!-- Step 1 -->
                    <div class="rounded-2xl border border-white/10 bg-slate-950 p-8">

                        <div class="mb-6 flex h-12 w-12 items-center justify-center rounded-xl bg-indigo-500/20 text-xl">
                            01
                        </div>

                        <h3 class="text-xl font-bold">
                            Take Your Photo
                        </h3>

                        <p class="mt-3 leading-7 text-gray-400">
                            Capture your photograph directly using
                            the photo booth camera.
                        </p>

                    </div>


                    <!-- Step 2 -->
                    <div class="rounded-2xl border border-white/10 bg-slate-950 p-8">

                        <div class="mb-6 flex h-12 w-12 items-center justify-center rounded-xl bg-indigo-500/20 text-xl">
                            02
                        </div>

                        <h3 class="text-xl font-bold">
                            Choose a Theme
                        </h3>

                        <p class="mt-3 leading-7 text-gray-400">
                            Choose from creative themes such as
                            graduation, wedding, fantasy and more.
                        </p>

                    </div>


                    <!-- Step 3 -->
                    <div class="rounded-2xl border border-white/10 bg-slate-950 p-8">

                        <div class="mb-6 flex h-12 w-12 items-center justify-center rounded-xl bg-indigo-500/20 text-xl">
                            03
                        </div>

                        <h3 class="text-xl font-bold">
                            Get Your AI Portrait
                        </h3>

                        <p class="mt-3 leading-7 text-gray-400">
                            Our AI transforms your photograph into
                            a creative themed portrait.
                        </p>

                    </div>

                </div>

            </div>

        </section>


        <!-- Themes -->
        <section class="py-24">

            <div class="mx-auto max-w-7xl px-6">

                <div class="grid items-center gap-12 md:grid-cols-2">

                    <div>

                        <p class="text-sm font-semibold uppercase tracking-widest text-indigo-400">
                            Unlimited Creativity
                        </p>

                        <h2 class="mt-3 text-4xl font-bold">
                            Choose Your World
                        </h2>

                        <p class="mt-5 leading-8 text-gray-400">
                            From memorable graduation portraits to
                            futuristic cyberpunk scenes, our AI photo
                            booth allows users to experience different
                            creative worlds.
                        </p>

                        <div class="mt-8 flex flex-wrap gap-3">

                            <span class="rounded-full bg-indigo-500/10 px-4 py-2 text-sm text-indigo-300">
                                Graduation
                            </span>

                            <span class="rounded-full bg-indigo-500/10 px-4 py-2 text-sm text-indigo-300">
                                Wedding
                            </span>

                            <span class="rounded-full bg-indigo-500/10 px-4 py-2 text-sm text-indigo-300">
                                Cyberpunk
                            </span>

                            <span class="rounded-full bg-indigo-500/10 px-4 py-2 text-sm text-indigo-300">
                                Fantasy
                            </span>

                            <span class="rounded-full bg-indigo-500/10 px-4 py-2 text-sm text-indigo-300">
                                Corporate
                            </span>

                        </div>

                    </div>


                    <div class="rounded-3xl border border-white/10 bg-gradient-to-br from-indigo-500/20 to-purple-500/10 p-10">

                        <div class="aspect-square rounded-2xl border border-white/10 bg-slate-950/70 p-8">

                            <div class="flex h-full items-center justify-center text-center">

                                <div>

                                    <div class="text-6xl">
                                        ✨
                                    </div>

                                    <h3 class="mt-6 text-2xl font-bold">
                                        Your Imagination
                                    </h3>

                                    <p class="mt-3 text-gray-400">
                                        Your photo.
                                        <br>
                                        Your theme.
                                        <br>
                                        Your AI portrait.
                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section>

    </main>


    <!-- Footer -->
    <footer class="border-t border-white/10 bg-slate-950">

        <div class="mx-auto max-w-7xl px-6 py-8">

            <div class="flex flex-col justify-between gap-4 text-sm text-gray-500 md:flex-row">

                <p>
                    © {{ date('Y') }} AI Photo Booth
                </p>

                <p>
                    AI-powered event photography
                </p>

            </div>

        </div>

    </footer>

</body>
</html>